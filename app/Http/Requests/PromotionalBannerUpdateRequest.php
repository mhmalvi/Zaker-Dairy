<?php

namespace App\Http\Requests;

use App\Models\PromotionalBanner;
use App\Services\ImageHandler;
use Illuminate\Foundation\Http\FormRequest;

class PromotionalBannerUpdateRequest extends FormRequest
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
        return [
            'image_1' => 'unique:promotional_banners,image',
            'image_2' => 'unique:promotional_banners,image',
        ];
    }

    // save the banner image in request
    public function save()
    {
        if ($this->image_1) {
            PromotionalBanner::updateOrCreate(
                ['name' => "banner_1"],
                ['image' => $this->saveImage(time() . "_banner_1", $this->image_1, [730, 140])]
            );
        }

        if ($this->image_2) {
            PromotionalBanner::updateOrCreate(
                ['name' => "banner_2"],
                ['image' => $this->saveImage(time() . "_banner_2", $this->image_2, [350, 140])]
            );
        }
    }

    private function saveImage(string $banner, $image, $dimensions)
    {
        $image_handler = new ImageHandler();
        $image_handler->setName($banner)
            ->setPath("promotional_banners")
            ->setImage($image)
            ->setDimension(...$dimensions);
        return $image_handler->storeFromImageData();
    }

    private function isNewImage()
    {
        if (substr($this->image, 0, 4) == 'http') {
            return false;
        }
        return true;
    }
}
