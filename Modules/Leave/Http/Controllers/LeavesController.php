<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Leave\Entities\LeaveType;
use Modules\Leave\Entities\Leave;
use Modules\Leave\Entities\LeaveAttachment;
use Modules\Leave\Entities\LeaveBalance;
use Datakraf\Traits\AlertMessage;
use Datakraf\Notifications\ApplyLeave;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Leave\Traits\Date;
use Modules\Leave\Exports\UserLeavesExport;
use Datakraf\Notifications\ApproveLeave;
use Datakraf\Notifications\RejectLeave;
use Modules\Leave\Http\Requests\ApplyLeaveRequest;
use Modules\Leave\Entities\Holiday;
use Datakraf\Notifications\RetractLeave;
use Modules\Leave\Traits\LeaveStatus;
use Modules\Site\Entities\Center;
use Carbon\Carbon;
use Uzzaircode\DateHelper\Traits\DateHelper;
use DatePeriod;
use DateInterval;
// use Uzzaircode\DateHelper\Traits\DateHelper;

/***
 * 
 *  User Leave Controller
 * 
 *  There are tons of logic here. Don't get yourself confused.
 * 
 *  Business Model
 *  ==============
 *  Stored leave records will not be deleted, it can only approved, rejected or withdrawn.
 *  Basically this module will run a series of checks upon in each of these operation.
 *  
 *  -- Applying leave
 *  
 *  - Conditions;
 *  - user cost center (determine the cost center of the user)
 *  - user status (whether the user is a probation, permanent, contract, foreginer)
 *  - leave balance (checking if the leave balance is still available for application)
 *  - days (checking to see if the date range has predefined non-working days and holidays)
 *  
 *  -- Withdrawing leave application
 *   - Conditions;
 *   - latest leave status (whether the leave has been approved or rejected)
 *   - 
 * 
 ***/


class LeavesController extends Controller
{
    use AlertMessage, LeaveStatus, Date;

    public $type;
    public $data;
    public $leave;
    public $user;
    public $attachment;
    public $balance;

    public function __construct(Leave $leave, LeaveType $type, Request $request, User $user, LeaveAttachment $attachment, LeaveBalance $balance, Holiday $holiday)
    {
        $this->type = $type;
        $this->data = [
            'user_id' => $request->user_id,
            'leavetype_id' => $request->leavetype_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notes' => $request->notes
        ];
        $this->leave = $leave;
        $this->user = $user;
        $this->attachment = $attachment;
        $this->balance = $balance;
        $this->holiday = $holiday;
    }


    /**
     * List all user leave applications
     *
     * @return void
     */

    public function index($status)
    {
        return view('leave::leave.user.index', [
            'results' => Leave::leaveStatus($status),
        ]);
    }

    /**
     *  Show the leave application details
     *  
     *  @param integer $id
     */

    public function show(int $id)
    {
        return view('leave::leave.user.show', [
            'leave' => $this->leave->find($id),
            'types' => $this->type->all(),
            'statuses' => $this->leave->find($id)->statuses,
        ]);
    }



    /**
     * List all withdrawn leave applications
     */

