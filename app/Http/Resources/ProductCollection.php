<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($res){
                $data = [
                    'ProductId' => $res->id,
                    'SKU' => null,
                    'Name' => $res->product_name,
                    'Price' => $res->price,
                    'Discount' => $res->discounted,
                    'Created' => $res->created_at,
                    'Featured' => $res->featured,
                    'Best' => $res->best,
                    'Stock' => $res->in_stock,
                    'Image' => $res->thumbnail
                ];

                return $data;
            }),
            'status' => 200
        ];
    }
}
