<?php

namespace App\Http\Requests;

use App\Models\Content;
use App\Services\ImageHandler;
use Illuminate\Foundation\Http\FormRequest;

class ContentsCreateRequest extends FormRequest
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
            'key' => 'required',
        ];
    }

    public function save()
    {
        
        if($this->key == 'terms_conditions' || $this->key == 'about_us'){
            
              Content::updateOrCreate([
                    'key' => $this->key,
                ], [
                    'value' => $this->value,
                ]);
            
        }
        
        if($this->key == 'about_us_image'){
                      
                if ($this->hasFile('value')) {
                   
                   $file = $this->value;
                   $imageName = time().'.'.$file->getClientOriginalExtension();
                   $path= 'assets/admin/img/content';
                   $file->move($path,$imageName);
                }
                
                   Content::updateOrCreate([
                    'key' => $this->key,
                ], [
                    'value' => $imageName ?? '',
                ]);
        }
      
        
      
    }

 /*   private function handleFile()
    {
        $image_handler = new ImageHandler();

        $image_handler->setImage($this->file('value'))
            ->setName('about_us')
            ->setPath('assets/img/about_us')
            ->setDimension(1200, 900);
            
        $this->value = $image_handler->storeFromImageData();
    }*/
}
