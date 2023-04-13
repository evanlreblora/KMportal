<?php

namespace App\Http\Resources;

use App\Http\Resources\KmproductResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KmproductCollection extends ResourceCollection
{
    public $collects = KmproductResource::class;
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
