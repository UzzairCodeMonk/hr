<?php

namespace Datakraf\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Carbon\Carbon;
use Modules\Leave\Entities\Leave;

class Absentees extends AbstractWidget
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
        $date = Carbon::now()->format('Y-m-d');
        $absentees = Leave::where('start_date',$date)->get();
        
        if($absentees->count() > 1){
            return null;
        }    
        return view('widgets.absentees', [
            'config' => $this->config,
            'absentees' => $absentees
        ]);
    }
}
