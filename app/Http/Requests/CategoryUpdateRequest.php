<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use App\Services\ImageHandler;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryUpdateRequest extends CategoryRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->slug = Str::slug($this->slug);
        $category = ProductCategory::where('uuid', $this->uuid)->firstOrFail();
        return [
            'category' => 'required',
            'slug' => 'required|unique:product_categories,slug,' . $category->id
        ];
    }

    public function update(ProductCategory $category)
    {
        $category->update([
            'category' => $this->category,
            'slug' => $this->slug,
            'details' => $this->details,
        ]);

        // check if user has updated the thumbnail
        if ($this->filled('thumbnail') && substr($this->thumbnail, 0, 4) != 'http') {
            if ($category->thumbnail != null) {
                $this->deleteThumbnail($category);
            }
            $image_handler = new ImageHandler();
            $image_handler->setPath("categories")
                ->setImage($this->thumbnail)
                ->setName($category->uuid . '_' . $this->slug)
                ->setDimension(100, 100);

            $this->thumbnail = $image_handler->storeFromImageData();
            $category->update([
                'thumbnail' => $this->thumbnail,
            ]);
        } else if (!$this->thumbnail && $category->thumbnail) {
            $this->deleteThumbnail($category);
            $category->update([
                'thumbnail' => null
            ]);
        }
        return $category;
    }
}
