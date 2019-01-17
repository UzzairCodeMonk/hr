<?php 

namespace Modules\Wage\Traits;
use Modules\Leave\Entities\Leave;
use Carbon\Carbon;

trait UnpaidLeaves
{

    public function findUnpaidLeave($request)
    {
        $now = Carbon::now();
        $year = $now->format('Y');        
        return Leave::whereHas('type', function ($query) {
            $query->where('name', '=', 'Unpaid Leave');
        })->whereMonth('start_date', $request->month)->whereYear('start_date', $year)->where('user_id', $request->user_id)->get();
    }

    public function getUnpaidLeaveDays($request)
    {
        $upl = $this->findUnpaidLeave($request);
        return collect($upl)->sum('days_taken');
    }


}