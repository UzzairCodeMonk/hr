<?php

namespace Modules\Wage\Traits;

use Modules\Wage\Entities\Wage;
use Modules\Wage\Traits\UnpaidLeaves;

trait WageCalculator
{

    use UnpaidLeaves;


    public function getUserLatestSalary(int $id)
    {
        return Wage::where('user_id', $id)->orderBy('created_at', 'desc')->first()->wage ?? 0.00;
    }


    public function calculateTotalEarnings($request)
    {

        $basic_salary = $request->basic_salary;
        $allowance = $request->allowance;

        $totalEarnings = $basic_salary + $allowance;
        return $totalEarnings;
    }


    public function calculateTotalDeductions($request)
    {
        $epf_employee = $request->epf_employee;
        $socso_employee = $request->socso_employee;
        $socso_eis_employee = $request->socso_eis_employee;
        $income_tax = $request->income_tax;
        $hrdf = $request->hrdf;
        $upl = $this->getUnpaidLeaveDeductionAmount($request);
        $totalDeductions = $epf_employee + $socso_employee + $socso_eis_employee + $income_tax + $hrdf + $upl;
        return $totalDeductions;
    }

    public function getUnpaidLeaveDeductionAmount($request)
    {
        return ($this->getUserLatestSalary($request->user_id) / 26) * $this->getUnpaidLeaveDays($request);
    }


    public function calculateNetWage($request)
    {
        $totalEarnings = $this->calculateTotalEarnings($request);
        $totalDeductions = $this->calculateTotalDeductions($request);
        $totalNetWage = $totalEarnings - $totalDeductions;
        return $totalNetWage;
    }



}