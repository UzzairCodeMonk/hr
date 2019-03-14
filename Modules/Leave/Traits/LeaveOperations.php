<?php 

namespace Modules\Leave\Traits;


trait LeaveOperations
{

    public $request;
    public $leave;

    
    public function daySelector($request, $leave)
    {
        if ($request->full_half == 1) {
            return $this->isHalfDay($request, $leave);
        } else {
            return $this->saveTotalDaysTaken($leave);
        }
    }


    public function isHalfDay($request, $leave)
    {
        $leave->days_taken = 0.5;
        $leave->period = $request->period;
        $leave->save();
    }
    
}
