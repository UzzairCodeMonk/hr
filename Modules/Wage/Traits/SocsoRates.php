<?php

namespace Modules\Wage\Traits;

use DB;

trait SocsoRates
{

    public function getSocsoEmployeeContribution(int $basic_salary)
    {
        return DB::table('socsorates')->where('start_amount', '>', $basic_salary)->where('final_amount', '!=', $basic_salary)->first()->employee_contrib ?? 0.00;
    }

    public function getSocsoEmployerContribution(int $basic_salary)
    {
        return DB::table('socsorates')->where('start_amount', '>', $basic_salary)->where('final_amount', '!=', $basic_salary)->first()->employer_contrib ?? 0.00;
    }

}