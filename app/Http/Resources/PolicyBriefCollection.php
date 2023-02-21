<?php

namespace App\Http\Resources;

use App\Http\Resources\PolicyBriefResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PolicyBriefCollection extends ResourceCollection
{
    public $collects = PolicyBriefResource::class;
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

