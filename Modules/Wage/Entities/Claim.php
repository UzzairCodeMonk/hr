<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Datakraf\User;

class Claim extends Model
{
    protected $table = 'claims';
    protected $guarded = [];    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }        
}
