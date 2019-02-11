<?php

namespace Datakraf;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $guarded = [];
    protected $table = 'days';

    public function centers(){
        return $this->belongsToMany(Center::class,'center_holiday','day_id','center_id');
    }
}
