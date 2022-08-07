<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'action_user' => $this->action_user,
            'name' => $this->name,
            'first_name' => $this->userinfo->first_name,
            'last_name' => $this->userinfo->last_name,
            'email' => $this->email,
            'photo' => $this->photo ? '' : asset('images/user_default.jpg'), // photo needs to be stored somewhere
            'phone' => $this->userinfo->phone,
            'address' => $this->userinfo->address,
            'is_suspended' => $this->is_suspended,
        ];
    }
}
