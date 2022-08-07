<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductCreateRequest extends ProductRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:products',
            'price' => 'required|integer',
            'discount' => 'integer',
            'unit_qty' => 'required',
            'thumbnail' => 'required|mimes:jpg,jpeg,png',
            'images.*' => 'mimes:jpg,jpeg,png'
        ];
    }

    public function save()
    {
        
      
        $slug = Str::slug($this->name);

        $product = Product::create([
            'name' => $this->name,
            'slug' => $slug,
            'category_id' => $this->category,
            'price' => $this->price,
            'discount' => $this->discount ? $this->discount() : 0.00,
            'discount_type' => $this->dType ? $this->dType : '',
            'unit_qty' => $this->unit_qty,
            'unit' => $this->unit,
            'thumbnail' => $this->hasFile('thumbnail') ? $this->thumbnail() : '',
            'thumbnail_alt' => $this->thumb_alt,
            'description' => $this->details,
            'featured' => $this->featured == 'on' ? 1 : 0,
            'publish' => $this->publish == 'on' ? 1 : 0
        ]);

        return $product;
    }
}
