<?php

namespace App\Http\Resources;

use App\Http\Resources\AbdResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AbdCollection extends ResourceCollection
{
    public $collects = AbdResource::class;
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
