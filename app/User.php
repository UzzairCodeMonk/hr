<?php

namespace Datakraf;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Modules\Profile\Entities\Family;
use Datakraf\Events\UserCreated;
use Modules\Leave\Entities\LeaveEntitlement;

class User extends Authenticatable
{
    use Notifiable,HasRoles;

    protected $dispatchesEvents = [
        'created' => UserCreated::class
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function leaveEntitlement(){
        return $this->hasOne(LeaveEntitlement::class,'user_id');
    }
}
