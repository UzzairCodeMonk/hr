<?php

namespace Datakraf;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Modules\Profile\Entities\Family;
use Datakraf\Events\UserCreated;
use Datakraf\Events\UserUpdated;
use Modules\Leave\Entities\LeaveEntitlement;
use Modules\Leave\Entities\Leave;
use Modules\Profile\Entities\PersonalDetail;
use Modules\Profile\Entities\Position;
use Spatie\Activitylog\Traits\LogsActivity;
use Modules\Wage\Entities\Wage;
use Modules\Wage\Entities\Payslip;
use Sofa\Eloquence\Eloquence;

class User extends Authenticatable
{
    use Notifiable, HasRoles, Eloquence;

    protected $searchableColumns = ['name'];
    
    protected $dispatchesEvents = [
        'created' => UserCreated::class,
        'updated' => UserUpdated::class
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

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

    public function leaveEntitlement()
    {
        return $this->hasOne(LeaveEntitlement::class, 'user_id');
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class)
            ->orderBy('created_at', 'desc');
    }

    public function leaveApprovals()
    {
        return $this->belongsToMany(Leave::class, 'approver_leave', 'user_id', 'leave_id');
    }

    public function leaveApprovers()
    {
        return $this->belongsToMany(User::class, 'leaveapprover_user', 'user_id', 'approver_id');

    }
    public function personalDetail()
    {
        return $this->hasOne(PersonalDetail::class);
    }

    public function wages()
    {
        return $this->hasMany(Wage::class);
    }

    public function payslips()
    {
        return $this->hasMany(Payslip::class);
    }
}
