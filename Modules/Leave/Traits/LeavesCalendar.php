<?php 


namespace Modules\Leave\Traits;
use Calendar;

trait LeavesCalendar
{

    public function makeCalendar($start_date, $end_date, $title = "Absent Dates", $bgColour = "#ff0000")
    {
        $event = [];

        $event[] = Calendar::event(
            $title,
            false,
            $this->setDateObject('d/m/Y', $start_date),
            $this->setDateObject('d/m/Y', $end_date),
            null,
            [
                'color' => $bgColour,
                'displayEventTime' =>  false,
                'themeSystem' => 'bootstrap4'
            ]
        );

        return Calendar::addEvents($event);
    }
}
