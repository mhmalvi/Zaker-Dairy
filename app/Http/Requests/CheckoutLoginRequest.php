<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CheckoutLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'checkout_login_email' => 'required|string|email',
            'checkout_login_password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'checkout_login_email.required' => 'Email is required',
            'checkout_login_password.required' => 'Password is required',
            'checkout_login_email.email' => 'Email is invalid',
            'checkout_login_email.string' => 'Email is invalid',
            'checkout_login_password.string' => 'Password is invalid',
        ];
    }

    // for login
    public function login()
    {
        if (
            Auth::attempt([
                'email' => $this->checkout_login_email,
                'password' => $this->checkout_login_password,
            ], true)
        ) {
            return true;
        }
        return false;
    }
}
