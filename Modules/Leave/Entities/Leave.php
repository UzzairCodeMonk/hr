<?php

namespace Modules\Leave\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\LeaveType;
use Modules\Leave\Entities\LeaveAttachment;
use Carbon\Carbon;
use Datakraf\User;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Leave\Traits\LeaveStatus;
use Modules\Leave\Traits\Date;

class Leave extends Model
{
    use HasStatuses, SoftDeletes, LeaveStatus, Date;

    protected $table = 'leaves';
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    
    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leavetype_id');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function attachments()
    {
        return $this->hasMany(LeaveAttachment::class);
    }

    
    public function scopeLeaveStatus($query, $status = null){
        
        if($status != null){
            return $query->where('user_id', auth()->id())->currentStatus($status)->orderBy('created_at','desc')->get();
        }

        return $query->where('user_id', auth()->id())->orderBy('created_at','desc')->get();
        
    }

    
    public function scopeAdminLeaveStatus($query, $status = null){
        
        if($status != null){
            return $query->currentStatus($status)->orderBy('created_at','desc')->get();
        }
        return $query->orderBy('created_at','desc')->get();

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
