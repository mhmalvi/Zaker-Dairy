<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    //show forgot password page
    public function index()
    {
        $footer = FooterInfo::first();
        return view('auth.forgot-password', compact('footer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:password_resets'
        ]);



        $token = Str::random(65);
        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('mail.reset_password_email', ['token' => $token, 'email' => $request->email], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Zaker Dairy - Reset Password Notification');
        });

        return back()->with('status', 'Password reset link has been sent on your mail.');
    }
}
