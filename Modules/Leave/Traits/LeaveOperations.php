<?php 

namespace Modules\Leave\Traits;


trait LeaveOperations
{


    public function daySelector($request, $leave)
    {
        if ($request->full_half == 1) {
            $this->isHalfDay($request, $leave);
        } else {
            $this->saveTotalDaysTaken($leave);
        }
    }


    public function isHalfDay($request, $leave)
    {
        $leave->days_taken = 0.5;
        $leave->period = $request->period;
        $leave->save();
    }
}
