<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\Claim;


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
    }


    public function approval($request)
    {

        $claim = Claim::find($request->claim_id);

        switch ($request) {

            case $request->has('approve'):
                $this->setClaimStatus($claim, $this->submittedStatus, 'Claim application approved by ' . auth()->user()->personalDetail->name . '<br>' . $this->remarksExist($request));
                break;

            case $request->has('reject'):
                $this->setClaimStatus($claim, $this->rejectedStatus, 'Claim application rejected by' . auth()->user()->personalDetail->name . '<br>' . $this->remarksExist($request));
                break;

            case $request->has('remarks'):
                $this->setClaimStatus($claim, $this->submittedStatus, auth()->user()->personalDetail->name . '<br>' . $this->remarksExist($request));
                break;

            default:
                break;
        }

        return redirect()->back();
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
