<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutLoginRequest;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\GuestUser;
use App\Models\Order;
use App\Models\Background;
use App\Models\OrderDetails;
use App\Models\User;
use App\Models\Service;
use App\Models\UserInfo;
use App\Models\WebsiteIdentity;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckOutController extends Controller
{
    /**
     *
     */
    public function index()
    {
        $background = Background::where('background_type', 'checkout_page')->first();
        $identities = WebsiteIdentity::first();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $services = Service::all();

        $user = auth()->check() ? auth()->user()->load('userinfo') : null;

        return view('checkout.index', compact('products', 'totalPrice', 'user', 'identities', 'background', 'services'));
    }



    /**
     * Post['checkout']
     */
    public function checkout(CheckoutRequest $request)
    {
        try {
            $user = auth()->user();

            if (auth()->check()) {
                // if user is logged in, save user info from the request data
                $request->userinfo(UserInfo::where('user_id', $user->id)->first());
            } else if ($request->filled('create_account') && $request->create_account == true) {
                // if user is a guest user, and user wants to create an account, create a new user
                $password = Hash::make(Str::random(8));
                $user = User::create([
                    'name' => $request->first_name,
                    'email' => $request->email,
                    'password' => $password,
                ]);
                $user->userinfo()->create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'address' => $request->address,
                    'phone' => $request->phone,

                ]);
                auth()->login($user);
                event(new Registered($user));
            }

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            // save the order from cart and user information
            $order = $request->save($cart, $user);

            if ($order->id) {
                foreach ($cart->items as $item) {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $item['item']['id'],
                        'qty' => $item['qty']
                    ]);
                }

                Session::forget('cart');
            }

            $guest_user = null;

            if (!auth()->check() && (!$request->filled('create_account') || $request->create_account == false)) {
                // if guest user is not creating an account, save guest user info
                $guest_user = GuestUser::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'unique_id' => uniqid(),
                    'order_id' => $order->id,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'shipping_address' => $request->shipping_address,
                ]);

                // add guest user info to order
                $order->update([
                    'guest_id' => $guest_user->id,
                ]);
            }

            // prepare the parameters for success page's url
            $params = ['order_id' => $order->uuid];
            if ($order->guest_id) {
                // add guest_id(unique_id) to the url, because we dont want the guest
                // user to be able to see other user's orders information
                $params['guest_id'] = $order->guest_user->unique_id;
            }

            $link = route('checkout.success', $params);

            $user = [
                "order_id" => $order->uuid,
                "name" => "{$request->first_name} {$request->last_name}",
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "shipment" => $request->shipping_address,
                "created_at" => $order->created_at
            ];

            $this->Mailable($user, $cart);

            // return the response in json
            return response()->json([
                'success' => true,
                'success_link' => $link
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Something went wrong!",
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * For the login form in checkout
     */
    public function login(CheckoutLoginRequest $request)
    {

        try {
            $request->login();

            return redirect()->route('checkout');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error' => "Something went wrong!"]);
        }
    }

    public function success(Request $request)
    {
        $order = Order::where('uuid', $request->order_id)->firstOrFail();

        if (auth()->check() && $order->action_user != auth()->user()->id) {
            // if user is authenticated and user's info doesn't match with order's user info
            return redirect()->route('index');
        } else if ($order->guest_id && $order->guest_user->unique_id != $request->guest_id) {
            // if user is guest, and guest's info doesn't match with order's guest info
            return redirect()->route('index');
        }

        $summery = [
            'order_id' => $order->uuid,
            'shipping' => $order->shipping_details,
            'order_date' => $order->created_at,
            'payment_method' => $order->payment_method
        ];

        $cart = unserialize($order->cart_details);

        $products = $cart->items;
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;

        $identities = WebsiteIdentity::first();
        $services = Service::all();

        return view('checkout.confirm', compact('summery', 'products', 'totalQty', 'totalPrice', 'identities', 'services'));
    }

    private function Mailable($user, $cart)
    {
        $mailTo = [
            $user["email"],
            'zakerdairy@gmail.com'
        ];
        Mail::to($mailTo)->send(new OrderConfirmationMail($user, $cart));
    }
}
