<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;

class ClaimAttachment extends Model
{
    protected $guarded = [];
    protected $table = 'claimattachments';

    public function claimDetail(){
        return $this->belongsTo(ClaimDetail::class);
    }
}
