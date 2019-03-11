<?php

namespace Modules\Wage\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Wage\Entities\ClaimDetail;

class ClaimAttachment extends Model
{
    protected $guarded = [];
    protected $table = 'claimattachments';

    public function claimdetail(){
        return $this->belongsTo(ClaimDetail::class);
    }
}
