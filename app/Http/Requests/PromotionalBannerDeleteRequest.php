<?php

namespace App\Http\Requests;

use App\Models\PromotionalBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class PromotionalBannerDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    public function delete(PromotionalBanner $banner)
    {
        if ($banner) {
            $this->deleteImage($banner->image);
            $banner->delete();
        }
    }

    private function deleteImage($name)
    {
        Storage::delete("public/promotional_banners/" . $name);
    }
}
