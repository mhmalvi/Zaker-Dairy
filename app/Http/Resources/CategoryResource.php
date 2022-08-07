<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'uuid' => $this->uuid,
            'slug' => $this->slug,
            'category' => $this->category,
            'parent' => $this->parent,
            'details' => $this->details,
            'thumbnail' => $this->getThumbnail(),
            'created_at' => $this->created_at,
        ];
    }
}
