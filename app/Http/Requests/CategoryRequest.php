<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    protected function deleteThumbnail(ProductCategory $category)
    {
        Storage::delete('public/categories/' . $category->thumbnail);
    }
}
