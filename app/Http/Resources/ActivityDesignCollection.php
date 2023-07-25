<?php

namespace App\Http\Resources;

use App\Http\Resources\ActivityDesignResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityDesignCollection extends ResourceCollection
{
    public $collects = ActivityDesignResource::class;
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
