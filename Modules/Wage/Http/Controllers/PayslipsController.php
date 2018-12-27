<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Wage\Entities\Payslip;

class PayslipsController extends Controller
{
    public $user;
    public $data;

    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->data = [
            'user_id' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year,
            'basic_salary' => $request->basic_salary,
            'allowance' => $request->allowance,
            'epf_employer' => $request->epf_employer,
            'epf_employee' => $request->epf_employee,
            'socso_employer' => $request->socso_employer,
            'socso_employee' => $request->socso_employee,
            'socso_eis_employer' => $request->socso_eis_employer,
            'socso_eis_employee' => $request->socso_eis_employee,
            'income_tax' => $request->income_tax,
            'remarks' => $request->remarks,
        ];
    }

    public function index()
    {
        return view('wage::payslips.users', ['users' => $this->user->all()]);
    }

    public function show($id)
    {
        $payslip = Payslip::where('user_id', $id)->get();
        return view('wage::payslips.show', ['user' => User::find($id), 'payslip' => $payslip]);
    }

    public function viewPayslip($id, $month, $year)
    {
        $payslip = Payslip::where('user_id', $id)->where('month', $month)->where('year', $year)->first();
        return view('wage::payslips.payslip', ['payslip' => $payslip]);
    }
    public function generatePayslip(Request $request)
    {
        $payslip = Payslip::create($this->data);
        $payslip->total_earnings = $this->calculateTotalEarnings($request);
        $payslip->total_deductions = $this->calculateTotalDeductions($request);
        $payslip->net_wage = $this->calculateNetWage($request);
        $payslip->save();
        toast('payslip generated', 'success', 'top-right');
        return back();

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

        $totalDeductions = $epf_employee + $socso_employee + $socso_eis_employee + $income_tax;
        return $totalDeductions;
    }

    public function calculateNetWage($request)
    {
        $totalEarnings = $this->calculateTotalEarnings($request);
        $totalDeductions = $this->calculateTotalDeductions($request);
        $totalNetWage = $totalEarnings - $totalDeductions;
        return $totalNetWage;
    }

}
