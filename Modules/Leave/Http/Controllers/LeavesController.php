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

class LeavesController extends Controller
{
    use AlertMessage, Date;
    /**
     * Display a listing of the resource.
     * @return Response
     */
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
    

    public function index()
    {
        return view('leave::leave.user.index', [
            'results' => Auth::user()->leaves,
        ]);
    }

    public function withdrawn()
    {
        return view('leave::leave.user.trashed', [
            'results' => Leave::onlyTrashed()->where('user_id',auth()->id())->get(),
        ]);
    }

    public function show(int $id)
    {        
        return view('leave::leave.user.show', [
            'leave' => $this->leave->find($id),
            'types' => $this->type->all(),
            'statuses' => $this->leave->find($id)->statuses,            
        ]);
    }

    
    public function edit(int $id)
    {
        return view('leave::leave.user.edit', [
            'leave' => $this->leave->find($id),
            'types' => $this->type->all(),
            'statuses' => $this->leave->find($id)->statuses,            
        ]);
    }

   
    public function create()
    {
        return view('leave::leave.user.apply', [
            'types' => $this->type->all(),
            'holidays' => $this->holiday->all()
        ]);
    }

    

    public function store(ApplyLeaveRequest $request)
    {
        // create leave
        $leave = $this->leave->create($this->data);
        // save total days
        $this->saveTotalDaysTaken($leave);
        // notify HR
        $this->notifyHR($leave,new ApplyLeave($leave, Auth::user()));
        // set leave status
        $this->setLeaveStatus($leave);
        // save attachments
        $this->saveAttachments($request, $leave);

        toast('Leave record submitted', 'success', 'top-right');
        return redirect()->back();
    }

    public function update($id, Request $request)
    {
        $leave = Leave::find($id);

        $leave->update($this->data);

        $this->saveTotalDaysTaken($leave);

        $this->saveAttachments($request, $leave);

        toast('Leave record submitted', 'success', 'top-right');
        return redirect()->back();

    }

    public function saveTotalDaysTaken($leave)
    {
        $leave->days_taken = $this->getLeaveTotalDays($leave);
        $leave->save();
    }

    public function notifyHR($leave,$notification)
    {
        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify($notification);
        }


    }

    public function setLeaveStatus($leave)
    {
        $leave->setStatus($this->submittedStatus, 'Leave submitted for review.<br>Remarks:<br>' . $leave->notes);
    }

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
            // update or create leave balance record in leavebalances table
            $this->balance->updateOrCreate(['user_id' => $leave->user_id, 'leavetype_id' => $leave->leavetype_id], ['balance' => $balance]);
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

        return redirect()->back();

    }

    public function destroy(int $id)
    {   
        $this->retract($id);
                
        return back();
    }

    public function exportUserLeaves($id)
    {
        $name = $this->user->find($id)->personalDetail->name;
        return (new UserLeavesExport)->forUser($id)->download('hello.xlsx');
    }

    public function leaveCurrentStatus($leave)
    {
        $leave->status;
    }

    public function retract(int $id){

        $leave = $this->leave->find($id);        
        //check if the leave has been approved
        $that_leave = $this->balance->where('leavetype_id',$leave->leavetype_id)->where('user_id',$leave->user_id)->first();
        $that_leave_balance = $that_leave->balance;
        $that_leave_balance += $leave->days_taken;        
        $that_leave->update([
            'balance' => $that_leave_balance
        ]);
        $leave->setStatus($this->retractedStatus, 'Leave withdrawn by ' . Auth::user()->name);
        $this->notifyHR($leave,new RetractLeave($leave, $leave->user, Auth::user()));
        $leave->delete();
        toast('Leave application withdrawn successfully', 'success', 'top-right');
    }

}
