<?php

namespace Modules\Site\Entities;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'siteconfigs';
    protected $guarded = [];
}
