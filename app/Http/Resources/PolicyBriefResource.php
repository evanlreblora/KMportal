<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PolicyBriefResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'filename' => $this->filename,
            'desc' => $this->desc,
            'unit' => $this->unit,
            'type' => $this->type,
            'uploader' => $this->uploader,
            'created_at' => $this->created_at,
            'filepath' => $this->filepath,

        ];

    }
}
