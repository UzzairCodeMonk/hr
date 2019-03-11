<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Wage\Entities\ClaimDetail;
use Datakraf\User;

class Claim extends Model
{
    protected $table = 'claims';
    protected $guarded = [];    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }    
    
    public function details(){
        return $this->hasMany(ClaimDetail::class);
    }
}
