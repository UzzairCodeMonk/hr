<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;

class LeaveEntitlement extends Model
{
    protected $table = 'leave_entitlements';
    protected $guarded = [];
}
