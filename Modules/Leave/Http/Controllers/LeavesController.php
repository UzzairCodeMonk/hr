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
use Modules\Leave\Traits\LeaveOperations;
use Datakraf\Notifications\ApproveLeave;
use Datakraf\Notifications\RejectLeave;
use Modules\Leave\Http\Requests\ApplyLeaveRequest;
use Modules\Leave\Entities\Holiday;
use Datakraf\Notifications\RetractLeave;
use Modules\Leave\Traits\LeaveStatus;
use Modules\Site\Entities\Center;
use Carbon\Carbon;
use Uzzaircode\DateHelper\Traits\DateHelper;
use Calendar;
use Modules\Leave\Traits\LeavesCalendar;
use Modules\Leave\Entities\LeaveEntitlement;


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

    use AlertMessage, LeaveStatus, DateHelper, LeaveOperations, LeavesCalendar;

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
     * @param string $status
     * @return void
     */

    public function index(string $status)
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
                
        $data = Leave::find($id);
        // $calendar = $this->makeCalendar($data->start_date, $data->end_date);    
         //check kalau ad yg sama leave apply oleh user masukkan kt kalendar lama dan baru
         $leavecheck = Leave::where('user_id',$data->user_id)->where('leavetype_id',$data->leavetype_id)->exists();
         if($leavecheck == true){
             $l = Leave::where('user_id',$data->user_id)->where('leavetype_id',$data->leavetype_id)->get();
            
             foreach($l as $le){
                 $calendar = $this->makeCalendar($le->start_date,$le->end_date);
             }
         }
         else{
             $calendar = $this->makeCalendar($data->start_date, $data->end_date);
         }    
            //calculate prorated leave yg layak ambil ikut bulan
            $today = Carbon::now();
            $month = $today->month;
            $leaveentitle=LeaveEntitlement::where('user_id',auth()->user()->id)->first();
            $day=auth()->user()->leaveEntitlement->days;

            $prorated_leave=$day / 12 * $month;
            $available = number_format($prorated_leave);
            $leaveentitle->available_annualleave = $available;
            $leaveentitle->save();

        return view('leave::leave.user.show', [

            'leave' => $data,
            'types' => $this->type->all(),
            'statuses' => $data->statuses,
            'calendar' => $calendar

        ]);
    }


    /**
     * Show create leave application page
     * 
     * @return void
     */

    public function create()
    {
        //calculate prorated leave yg layak ambil ikut bulan
        $today = Carbon::now();
        $month = $today->month;
        $leaveentitle=LeaveEntitlement::where('user_id',auth()->user()->id)->first();
        $day=auth()->user()->leaveEntitlement->days;
       
        $prorated_leave=$day / 12 * $month;
        $available = number_format($prorated_leave);
        $leaveentitle->available_annualleave = $available;
        $leaveentitle->save();
        
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
        //check leave lebih dari prorated
        if($request->leavetype_id==7 && $request->user_id == auth()->user()->id){
            $start_date = $this->setDateObject('d/m/Y', $request->start_date);
            $end_date = $this->setDateObject('d/m/Y', $request->end_date);
            $nonWorkingDays = auth()->user()->personalDetail->center->holidays->pluck('name')->toArray();
            $holidays = Holiday::pluck('date')->toArray();
            
            $h = collect($holidays)->map(function ($item, $key) {
                return Carbon::createFromFormat(config('app.date_format'), $item)->format('Y-m-d');
            });
            $holidays1 = $h->toArray();
            $days = $this->getDateRangeExcludingHolidaysOrNonWorkingDays($start_date, $end_date, $holidays1, $nonWorkingDays);
            $d = collect($days)->map(function ($item, $key) {
                return $item->format('l d F Y');
            });
            // dd($d->toJson());
            $days_taken = collect($days)->count();
            $entitle = auth()->user()->leaveEntitlement->days;
            $balanceexist = LeaveBalance::where('user_id',auth()->user()->id)->exists();
            if($balanceexist == true){
                $balance = LeaveBalance::where('user_id',auth()->user()->id)->first()->balance;
                $leave_apply = $days_taken + ($entitle - $balance);
                if($leave_apply >  auth()->user()->leaveEntitlement->available_annualleave){
                    toast('You are not allowed to apply annual leave because your leave applied 
                    more than prorated or available annual leave for this month', 'error', 'top-right');
                    return redirect()->back();
                }else{
                    $leave = $this->leave->create($this->data);
                    // determine if its half day or full day
                    $this->daySelector($request, $leave);
                    // notify HR
                    $this->notifyLeaveApplicationToRecipients($request->users, $leave, new ApplyLeave($leave, auth()->user()));
                    // set leave status
                    $this->setLeaveStatus($leave);
                    // save attachments
                    $this->saveAttachments($request, $leave);
            
                    toast('Leave record submitted', 'success', 'top-right');
                    return redirect()->route('leave.index', ['status' => 'submitted']);
                }
            }else{
                if($days_taken >  auth()->user()->leaveEntitlement->available_annualleave){
                    toast('You are not allowed to apply annual leave because your leave applied 
                    more than prorated or available annual leave for this month', 'error', 'top-right');
                    return redirect()->back();
                }else{
                    $leave = $this->leave->create($this->data);
                    // determine if its half day or full day
                    $this->daySelector($request, $leave);
                    // notify HR
                    $this->notifyLeaveApplicationToRecipients($request->users, $leave, new ApplyLeave($leave, auth()->user()));
                    // set leave status
                    $this->setLeaveStatus($leave);
                    // save attachments
                    $this->saveAttachments($request, $leave);
            
                    toast('Leave record submitted', 'success', 'top-right');
                    return redirect()->route('leave.index', ['status' => 'submitted']);
                }
            }
        }else{
            //create leave
            $leave = $this->leave->create($this->data);
            // determine if its half day or full day
            $this->daySelector($request, $leave);
            // notify HR
            if($request->users){
                $this->notifyLeaveApplicationToRecipients($request->users, $leave, new ApplyLeave($leave, auth()->user()));
            }
            // set leave status
            $this->setLeaveStatus($leave);
            // save attachments
            $this->saveAttachments($request, $leave);

            toast('Leave record submitted', 'success', 'top-right');
            if($request->user_id != auth()->user()->id){
                return redirect()->route('leave.admin.index', ['status' => 'submitted']);
            }
            else{
                return redirect()->route('leave.index', ['status' => 'submitted']);
            }
        }
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

        $this->daySelector($request, $leave);

        $this->saveAttachments($request, $leave);

        toast('Leave record submitted', 'success', 'top-right');
        // return redirect()->back();
        return redirect()->route('leave.index', ['status' => 'submitted']);
    }


    /**
     * Store total days of leave
     *
     * @param object $leave
     * @return void
     */

    public function saveTotalDaysTaken($leave)
    {
        $start_date = $this->setDateObject('d/m/Y', $leave->start_date);
        $end_date = $this->setDateObject('d/m/Y', $leave->end_date);
        $nonWorkingDays = auth()->user()->personalDetail->center->holidays->pluck('name')->toArray();
        $holidays = Holiday::pluck('date')->toArray();
        $h = collect($holidays)->map(function ($item, $key) {
            return Carbon::createFromFormat(config('app.date_format'), $item)->format('Y-m-d');
        });
        $holidays1 = $h->toArray();
        $days = $this->getDateRangeExcludingHolidaysOrNonWorkingDays($start_date, $end_date, $holidays1, $nonWorkingDays);
        $d = collect($days)->map(function ($item, $key) {
            return $item->format('l d F Y');
        });
        // dd($d->toJson());
        $leave->days_taken = collect($days)->count();
        $leave->date_series = collect($d)->implode(',');
        $leave->save();
    }

    /**
     * Notify leave applciations to Recipients and HR Administrators
     * 
     * @param object $leave 
     * @param object $notification
     * 
     */
    public function notifyLeaveApplicationToRecipients(array $recipients, $leave, $notification)
    {

        // get user objects based on id from request
        $recipients = User::whereIn('id', $recipients)->get();

        // $recipients = $recipients->merge($admins);

        $approvers = $recipients->pluck('id');

        $leave->approvers()->sync($approvers);

        foreach ($recipients as $recipient) {
            $recipient->notify($notification);
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
        $leavebalance = $this->balance->where('leavetype_id',$leave->leavetype_id)->where('user_id',$leave->user_id)->exists();
        if($leavebalance == true){
            $that_leave = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->first();

            //check if the leave has been approved
            if ($leave->status == $this->approvedStatus) {
                $that_leave_balance = $that_leave->balance;
                $that_leave_balance += $leave->days_taken;
                $that_leave->update([
                    'balance' => $that_leave_balance
                ]);
            }
        }

        $approvers = $leave->approvers->pluck('id')->toArray();

        $leave->setStatus($this->withdrawnStatus, 'Leave withdrawn by ' . auth()->user()->name);

        $leave->delete();

        // notify HR/Administrators
        $this->notifyLeaveApplicationToRecipients($approvers, $leave, new RetractLeave($leave, $leave->user, auth()->user()));


        toast('Leave application withdrawn successfully', 'success', 'top-right');
    }



    public function testDate()
    {

        $holidays = Holiday::pluck('date')->toArray();

        $start_date = $this->setDateObject('Y/m/d', '2019/02/13');
        $end_date = $this->setDateObject('Y/m/d', '2019/02/20');

        $holidays = Holiday::pluck('date')->toArray();

        $nonWorkingDays = ['Saturday', 'Sunday'];

        $f = $this->getDateRangeExcludingHolidaysOrNonWorkingDays($start_date, $end_date, $holidays, $nonWorkingDays);

        dd($f);
    }

    public function json()
    {

        $arr = [
            [
                "id" => 1,
                "name" => "zniaates"
            ],
            [
                "id" => 2,
                "name" => "United Arabasas"
            ],
        ];

        return response()->json($arr, 200);
    }
}
