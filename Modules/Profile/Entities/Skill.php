<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;

class Skill extends Model
{
    protected $table = 'skills';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
