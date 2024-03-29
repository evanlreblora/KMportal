<?php

namespace App\Http\Resources;

use App\Http\Resources\KbacourseResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KbacourseCollection extends ResourceCollection
{
    public $collects = KbacourseResource::class;
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
