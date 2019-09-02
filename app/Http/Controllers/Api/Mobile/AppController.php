<?php

namespace Datakraf\Http\Controllers\Api\Mobile;

use Illuminate\Http\Request;
use Datakraf\Http\Controllers\Controller;
use Modules\Leave\Entities\Leave;
use Illuminate\Http\Response;
use Datakraf\User;
use Auth;
use Modules\Profile\Entities\PersonalDetail;

class AppController extends Controller
{
    //
    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $retractedStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';

    public function leaveSubmitted(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->submittedStatus);
        return \Response::json($data);
    }

    public function leaveApproved(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->approvedStatus);
        return \Response::json($data);
    }

    public function leaveRejected(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->rejectedStatus);
        return \Response::json($data);
    }

    public function leaveWithdrawn(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->retractedStatus);
        return \Response::json($data);
    }

    //for auth user detail
    public function authUser(){
        $personalDetail = PersonalDetail::with('user','bank','position','center')->where('user_id', auth()->id())->first();
        return \Response::json($personalDetail);
    }

    public function leaveSubmittedByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->submittedStatus);
        return \Response::json($data);
    }

    public function leaveApprovedByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->approvedStatus);
        return \Response::json($data);
    }

    public function leaveRejectedByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->rejectedStatus);
        return \Response::json($data);
    }

    public function leaveWithdrawnByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->retractedStatus);
        return \Response::json($data);
    }

    




    

   
   
}
