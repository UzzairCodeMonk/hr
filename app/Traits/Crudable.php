<?php

namespace Datakraf\Traits;

use Illuminate\Database\Eloquent\Model;

trait Crudable
{


    /**
     * Bulk upload
     *
     * @param [type] $request
     * @param [type] $app
     * @return boolean
     */
    public function bulkUpload($request, $parentModel, int $value, $relationship)
    {
        return $parentModel::find($value)->$relationship()->createMany([$request->all]);
        
    }
}