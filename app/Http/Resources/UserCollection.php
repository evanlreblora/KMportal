<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    public $collects = UserResource::class;
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

// class Collection_AnnualReps extends ResourceCollection
// {
//     public $collects = AnnualReport::class;
//     /**
//      * Transform the resource collection into an array.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return array
//      */
//     public function toArray($request)
//     {
//         return parent::toArray($request);
//     }
// }


// class Collection_PolicyBrief extends ResourceCollection
// {
//     public $collects = PolicyBrief::class;
//     /**
//      * Transform the resource collection into an array.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @return array
//      */
//     public function toArray($request)
//     {
//         return parent::toArray($request);
//     }
// }