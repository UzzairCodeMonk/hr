<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\Day;
use Modules\Profile\Entities\PersonalDetail;

class Center extends Model
{
    protected $guarded = [];

    protected $table = 'centers';

    public function holidays(){
        return $this->belongsToMany(Day::class,'center_holiday','center_id','day_id');
    }

    public function personaldetails(){
        return $this->hasMany(PersonalDetail::class);
    }
}
