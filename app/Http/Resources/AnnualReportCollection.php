<?php

namespace App\Http\Resources;

use App\Http\Resources\AnnualReportResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AnnualReportCollection extends ResourceCollection
{
    public $collects = AnnualReportResource::class;
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
