<?php

namespace Modules\Wage\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Wage\Entities\Payslip;
use Modules\Wage\Entities\PayslipSummary;
use Carbon\Carbon;

class PayslipSummaryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public $payslip;
    // public $payslipsummary;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($payslip,$payslipsummary)
    {
        //
        $this->payslip=$payslip;
        $this->payslipsummary=$payslipsummary;
        $today=Carbon::now();
        $today->year;

        // PayslipSummary::call(function(){
        for($m=1; $m<=12; ++$m){
            $payslipObject = $this->payslip->where('month',$m)->where('year',$today->year);
        foreach($payslipObject as $p){
            if($p->exists() && $p->month==$m){
                $payslip = $p->where('month',$m)->get()->toArray();

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
                    'month'=>$m,
                    'year'=>$today->year
                ],
                [
                    'month'=>$m,
                    'year'=>$today->year,
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
        }
       
    } 
    
    }
        // return $summaries->all();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    
    public function handle()
    {
        //
      
        // })->monthlyOn(3,'17:00')->yearly();

       
    }
}
