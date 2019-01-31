<?php

namespace Modules\Wage\Traits;

use DB;

trait SocsoRates
{

    public function getSocsoEmployeeContribution(int $basic_salary)
    {
        // when salary greater than 1200 but not exceed 1500
        return DB::table('socsorates')->whereRaw($basic_salary.' BETWEEN min_salary and max_salary')->first()->employee_contribution ?? 0.00;
    }

    public function getSocsoEmployerContribution(int $basic_salary)
    {
        return DB::table('socsorates')->whereRaw($basic_salary.' BETWEEN min_salary and max_salary')->first()->employer_contribution ?? 0.00;
    }

}