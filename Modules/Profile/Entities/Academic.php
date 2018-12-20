<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;
use Carbon\Carbon;

class Academic extends Model
{
    protected $table = 'academics';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
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
