<?php

namespace Datakraf\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BanksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->resource['name'],            
        ];
    }
}
