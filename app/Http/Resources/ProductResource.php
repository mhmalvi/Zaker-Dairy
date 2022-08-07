<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'discount' => $this->discount,
            'discount_type' => $this->discount_type,
            'unit_qty' => $this->unit_qty,
            'unit' => $this->unit,
            'thumbnail' => $this->thumbnail,
            'thumbnail_path' => $this->thumbnail_path,
            'thumbnail_alt' => $this->thumbnail_alt,
            'description' => $this->description,
            'featured' => $this->featured,
            'publish' => $this->publish,
            'created_at' => $this->created_at,
        ];
    }
}
