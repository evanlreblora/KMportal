<?php

namespace App\Http\Resources;

use App\Http\Resources\BimgbdoxResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BimgbdoxCollection extends ResourceCollection
{
    public $collects = BimgbdoxResource::class;
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
