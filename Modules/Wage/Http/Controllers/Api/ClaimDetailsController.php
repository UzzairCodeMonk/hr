<?php

namespace Modules\Wage\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\Claim;
use Modules\Wage\Entities\ClaimDetail;

class ClaimDetailsController extends Controller
{
    public function index(int $claimId)
    {
        $claim_details = Claim::find($claimId)->details;
        return response()->json($claim_details);
    }

    public function update(Request $request)
    {
        ClaimDetail::find($request->pk)->update([
            $request->name => $request->value
        ]);
        return response()->json(['success' => true]);
    }

    public function calculateClaimTotal(int $claimId)
    {

        $claim = ClaimDetail::where('claim_id', '=', $claimId)->pluck('amount');
        $claimTotal = collect($claim)->sum();

        Claim::find($claimId)->update([
            'amount' => $claimTotal
        ]);
        
        return response()->json(['success' => true,'total' => $claimTotal]);
    }
}
