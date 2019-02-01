<?php
namespace Modules\Wage\Traits;
use Modules\Wage\Entities\PayslipSummary as PayslipSum;

trait PayslipSummary{


    public function generatePayslipSummary(array $request,int $month, int $year){
        
        PayslipSum::create([
            'month' => $request->month,
            'year' => $request->year
        ]);
        
    }

}