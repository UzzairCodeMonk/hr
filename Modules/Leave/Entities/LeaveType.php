<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\Leave;

class LeaveType extends Model
{
    protected $table = 'leavetypes';
    protected $guarded = [];

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
}
