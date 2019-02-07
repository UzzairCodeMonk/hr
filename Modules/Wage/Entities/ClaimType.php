<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaimType extends Model
{
    protected $table = 'claimtypes';
    protected $guarded = [];

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }
}
