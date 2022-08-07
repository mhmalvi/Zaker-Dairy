<?php

namespace App\Actions\SocialLogin;

use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookLoginSaveAction
{
    public static function execute(array $data)
    {
        $user = self::save($data);
        Auth::login($user);

        return $user;
    }

    public static function save(array $data)
    {
        $user = new User();

        $name_elements = explode(' ', $data['name']);

        $user->name = $name_elements[0];
        $user->email = $data['email'];
        $user->photo = $data['avatar_original'];

        $user->save();

        $user->userinfo()->create([
            'first_name' => $name_elements[0],
            'last_name' => $name_elements[1],
        ]);

        SocialLogin::create([
            'user_id' => $user->id,
            'provider' => 'facebook',
            'key' => $data['key'],
        ]);

        return $user;
    }
}
