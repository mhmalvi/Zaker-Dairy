<?php

namespace App\Http\Requests;

use App\Models\HomeSlider;
use Illuminate\Support\Str;

class HomeSlidersCreateRequest extends HomeSlidersRequest
{
    public function save()
    {
        
        dd($this->all());
        $homeSlider = new HomeSlider();

        $homeSlider->title = $this->title;
        $homeSlider->subtitle = $this->subtitle;
        $homeSlider->button_text = $this->button_text;
        $homeSlider->button_link = $this->button_link;
        $homeSlider->image = $this->saveImage(time() . "_" . Str::slug($this->title));

        $homeSlider->save();
    }
}
