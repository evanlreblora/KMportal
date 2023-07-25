<?php

namespace App\Http\Resources;

use App\Http\Resources\GofbudgetResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GofbudgetCollection extends ResourceCollection
{
    public $collects = GofbudgetResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
