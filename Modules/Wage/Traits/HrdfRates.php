<?php

namespace Modules\Wage\Traits;

use DB;

trait HrdfRates{

    // 1% of the basic salary
    protected $rate = 0.01;

    public function getHrdfRate($basic_salary){
        return $basic_salary * $this->rate ?? 0.00;
    }

}