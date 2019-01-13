<?php

namespace Modules\Wage\Traits;

use DB;

trait SocsoRates
{

    public function getSocsoEmployeeContribution(int $basic_salary)
    {
        return DB::table('socsorates')->where('min_salary', '>', $basic_salary)->where('max_salary', '!=', $basic_salary)->first()->employee_contribution ?? 0.00;
    }

    public function getSocsoEmployerContribution(int $basic_salary)
    {
        return DB::table('socsorates')->where('min_salary', '>', $basic_salary)->where('max_salary', '!=', $basic_salary)->first()->employer_contribution ?? 0.00;
    }

}