<?php

namespace Modules\Broadcast\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;

class Memo extends Model
{
    protected $table = 'memorandums';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
}
