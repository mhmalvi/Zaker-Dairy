<?php

namespace App\Http\Controllers;

use App\Models\SocialLogin;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            
           

            $social_login = SocialLogin::where('provider', 'google')->where('key', $user->id)->first();

            if ($social_login) {
                Auth::login($social_login->user);

                return $this->redirectToProperDestination();
            }
            $local_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
            ]);

            SocialLogin::create(['provider' => 'google', 'key' => $user->id, 'user_id' => $local_user->id]);

            $names = explode(' ', $user->name);

            $local_user->userinfo()->create([
                'first_name' => $names[0],
                'last_name' => $names[1],
            ]);

            Auth::login($local_user);

            return $this->redirectToProperDestination();
        } catch (\Throwable $th) {
            return redirect('/login');
        }
    }

    private function redirectToProperDestination()
    {
        if (Session::has('cart')) {
            return redirect()->route('checkout');
        }
        return redirect()->route('index');
    }
}
