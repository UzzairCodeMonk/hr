<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;
use Carbon\Carbon;

class Award extends Model
{
    protected $table = 'awards';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setReceivedDateAttribute($value)
    {
        $this->attributes['received_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getReceivedDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
}
