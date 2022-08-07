<?php

namespace App\Http\Controllers;

use App\Actions\SocialLogin\FacebookLoginSaveAction;
use App\Http\Requests\FacebookLoginSaveExtraInfoRequest;
use App\Models\SocialLogin;
use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FacebookController extends Controller
{
    public function loginWithFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFromFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();

            $social_login = SocialLogin::where('key', $user->id)->first();

            if ($social_login) {
                Auth::login($social_login->user);
                Session::flash('success', 'Welcome back!');

                return $this->redirectToProperDestination();
            }

            if (!$user->email) {
                Session::put('facebook_user_data', $user);
                return redirect()->route('facebook.login.extra');
            }

            FacebookLoginSaveAction::execute([
                'name' => $user->name,
                'email' => $user->email,
                'avatar_original' => $user->avatar_original,
                'key' => $user->id,
            ]);

            return $this->redirectToProperDestination();
        } catch (\Throwable $th) {
            return redirect()->route('login')->with(['error' => $th->getMessage()]);
        }
    }

    public function askExtraInfo()
    {
        $user = Session::get('facebook_user_data');
        if (!$user) {
            return redirect()->route('login');
        }

        return view('auth.facebook.ask_for_extra_info', compact('user'));
    }

    public function saveExtraInfo(FacebookLoginSaveExtraInfoRequest $request)
    {
        try {
            $data = Session::get('facebook_user_data');
            FacebookLoginSaveAction::execute([
                'name' => $data->name,
                'email' => $request->email,
                'avatar_original' => $data->avatar_original,
                'key' => $data->id,
            ]);

            Session::remove('facebook_user_data');

            return $this->redirectToProperDestination();
        } catch (\Throwable $th) {
            return redirect()->route('login')->with('error', $th->getMessage());
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
