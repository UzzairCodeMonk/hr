<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;

class Profile extends Model
{
    protected $fillable = [];
    

    public function user(){
        return $this->belongsTo(User::class);
    }
}
