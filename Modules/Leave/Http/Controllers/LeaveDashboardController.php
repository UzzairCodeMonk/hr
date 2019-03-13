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

        $users = Leave::all();

        $chart = Charts::database($users, 'bar', 'highcharts')

            ->title("Leave Applications By Month")

            ->elementLabel("Total Leave Applications")           

            ->responsive(true)

            ->groupByMonth(date('Y'), true);

        return view('leave::leave.admin.dashboard', [
            'chart' => $chart
        ]);
    }
}
