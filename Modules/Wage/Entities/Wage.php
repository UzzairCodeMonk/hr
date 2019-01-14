<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;

class Wage extends Model
{
    protected $table = 'wages';
    protected $guarded = [];

    public function user(){
        $this->belongsTo(User::class);
    }
}
