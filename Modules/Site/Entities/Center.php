<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\Day;

class Center extends Model
{
    protected $guarded = [];

    protected $table = 'centers';

    public function holidays(){
        return $this->belongsToMany(Day::class,'center_holiday','center_id','day_id');
    }
}
