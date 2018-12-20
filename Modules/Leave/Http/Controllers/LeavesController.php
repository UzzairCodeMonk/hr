<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Leave\Entities\LeaveType;
use Modules\Leave\Entities\Leave;
use Datakraf\Traits\AlertMessage;
use Datakraf\Notifications\ApplyLeave;
use Auth;

class LeavesController extends Controller
{
    use AlertMessage;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public $type;
    public $data;
    public $leave;
    public $user;

    public function __construct(Leave $leave, LeaveType $type, Request $request, User $user)
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
    }

    public function index()
    {
        $leaves = $this->leave->all();

        return view('leave::leave.admin.leave-records', compact('leaves'));
    }

    public function show($id)
    {
        return view('leave::leave.forms.show', ['leave' => $this->leave->find($id), 'types' => $this->type->all()]);
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
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $leave = $this->leave->create($this->data);
        $notifier = Auth::user();
        $user = User::find(1);
        $user->notify(new ApplyLeave($leave, $user, $notifier));
        toast($this->message('save', 'Leave record'), 'success', 'top-right');
        return redirect()->back();
    }

}
