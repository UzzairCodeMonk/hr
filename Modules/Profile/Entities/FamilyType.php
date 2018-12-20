<?php

namespace Modules\Profile\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Profile\Entities\Family;

class FamilyType extends Model
{
    protected $table = 'familytypes';
    protected $guarded = [];

    public function family()
    {
        return $this->hasMany(Family::class);
    }
}
