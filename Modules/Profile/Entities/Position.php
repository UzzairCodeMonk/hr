<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Profile\Entities\PersonalDetail;

class Position extends Model
{
    protected $guarded = [];
    protected $table = 'positions';

    public function personalDetail()
    {
        return $this->hasOne(PersonalDetail::class);
    }
}
