<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\Claim;
use Modules\Wage\Notifications\RemarkOnlyClaim;
use Modules\Wage\Notifications\ApproveClaim;
use Modules\Wage\Notifications\RejectClaim;

class ClaimApprovalsController extends Controller
{

    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $withdrawnStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';


    public function store(Request $request)
    {
        $this->approval($request);
        return redirect()->route('claim.records');
    }


    public function approval($request)
    {
        $claim = Claim::find($request->claim_id);

        switch ($request) {

            case $request->has('approve'):
                $this->setClaimStatus($claim, $this->approvedStatus, 'Claim application approved by ' . auth()->user()->personalDetail->name . '<br>' . $this->remarksExist($request));
                $claim->user->notify(new ApproveClaim($claim, $claim->user, auth()->user()));
                toast('Claim application approved successfully', 'success', 'top-right');
                break;
        
            case $request->has('reject'):
                $this->setClaimStatus($claim, $this->rejectedStatus, 'Claim application rejected by' . auth()->user()->personalDetail->name . '<br>' . $this->remarksExist($request));
                $claim->user->notify(new RejectClaim($claim, $claim->user, auth()->user()));
                toast('Claim application rejected', 'success', 'top-right');
                break;
        
            case $request->has('remarks'):
                $this->setClaimStatus($claim, $this->submittedStatus, auth()->user()->personalDetail->name . '<br>' . $this->remarksExist($request));
                $claim->user->notify(new RemarkOnlyClaim($claim, $claim->user, auth()->user()));
                toast('Remarks added to this claim application', 'success', 'top-right');
                break;
        
            default:
                break;
        }

        // return redirect()->back();
    }


    public function setClaimStatus($claim, $status, $message)
    {
        return $claim->setStatus($status,  $message);
    }

    public function remarksExist($request)
    {

        $remarksHeader = 'Comment: ';

        if (!empty($request->admin_remarks)) {
            return $remarksHeader . $request->admin_remarks;
        } else {
            return '';
        }
    }
}
