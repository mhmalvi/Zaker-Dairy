<?php

namespace App\Http\Requests;

use App\Models\WebsiteIdentity;
use App\Services\ImageHandler;
use Illuminate\Foundation\Http\FormRequest;

class WebsiteIdentityUpdateRequest extends FormRequest
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
            'logo' => 'file',
            'phone' => 'required',
            'bkash_num' => 'required',
            'address' => 'required',
            'favicon' => 'file',
        ];
    }

    public function update()
    {
        $identity = $this->getIdentity();
        
        if ($this->hasFile('logo')) {
            
            $file = $this->logo;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $path = 'storage/app/public/website_identity/logo';
            $file->move($path, $filename);
            $identity->logo = $filename;
         }
        if ($this->hasFile('favicon')) {
            
            $file = $this->favicon;
            $filename = time().'.'.$file->getClientOriginalExtension();
            $path = 'storage/app/public/website_identity/fevicon';
            $file->move($path, $filename);
            $identity->favicon = $filename;
        }
        $identity->phone = $this->phone;
        $identity->bkash_num = $this->bkash_num;
        $identity->address = $this->address;
        $identity->facebook = $this->facebook;
        $identity->instagram = $this->instagram;
        $identity->twitter = $this->twitter;
        $identity->linkedin = $this->linkedin;
        $identity->youtube = $this->youtube;

        if ($this->free_home_delivery) {
            $identity->free_home_delivery = true;
        } else {
            $identity->free_home_delivery = false;
        }

        $identity->save();
    }

    private function getIdentity()
    {
        if ($identity = WebsiteIdentity::first()) {
            return $identity;
        }
        return new WebsiteIdentity();
    }

   
}
