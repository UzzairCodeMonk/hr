<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Wage\Entities\Payslip;
use Datakraf\Notifications\PayslipGeneratedNotification;
use Modules\Wage\Traits\WageCalculator;
use Modules\Wage\Traits\SocsoRates;
use Auth;
use PDF;
use Modules\Wage\Traits\EpfRates;
use Modules\Wage\Traits\HrdfRates;
use Carbon\Carbon;
use Modules\Leave\Entities\Leave;
use Modules\Wage\Entities\PayslipSummary;
use Modules\Wage\Jobs\PayslipSummaryJob;

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
        return view('wage::payslips.users', ['users' => 
        $this->user->with("personalDetail")->get()->where("personalDetail.status","!=","resigned")->sortBy('personalDetail.staff_number')->values()->all()
        ]);
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
            'basic_salary' => $basic_salary,
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
        $payslip->upl_days = $this->getUnpaidLeaveDays($request);
        $payslip->upl_amount = $this->getUnpaidLeaveDeductionAmount($request);
        $payslip->save();

        $payslip->user->notify(new PayslipGeneratedNotification($payslip, $payslip->user, Auth::user()));
        toast('Payslip generated successfully', 'success', 'top-right');
        return back();
    }

    public function printPayslip(int $id, $month, $year)
    {
        $payslip = Payslip::where('user_id', $id)->where('month', $month)->where('year', $year)->first();        
        return view('wage::payslips.pdf', ['payslip' => $payslip]);        
    }

    public function showPayslipSummaryForm(Request $request){
       
        $today=Carbon::now();
        $summaries1 = PayslipSummary::all();
        $payslip=Payslip::all();
        //auto generate payslip summary
        $summaries2=PayslipSummaryJob::dispatch($payslip,$summaries1)->onConnection('database');;
        if($summaries2){
            $summaries = PayslipSummary::orderBy('month','desc')->get();
        }
        return view('wage::payslips.summary-form',compact('summaries'));
    }
    public function destroy($id)
    {
        Payslip::find($id)->delete();
        toast('Payslip deleted successfully', 'success', 'top-right');
        return back();
    }

    public function generatePayslipSummary(Request $request){

        $payslipObject = Payslip::where('month',$request->month)->where('year',$request->year);

        if($payslipObject->exists()){
            $payslip = $payslipObject->get()->toArray();

        $payslipRecords = [
            'basic_salary' => array_sum(array_column($payslip, 'basic_salary')),
            'upl_amount' => array_sum(array_column($payslip, 'upl_amount')),
            'allowance' => array_sum(array_column($payslip, 'allowance')),
            'epf_employer' => array_sum(array_column($payslip, 'epf_employer')),
            'epf_employee' => array_sum(array_column($payslip, 'epf_employee')),
            'socso_employer' => array_sum(array_column($payslip, 'socso_employer')),
            'socso_employee' => array_sum(array_column($payslip, 'socso_employee')),
            'socso_eis_employer' => array_sum(array_column($payslip, 'socso_eis_employer')),
            'socso_eis_employee' => array_sum(array_column($payslip, 'socso_eis_employee')),
            'net_wage' =>  array_sum(array_column($payslip, 'net_wage'))
        ];
        $employer_costings = [
            $payslipRecords['basic_salary'],
            $payslipRecords['epf_employer'],
            $payslipRecords['socso_employer'],
            $payslipRecords['socso_eis_employer'],
            $payslipRecords['allowance']
        ];
        $total = array_sum($employer_costings);       

        PayslipSummary::updateOrCreate(
            [
                'month'=>$request->month,
                'year'=>$request->year
            ],
            [
                'month' => $request->month,
                'year' => $request->year,
                'basic_of_month' => $payslipRecords['basic_salary'],
                'allowance' => $payslipRecords['allowance'],
                'epf_employer' => $payslipRecords['epf_employer'],
                'epf_employee' => $payslipRecords['epf_employee'],
                'socso_employer' =>$payslipRecords['socso_employer'],
                'socso_employee' =>$payslipRecords['socso_employee'],
                'eis_employer' =>$payslipRecords['socso_eis_employer'],
                'eis_employee' =>$payslipRecords['socso_eis_employee'],
                'net_wage'  => $payslipRecords['net_wage'],
                'employer_expenses' => $total
        ]);
        toast('Payslip summary generated successfully','success','top-right');
        return back();
        }
        toast('Payslip for '.getMonthNameBasedOnInt($request->month).' '.$request->year.' can\'t be generated','error','top-right');
        return back();
    }

    public function showPayslipSummary(int $month, int $year){
        $summary = PayslipSummary::where('month',$month)->where('year',$year)->first();
        $payslips = Payslip::where('month',$month)->where('year',$year)->get();
        return view('wage::payslips.show-summary',compact('summary','payslips'));
    }

    public function printPayslipSummary(int $month, int $year){
        $summary = PayslipSummary::where('month',$month)->where('year',$year)->first();
        $payslips = Payslip::where('month',$month)->where('year',$year)->get();
        return view('wage::payslips.summary-pdf',compact('summary','payslips'));
    }

    public function exportPDF(int $month, int $year)
    {
        $summary = PayslipSummary::where('month',$month)->where('year',$year)->first();
        $payslips = Payslip::where('month',$month)->where('year',$year)->get();
        // Fetch all customers from database
        $data = PayslipSummary::get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('wage::payslips.summary-payslip', compact('payslips','summary'));
        // If you want to store the generated pdf to the server then you can use the store function
        $pdf->save(storage_path('app\public\form'.'summary-payslip.pdf'));
        // Finally, you can download the file using download function
        return $pdf->download('summary-payslip.pdf');
    }
    //delete summary payslip
    public function destroySummary($id)
    {
        $payslipsummary=PayslipSummary::find($id);
        $payslip=Payslip::where('month',$payslipsummary->month)->get();
        foreach($payslip as $p){
            $p->delete();
        }
        $payslipsummary->delete();

        toast('Payslip Summary deleted successfully', 'success', 'top-right');
        return back();
    }

}
