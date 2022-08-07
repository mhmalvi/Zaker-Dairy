<?php

namespace App\Http\Requests;

use App\Models\HomeSlider;

class HomeSlidersDeleteRequest extends HomeSlidersRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function delete(HomeSlider $homeSlider)
    {
        $this->deleteImage($homeSlider);

        $homeSlider->delete();
    }
}
