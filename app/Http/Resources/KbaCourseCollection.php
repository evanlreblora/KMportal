<?php

namespace App\Http\Resources;

use App\Http\Resources\KbaCourseResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KbaCourseCollection extends ResourceCollection
{
    public $collects = KbaCourseResource::class;
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
