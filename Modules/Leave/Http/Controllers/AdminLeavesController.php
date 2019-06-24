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
use Datakraf\Notifications\AdminLeaveRemark;
use Calendar;
use Modules\Leave\Traits\LeavesCalendar;
use Uzzaircode\DateHelper\Traits\DateHelper;
use Modules\Leave\Traits\LeaveOperations;
use Carbon\Carbon;
use Modules\Leave\Entities\LeaveEntitlement;

class AdminLeavesController extends Controller
{
    use LeavesCalendar, DateHelper, LeaveOperations;

    public function __construct(Leave $leave, LeaveType $type, Request $request, User $user, LeaveAttachment $attachment, LeaveBalance $balance, Holiday $holiday)
    {
        $this->type = $type;
        $this->data = [
            'user_id' => $request->user_id,
            'leavetype_id' => $request->leavetype_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'days_taken' => 0,
            'notes' => $request->notes
        ];
        $this->leave = $leave;
        $this->user = $user;
        $this->attachment = $attachment;
        $this->balance = $balance;
        $this->holiday = $holiday;
    }

    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $retractedStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($status = null)
    {
        return view('leave::leave.admin.index', [
            'leaves' => Leave::adminLeaveStatus($status)
        ]);
    }


    public function withdrawn()
    {
        return view('leave::leave.admin.trashed', [
            'leaves' => Leave::onlyTrashed()->orderBy('deleted_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the withdrawn leave application details
     * 
     * @param integer $id
     */

    public function showWithdrawn(int $id)
    {
        $leave = $this->leave->onlyTrashed()->where('id', $id)->first();

        $calendar = $this->makeCalendar($leave->start_date, $leave->end_date);

        return view('leave::leave.admin.show-trash', [
            'leave' => $leave,
            'types' => $this->type->all(),
            'statuses' => Leave::onlyTrashed()->where('id', $id)->first()->statuses,
            'calendar' => $calendar
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('leave::leave.admin.apply', [
            'types' => $this->type->all(),
            'holidays' => $this->holiday->all(),
            'users' => $this->user->all()
        ]);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(int $id)
    {
        // determine if action buttons will be displayed or vice versa
        $actionVisibility = !in_array($this->leave->find($id)->status, [$this->approvedStatus, $this->rejectedStatus]);

        $leave = $this->leave->find($id);
        //check kalau ad yg sama leave apply oleh user masukkan kt kalendar lama dan baru
        $leavecheck = $this->leave->where('user_id',$leave->user_id)->where('leavetype_id',$leave->leavetype_id)->exists();
        if($leavecheck == true){
            $l = $this->leave->where('user_id',$leave->user_id)->where('leavetype_id',$leave->leavetype_id)->get();
           
            foreach($l as $le){
                $calendar = $this->makeCalendar($le->start_date,$le->end_date);
            }
        }
        else{
            $calendar = $this->makeCalendar($leave->start_date, $leave->end_date);
        }
         //calculate prorated leave yg layak ambil ikut bulan
         $today = Carbon::now();
         $month = $today->month;
         $leaveentitle=LeaveEntitlement::where('user_id',$leave->user_id)->first();
         $day=$leave->user->leaveEntitlement->days;
        
         $prorated_leave=$day / 12 * $month;
         $available = number_format($prorated_leave);
         $leaveentitle->available_annualleave = $available;
         $leaveentitle->save();
        return view('leave::leave.admin.show', [

            'leave' => $leave,
            'types' => $this->type->all(),
            'statuses' => $leave->statuses,
            'actionVisibility' => $actionVisibility,
            'calendar' => $calendar

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('leave::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    { }


    public function approveRejectLeave(Request $request, $id)
    {
        // find this leave model
        $leave = $this->leave->find($id);
        // find the total days allowed for that particular leave type
        $totalAllowedDaysOfLeave = $this->leave->find($id)->type->days;
        // find total days taken for this leave
        $totalDaysTaken = $this->leave->find($id)->days_taken;
        // find the balance after approval
        $balance = $totalAllowedDaysOfLeave - $totalDaysTaken;

        if ($request->has('approve')) {

            // check the user's leave type available balance
            $balanceexist = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->exists();
            if($balanceexist == true){
                $that_leave = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->first();
                $balance1 = $that_leave->balance - $totalDaysTaken;
                $this->balance->updateOrCreate(['user_id' => $leave->user_id, 'leavetype_id' => $leave->leavetype_id], ['balance' => $balance1]);
            }
            else{
                // update or create leave balance record in leavebalances table
                $this->balance->updateOrCreate(['user_id' => $leave->user_id, 'leavetype_id' => $leave->leavetype_id], ['balance' => $balance]);
            }
            
            // set the status of the leave
            $leave->setStatus($this->approvedStatus, 'Leave approved by ' . Auth::user()->name . '<br>Remarks:<br> ' . $request->admin_remarks);
            $leave->user->notify(new ApproveLeave($leave, $leave->user, Auth::user()));
            toast('Leave application approved successfully', 'success', 'top-right');
        }

        if ($request->has('reject')) {
            // set the status of the leave
            $leave->setStatus($this->rejectedStatus, 'Leave rejected by ' . Auth::user()->name . '<br>Remarks:<br> ' . $request->admin_remarks);
            $leave->user->notify(new RejectLeave($leave, $leave->user, Auth::user()));
            toast('Leave application rejected', 'success', 'top-right');
        }

        if ($request->has('remarks')) {
            // set the status of the leave
            $leave->setStatus($this->submittedStatus, '<b>Remarks by ' . Auth::user()->name . '</b><br>Remarks:<br> ' . $request->admin_remarks);
            $leave->user->notify(new AdminLeaveRemark($leave, $leave->user, Auth::user()));
            toast('Remarks added to this leave application', 'success', 'top-right');
        }

        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    { }

    public function retract(int $id){

        $leave = $this->leave->find($id);
        //check if the leave has been approved
        $that_leave = $this->balance->where('leavetype_id',$leave->leavetype_id)->where ('user_id',$leave->user_id)->first();
        $that_leave_balance = $that_leave->balance;
        $that_leave_balance += $leave->days_taken;
        $that_leave->update([
            'balance' => $that_leave_balance
        ]);
        $leave->setStatus($this->retractedStatus, 'Leave withdrawn by ' . Auth::user()->name);
        $this->notifyHR($leave,new RetractLeave($leave, $leave->user, Auth::user()));
        toast('Leave application withdrawn successfully', 'success', 'top-right');
    }
}
