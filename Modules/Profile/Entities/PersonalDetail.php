<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;
use Modules\Profile\Events\PersonalDetailCreated;
use Modules\Profile\Entities\Position;
use Carbon\Carbon;

class PersonalDetail extends Model
{
    protected $table = 'personaldetails';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function setDateOfBirthAttribute($value)
    {
        if ($value != '') {
            $this->attributes['date_of_birth'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
        }
    }
    public function getDateOfBirthAttribute($value)
    {
        if ($value != '') {
            return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
        }
    }
    public function setDateOfMarriageAttribute($value)
    {
        if ($value != '') {
            $this->attributes['date_of_marriage'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
        }

    }
    public function getDateOfMarriageAttribute($value)
    {
        if ($value != '') {
            return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
        }

    }
}
