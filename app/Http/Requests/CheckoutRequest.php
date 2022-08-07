<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $email_validation = '';
        if (auth()->check() && ($this->filled('create_account') && $this->create_account == true)) {
            $email_validation = '|unique:users,email';
        }
        return [
            "first_name"        => 'required|string',
            "last_name"         => 'required|string',
            "email"             => 'required|string' . $email_validation,
            "phone"             => 'required|string',
            "address"           => 'required|string',
            "shipping_address"  => "required|string",
        ];
    }

    public function userinfo($user)
    {
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->phone = $this->phone;
        $user->address = $this->address;

        $user->save();
    }

    public function save($cart, ?User $user)
    {
        $order = Order::create([
            'uuid' => $this->orderId(),
            'action_user' => $user ? $user->id : null,
            'shipping_details' => $this->shipping_address,
            'cart_details' => serialize($cart),
            'total' => $cart->totalPrice,
            'notes' => $this->order_notes,
            'payment_method' => $this->payment_method,
        ]);

        return $order;
    }

    private function  orderId(): string
    {
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999) . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $orderid = "ZD-" . str_shuffle($pin) . "-" . date('d-m-y');

        return $orderid;
    }
}
