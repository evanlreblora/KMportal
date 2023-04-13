<?php

namespace App\Http\Resources;

use App\Http\Resources\AboResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AboCollection extends ResourceCollection
{
    public $collects = AboResource::class;
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
