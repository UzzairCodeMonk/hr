<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\Claim;
use Datakraf\Notifications\SubmitClaimToAdminNotification;
use Datakraf\User;
use Auth;

class ClaimSubmissionsController extends Controller
{
    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $withdrawnStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';


    public function store(Request $request){

        $claim = Claim::find($request->claim_id);

        $this->notifyHR(new SubmitClaimToAdminNotification($claim, $claim->user));

        $claim->setStatus($this->submittedStatus, 'Claim submitted for review');

        toast('Claim submitted', 'success', 'top-right');

        return redirect()->route('claim.myclaims', ['status' => 'submitted']);
        
    }


    public function notifyHR($notification)
    {       
                
        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();         

        foreach ($admins as $admin) {
            $admin->notify($notification);
        }
    }

}
