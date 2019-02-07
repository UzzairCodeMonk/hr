<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaimAttachment extends Model
{
    protected $guarded = [];
    protected $table = 'claimattachments';

    public function claim(){
        return $this->belongsTo(Claim::class);
    }
}
