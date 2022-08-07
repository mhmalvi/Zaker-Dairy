<?php

namespace App\Http\Requests;

use App\Services\ImageHandler;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class HomeSlidersRequest extends FormRequest
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
            'title'         => "required",
            'subtitle'      => 'required',
            'button_text'   => 'required',
            'button_link'   => 'required',
            'image'         => 'required',
        ];
    }

    protected function saveImage($name)
    {
        $image_handler = new ImageHandler();

        $image_handler->setDimension(1280, 800)
            ->setName($name)
            ->setPath('home_sliders')
            ->setImage($this->image);
        return $image_handler->storeFromImageData();
    }

    protected function deleteImage($name)
    {
        Storage::delete("public/home_sliders/" . $name);
    }
}
