<?php

namespace App\Http\Resources;

use App\Http\Resources\ProceedingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProceedingCollection extends ResourceCollection
{
    public $collects = ProceedingResource::class;
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
