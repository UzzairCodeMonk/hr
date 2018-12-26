<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\LeaveType;
use Modules\Leave\Entities\LeaveAttachment;
use Carbon\Carbon;
use Datakraf\User;
use Spatie\ModelStatus\HasStatuses;

class Leave extends Model
{
    use HasStatuses;

    protected $table = 'leaves';
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leavetype_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments()
    {
        return $this->hasMany(LeaveAttachment::class);
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getStartDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getEndDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
}