    public function withdrawn()
    {
        return view('leave::leave.user.trashed', [
            'results' => Leave::onlyTrashed()->where('user_id', auth()->id())->orderBy('deleted_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the withdrawn leave application details
     * 
     * @param integer $id
     */

    public function showWithdrawn(int $id)
    {

        return view('leave::leave.user.show-trash', [
            'leave' => $this->leave->onlyTrashed()->where('id', $id)->first(),
            'types' => $this->type->all(),
            'statuses' => Leave::onlyTrashed()->where('id', $id)->first()->statuses,
        ]);
    }


    /**
     * Show create leave application page
     * 
     * @return void
     */

    public function create()
    {
        return view('leave::leave.user.apply', [
            'types' => $this->type->all(),
            'holidays' => $this->holiday->all()
        ]);
    }

    /**
     * Show edit leave application page
     * 
     * @param integer $id
     */

    public function edit(int $id)
    {
        return view('leave::leave.user.edit', [
            'leave' => $this->leave->find($id),
            'types' => $this->type->all(),
            'statuses' => $this->leave->find($id)->statuses,
        ]);
    }

    /**
     * Store leave application
     * 
     * @param array $request
     */

    public function store(ApplyLeaveRequest $request)
    {
        // create leave
        $leave = $this->leave->create($this->data);

        if ($request->full_half == 1) {
            $this->isHalfDay($request, $leave);
        } else {
            $this->saveTotalDaysTaken($leave);
        }
        // notify HR
        $this->notifyHR($leave, new ApplyLeave($leave, Auth::user()));
        // set leave status
        $this->setLeaveStatus($leave);
        // save attachments
        $this->saveAttachments($request, $leave);

        toast('Leave record submitted', 'success', 'top-right');
        return redirect()->route('leave.index', ['status' => 'submitted']);
    }

    /**
     * Check current user cost center
     * 
     * 
     */

    public function getNonWorkingDaysForThisUser()
    {

        return $holidays = Center::find(auth()->user()->personalDetail->center->id)->holidays->pluck('name');
    }

    public function getPublicHolidays()

    {

        return Holiday::all();
    }


    /**
     * Update leave application
     * 
     * @param integer $id
     * @param array $request
     */

    public function update($id, Request $request)
    {
        $leave = Leave::find($id);

        $leave->update($this->data);

        $this->saveTotalDaysTaken($leave);

        $this->saveAttachments($request, $leave);

        toast('Leave record submitted', 'success', 'top-right');
        return redirect()->back();
    }


    /**
     * Store total days of leave
     *
     * @param object $leave
     * @return void
     */

    public function saveTotalDaysTaken($leave)
    {
        $leave->days_taken = $this->getLeaveTotalDays($leave);
        $leave->save();
    }

    /**
     * Notify HR Administrators
     * 
     * @param object $leave 
     * @param object $notification
     * 
     */
    public function notifyHR($leave, $notification)
    {
        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify($notification);
        }
    }

    /**
     * Set leave status
     *
     * @param object $leave
     */
    public function setLeaveStatus($leave)
    {
        $leave->setStatus($this->submittedStatus, 'Leave submitted for review.<br>Remarks:<br>' . $leave->notes);
    }

    /**
     * Upload and store leave attachments
     * 
     *
     * @param array $request
     * @param object $leave
     * @return void
     */
    public function saveAttachments($request, $leave)
    {
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if (!empty($file)) {
                    // save the attachment with event title and time as prefix
                    $filename = time() . $file->getClientOriginalName();
                    // move the attachements to public/uploads/applicationsattachments folder
                    $file->move('uploads/leaveattachments', $filename);
                    // create attachement record in database, attach it to Ticket ID
                    $this->attachment->create([
                        'leave_id' => $leave->id,
                        'filename' => $filename,
                        'filepath' => 'uploads/leaveattachments/' . $filename
                    ]);
                }
            }
        }
    }

    /**
     * Destroy leave application
     *
     * @param integer $id
     * @return void
     */
    public function destroy(int $id)
    {
        $this->retract($id);

        return back();
    }

    /** 
     * Generate leave application records into excel
     * 
     * @param integer $id
     */
    // public function exportUserLeaves($id)
    // {
    //     $name = $this->user->find($id)->personalDetail->name;
    //     return (new UserLeavesExport)->forUser($id)->download('hello.xlsx');
    // }

    /**
     * Retrieve current status of leave application
     *
     * @param object $leave
     * @return void
     */
    public function leaveCurrentStatus($leave)
    {
        $leave->status;
    }

    /**
     * Retract (withdraw) the leave application
     *
     * @param integer $id
     * @return void
     */
    public function retract(int $id)
    {

        // find leave application
        $leave = $this->leave->find($id);

        // check the user's leave type available balance
        $that_leave = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->first();

        //check if the leave has been approved
        if ($leave->status == $this->approvedStatus) {
            $that_leave_balance = $that_leave->balance;
            $that_leave_balance += $leave->days_taken;
            $that_leave->update([
                'balance' => $that_leave_balance
            ]);
        }

        // set leave status
        $leave->setStatus($this->withdrawnStatus, 'Leave withdrawn by ' . Auth::user()->name);

        // notify HR/Administrators
        $this->notifyHR($leave, new RetractLeave($leave, $leave->user, Auth::user()));

        // soft delete the leave application
        $leave->delete();

        toast('Leave application withdrawn successfully', 'success', 'top-right');
    }


    public function isHalfDay($request, $leave)
    {
        $leave->days_taken = 0.5;
        $leave->period = $request->period;
        $leave->save();
    }


    public function testDate()
    {

        $start_date = $this->setDateObject('Y/m/d', '2019/02/13');
        $end_date = $this->setDateObject('Y/m/d', '2019/02/20');
        $days = $this->getDaysDifference($start_date, $end_date, true);
        $period = new DatePeriod($start_date, new DateInterval('P1D'), $end_date);
        // $arr = $this->generateDateRange($start_date, $end_date,'l');        
        $holidays = array('2019-02-15');
        // dd($this->countDaysInDateRange($arr));
        $nonWorkingDays = ['Saturday', 'Sunday'];

        foreach($period as $dt) {
            // $curr = $dt->format('l');

            // substract if Saturday or Sunday
            if (in_array($dt->format('l'), $nonWorkingDays)) {
                $days--;
            }

            // (optional) for the updated question
            elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }

        dd($days);
    }
}
