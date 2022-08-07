<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;

class CategoryDeleteRequest extends CategoryRequest
{
    public function rules()
    {
        return []; // no rules for deleting
    }

    /**
     * deletes the category and it's thumbnail
     */
    public function delete(ProductCategory $category)
    {
        $this->deleteThumbnail($category);
        $category->children()->delete();
        return $category->delete();
    }
}
