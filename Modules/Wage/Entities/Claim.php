<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Wage\Entities\ClaimDetail;
use Datakraf\User;
use Spatie\ModelStatus\HasStatuses;

class Claim extends Model
{
    use HasStatuses;
    
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
