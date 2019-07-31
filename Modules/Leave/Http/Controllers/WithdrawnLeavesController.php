<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Leave\Entities\Leave;
use Modules\Leave\Entities\LeaveType;
use Carbon\Carbon;
use Modules\Leave\Entities\LeaveEntitlement;
use Modules\Leave\Entities\LeaveBalance;

class WithdrawnLeavesController extends Controller
{
    /**
     * List withdrawn leaves
     * 
     * @return void
     */
    public function index()
    {
        return view('leave::leave.user.trashed', [
            'results' => Leave::onlyTrashed()
                ->where('user_id', auth()->id())
                ->orderBy('deleted_at', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show withdrawn leaves
     * 
     * @param int $id
     */

    public function show(int $id)
    {
        $leave = Leave::onlyTrashed()->where('id', $id)->first();
         //calculate prorated leave yg layak ambil ikut bulan
         $today = Carbon::now();
         $month = $today->month;
         $leaveentitle=LeaveEntitlement::where('user_id',$leave->user_id)->first();
         $day=$leave->user->leaveEntitlement->days;
        
         $prorated_leave=$day / 12 * $month;
         $available = number_format($prorated_leave);
         $leaveentitle->available_annualleave = $available;
         $leaveentitle->save();

        $balance =LeaveBalance::where('user_id',$leave->user_id)->where('leavetype_id',7)->exists();
        if($balance == true){
            $b = LeaveBalance::where('user_id',$leave->user_id)->where('leavetype_id',7)->first();
            $thismonth = $leaveentitle->available_annualleave - ($day - $b->balance);

            if($thismonth <= 0){
                $thismonth = 0 ;
            }

        }else{
            $thismonth = $leaveentitle->available_annualleave;
        }
        return view('leave::leave.user.show-trash', [
            'leave' => Leave::onlyTrashed()->where('id', $id)->first(),
            'types' => LeaveType::all(),
            'statuses' => Leave::onlyTrashed()->where('id', $id)->first()->statuses,
            'thismonth' => $thismonth
        ]);
    }
}
