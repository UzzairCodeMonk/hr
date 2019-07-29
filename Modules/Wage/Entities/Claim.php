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
    //asing ikut status
    public function scopeAdminClaimStatus($query, $status = null)
    {

        if ($status != null) {
            return $query->currentStatus($status)->orderBy('created_at', 'desc')->get();
        }
        return $query->orderBy('created_at', 'desc')->get();
    }

    public function scopeClaimStatus($query, $status = null)
    {

        if ($status != null) {
            return $query->where('user_id', auth()->id())->currentStatus($status)->orderBy('created_at', 'desc')->get();
        }

        return $query->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    }
}
