<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Charts;
use Modules\Leave\Entities\Leave;
use DB;

class LeaveDashboardController extends Controller
{
    public function index()
    {

        $leaves = Leave::all();

        $monthly = Charts::database($leaves, 'bar', 'highcharts')
            ->title("Leave Applications By Month")
            ->elementLabel("Total Leave Applications")
            ->responsive(true)
            ->groupByMonth(date('Y'), true);

        // $type = Leave::with('type')->get()->groupBy('type.name');

        // $byType = Charts::database($type, 'bar', 'highcharts')
        //     ->elementLabel('Leave Applications By Types')
        //     ->responsive(true);
            // ->groupByMonth(date('Y'), true)            

        return view('leave::leave.admin.dashboard', [
            'monthly' => $monthly,
            // 'byType' => $byType
        ]);
    }
}
