<?php

namespace Modules\Leave\Exports;

use Modules\Leave\Entities\Leave;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserLeavesExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    
    public function __construct(Leave $leave){
        $this->leave = $leave->where('user_id',$this->id)->get();
    }
    public $leave = $this->leave;

    public function forUser(int $id)
    {
        $this->id = $id;

        return $this;
    }

    public function headings() : array
    {
        return [
            'Leave Type',
            'Start Data',
            'End Date',
            'Days Taken',
            'Notes',
            'Applied Date',
        ];
    }

    public function map($leave) : array
    {        
        return [
            $leave->leavetype_id,
            Date::dateTimeToExcel($leave->start_date),
            Date::dateTimeToExcel($leave->end_date),
            $leave->days_taken,
            $leave->notes,
            Date::dateTimeToExcel($leave->created_at),
        ];
    }


    public function query()
    {
        Leave::query()->where('user_id', $this->id);
    }

    public function getColumns($id)
    {
        return Leave::where('user_id', $id)->get();
    }

}
