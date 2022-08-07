<?php

namespace App\Http\Requests;

use App\Models\HomeSlider;
use Illuminate\Support\Str;

class HomeSlidersUpdateRequest extends HomeSlidersRequest
{
    public function update(HomeSlider $home_slider)
    {
        $home_slider->title = $this->title;
        $home_slider->subtitle = $this->subtitle;
        $home_slider->button_text = $this->button_text;
        $home_slider->button_link = $this->button_link;

        if (substr($this->image, 0, 4) != "http" && $this->image) {
            if ($home_slider->image) {
                $this->deleteImage($home_slider->image);
            }
            $home_slider->image = $this->saveImage(time() . "_" . Str::slug($this->title));
        }

        $home_slider->save();
    }
}
