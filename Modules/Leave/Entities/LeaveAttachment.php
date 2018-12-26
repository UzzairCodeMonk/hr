<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\Leave;

class LeaveAttachment extends Model
{
    protected $table = 'leaveattachments';
    protected $guarded = [];

    public function leave(){
        return $this->belongsTo(Leave::class,'leave_id');
    }
}
