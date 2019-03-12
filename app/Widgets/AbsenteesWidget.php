<?php

namespace Datakraf\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;
use Modules\Leave\Entities\Leave;


class AbsenteesWidget extends AbstractWidget
{    
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $sevenDaysAhead = Carbon::now()->addDays(7)->format('Y-m-d');
        
        $absentees = Leave::whereBetween('start_date',[$currentDate,$sevenDaysAhead])->orderBy('start_date','asc')->get();
        

        return view('widgets.absentees_widget', [
            'config' => $this->config,
            'absentees' => $absentees
        ]);
    }
}
