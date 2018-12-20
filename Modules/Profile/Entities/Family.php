<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Datakraf\User;
use Modules\Profile\Entities\FamilyType;

class Family extends Model
{
    protected $table = 'families';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(FamilyType::class,'relationship_id');
    }
}
