<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Wage\Entities\Payslip;
use Modules\Wage\Notifications\PayslipGenerated;
use Modules\Wage\Traits\WageCalculator;
use Modules\Wage\Traits\SocsoRates;
use Auth;
use PDF;
use Modules\Wage\Traits\EpfRates;
use Modules\Wage\Traits\HrdfRates;

class PayslipsController extends Controller
{
    use WageCalculator, SocsoRates, EpfRates, HrdfRates;

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
            'hrdf' => $request->hrdf,
            'income_tax' => $request->income_tax,
            'remarks' => $request->remarks,
        ];
    }

    public function index()
    {
        return view('wage::payslips.users', ['users' => $this->user->has('personalDetail')->get()]);
    }

    public function myPayslips()
    {
        $payslip = Payslip::where('user_id', auth()->id())->get();
        return view('wage::payslips.my-payslip', ['user' => Auth::user(), 'payslip' => $payslip]);
    }

    public function show(int $id)
    {
        $payslip = Payslip::where('user_id', $id)->get();
        $user = $this->user->find($id);
        $basic_salary = $this->getUserLatestSalary($id);
        $socso_employee_contrib = $this->getSocsoEmployeeContribution($basic_salary);
        $socso_employer_contrib = $this->getSocsoEmployerContribution($basic_salary);
        $epf_employee_contrib = $this->getEpfEmployeeContribution($user, $basic_salary);
        $epf_employer_contrib = $this->getEpfEmployerContribution($user, $basic_salary);
        $eis_employer_contrib = $this->getSipEmployerContribution($basic_salary);
        $eis_employee_contrib = $this->getSipEmployeeContribution($basic_salary);
        $hrdf = $this->getHrdfRate($basic_salary);

        return view('wage::payslips.show', [
            'user' => User::find($id),
            'payslip' => $payslip,
            'socso_employee_contrib' => $socso_employee_contrib,
            'socso_employer_contrib' => $socso_employer_contrib,
            'epf_employee_contrib' => $epf_employee_contrib,
            'epf_employer_contrib' => $epf_employer_contrib,
            'eis_employee_contrib' => $eis_employee_contrib,
            'eis_employer_contrib' => $eis_employer_contrib,
            'hrdf' => $hrdf,
            'basic_salary' => $basic_salary
        ]);
    }

    public function viewPayslip(int $id, $month, $year)
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
        $payslip->user->notify(new PayslipGenerated($payslip, $payslip->user, Auth::user()));
        toast('Payslip generated successfully', 'success', 'top-right');
        return back();
    }

    public function printPayslip(int $id, $month, $year)
    {
        $payslip = Payslip::where('user_id', $id)->where('month', $month)->where('year', $year)->first();
        $pdf = PDF::loadView('wage::payslips.payslip-pdf', compact('payslip'));
        $pdfName = $payslip->user->personalDetail->name . '-' . getMonthNameBasedOnInt($payslip->month) . '-' . $payslip->year;
        return $pdf->download($pdfName . '.pdf');
    }


    public function destroy($id)
    {
        Payslip::find($id)->delete();
        toast('Payslip deleted successfully', 'success', 'top-right');
        return back();
    }


}
