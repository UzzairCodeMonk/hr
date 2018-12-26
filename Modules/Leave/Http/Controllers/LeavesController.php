<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Leave\Entities\LeaveType;
use Modules\Leave\Entities\Leave;
use Modules\Leave\Entities\LeaveAttachment;
use Datakraf\Traits\AlertMessage;
use Datakraf\Notifications\ApplyLeave;
use Auth;
use Modules\Leave\Traits\Date;

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

    public function __construct(Leave $leave, LeaveType $type, Request $request, User $user, LeaveAttachment $attachment)
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
    }

    public function index()
    {
        // $leaves = $this->leave->all();        
        // return view('leave::leave.admin.leave-records', compact('leaves'));
        return view('leave::leave.admin.users', ['users' => $this->user->all()]);
    }

    public function show($id)
    {
        return view('leave::leave.admin.user-leaves', [
            'leaves' => $this->user->find($id)->leaves,
        ]);
    }

    public function showUserLeaves($id)
    {
        return view('leave::leave.forms.show', [
            'leave' => $this->leave->find($id),
            'types' => $this->type->all(),
            'statuses' => $this->leave->find($id)->statuses
        ]);
    }

    public function showMyLeaveApplications()
    {

        return view('leave::leave.my-leave', [
            'results' => Auth::user()->leaves

        ]);
    }

    public function showLeaveApplicationForm()
    {
        return view('leave::leave.forms.apply', ['types' => $this->type->all()]);
    }

    public function store(Request $request)
    {
        // create leave
        $leave = $this->leave->create($this->data);
        // save total days
        $this->saveTotalDaysTaken($leave);
        // notify HR
        $this->notifyHR($leave);
        // set leave status
        $this->setLeaveStatus($leave);
        // save attachments
        $this->saveAttachments($request, $leave);

        toast($this->message('save', 'Leave record'), 'success', 'top-right');
        return redirect()->back();
    }

    public function saveTotalDaysTaken($leave)
    {
        $leave->days_taken = $this->getLeaveTotalDays($leave);
        $leave->save();
    }

    public function notifyHR($leave)
    {
        $user = User::find(1);
        $user->notify(new ApplyLeave($leave, $user, Auth::user()));
    }

    public function setLeaveStatus($leave)
    {
        $leave->setStatus('Leave Submission', 'Leave submitted for review');
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
        $leave = $this->leave->find($id);        
        if ($request->get('approve')) {
            $leave->setStatus('Leave application rejected', 'Leave approved by ' . Auth::user()->name);
            toast('Leave application approved successfully', 'success', 'top-right');
        }

        if ($request->get('reject')) {
            $leave->setStatus('Leave application rejected', 'Leave rejected by ' . Auth::user()->name);
            toast('Leave application rejected', 'success', 'top-right');
        }
        return redirect()->back();

    }

    public function destroy($id)
    {
        $this->leave->find($id)->delete();
        toast($this->message('delete', 'Leave record'), 'success', 'top-right');
        return back();
    }

}
