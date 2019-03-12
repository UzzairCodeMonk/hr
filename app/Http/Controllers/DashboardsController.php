<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Leave\Entities\Leave;
use Modules\Wage\Entities\Payslip;
class DashboardsController extends Controller
{
    
    public function index()
    {
        $leaveCount = Leave::currentStatus('submitted')->count();
        $payslipGenerated = Payslip::count();
        return view('backend.admin.dashboard',
        [
            'leaveCount' => $leaveCount,
            'payslipGenerated' => $payslipGenerated
        ]);

    }

}
