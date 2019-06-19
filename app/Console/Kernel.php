<?php

namespace Datakraf\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Wage\Jobs\PayslipSummaryJob;
use Modules\Wage\Entities\Payslip;
use Modules\Wage\Entities\PayslipSummary;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $payslip=Payslip::all();
        $payslipsummary=PayslipSummary::all(); 
        $schedule->job(new PayslipSummaryJob($payslip,$payslipsummary))->monthlyOn(3,'17:00')->yearly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
