<?php

namespace App\Http\Resources;

use App\Http\Resources\PublicationResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PublicationCollection extends ResourceCollection
{
    public $collects = PublicationResource::class;
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
