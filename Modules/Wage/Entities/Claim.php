<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Datakraf\User;

class Claim extends Model
{
    protected $table = 'claims';
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(ClaimType::class, 'claimtype_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments()
    {
        return $this->hasMany(ClaimAttachment::class);
    }
    
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
}
