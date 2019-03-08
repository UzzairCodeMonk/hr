<?php

namespace Modules\Leave\Traits;

use Carbon\Carbon;

trait Date
{

    public function setDateObject($value)
    {
        return Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }

    public function getDiffDays($df, $dt)
    {
        return Carbon::parse($df)->diffInDays(Carbon::parse($dt));
    }    

    public function getLeaveTotalDays($leave)
    {
        $df = $this->setDateObject($leave->start_date);
        $dt = $this->setDateObject($leave->end_date);
        return $this->getDiffDays($df, $dt) + 1;
    }
    
    
}