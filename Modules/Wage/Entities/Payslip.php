<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;

class Payslip extends Model
{
    protected $table = 'payslips';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
