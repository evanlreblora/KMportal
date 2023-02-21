<?php

namespace App\Http\Resources;

use App\Http\Resources\ProjectCompResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectCompCollection extends ResourceCollection
{
    public $collects = ProjectCompResource::class;
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
