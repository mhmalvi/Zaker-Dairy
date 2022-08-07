<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use App\Services\ImageHandler;
use Illuminate\Support\Str;

class CategoryCreateRequest extends CategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->slug = Str::slug($this->slug);
        return [
            'category' => 'required',
            'slug' => 'required|unique:product_categories'
        ];
    }


    public function save()
    {
        $parent = null;
        if ($this->filled('parent_id')) {
            $parent = ProductCategory::where('uuid', $this->parent_id)->first();
            if (!$parent) {
                throw new \Exception('Parent category not found');
            }
        }

        $uuid = uniqid() . "-" . Str::random(4);

        if ($this->filled('thumbnail')) {
            $image_handler = new ImageHandler();
            $image_handler->setPath("categories")
                ->setImage($this->thumbnail)
                ->setName($uuid . '_' . $this->slug)
                ->setDimension(100, 100);
            $this->thumbnail = $image_handler->storeFromImageData();
        }

        return ProductCategory::create([
            'uuid' => $uuid,
            'category' => $this->category,
            'parent_id' => $parent ? $parent->id : null,
            'slug' => $this->slug,
            'details' => $this->details,
            'thumbnail' => $this->thumbnail,
        ]);
    }
}
