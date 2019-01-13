<?php

namespace Modules\Wage\Traits;

use DB;
use Carbon\Carbon;

trait EpfRates
{
    protected $age = 60;

    public function EmployeeCurrentAge($user)
    {
        $dateOfBirth = Carbon::createFromFormat('d/m/Y', $user->personalDetail->date_of_birth)->format('Y-m-d');
        return Carbon::parse($dateOfBirth)->age;
    }

    public function getEpfEmployeeContribution($user, int $basic_salary)
    {
        // if employee current age exceeds or equals to 60
        return $this->EmployeeCurrentAge($user) >= $this->age ? 
        // return employee_contribution_60 column
        DB::table('epfrates')->where('min_salary', '>', $basic_salary)->where('max_salary', '!=', $basic_salary)->first()->employee_contribution_60 ?? 0.00 :
        // else return normal employee_contribution column
        DB::table('epfrates')->where('min_salary', '>', $basic_salary)->where('max_salary', '!=', $basic_salary)->first()->employee_contribution ?? 0.00;

    }

    public function getEpfEmployerContribution($user, int $basic_salary)
    {
        // if employee current age exceeds or equals to 60
        return $this->EmployeeCurrentAge($user) >= $this->age ?
        // return employer_contribution_60 column
        DB::table('epfrates')->where('min_salary', '>', $basic_salary)->where('max_salary', '!=', $basic_salary)->first()->employer_contribution_60 ?? 0.00 :
         // else return normal employer_contribution column
        DB::table('epfrates')->where('min_salary', '>', $basic_salary)->where('max_salary', '!=', $basic_salary)->first()->employer_contribution ?? 0.00;

    }
}