<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;
use Carbon\Carbon;

class Experience extends Model
{
    protected $table = 'experiences';
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