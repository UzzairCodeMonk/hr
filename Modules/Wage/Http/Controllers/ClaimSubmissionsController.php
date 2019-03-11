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
    
    public function store(Request $request){

        $claim = Claim::find($request->claim_id);

        $this->notifyHR(new SubmitClaimToAdminNotification($claim, $claim->user));

        toast('Claim submitted', 'success', 'top-right');

        return redirect()->back();
        
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
