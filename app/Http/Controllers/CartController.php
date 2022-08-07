<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\WebsiteIdentity;
use App\Models\Background;
use App\Models\Service;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * view products of cart
     */
    public function index()
    {
        $background = Background::where('background_type','cart_page')->first();
        $identities = WebsiteIdentity::first();
        $services = Service::all();
        
        if (Session::has('cart')) {
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            $products = $cart->items;
            $totalPrice = $cart->totalPrice;

            return view("pages.cart", compact('products', 'totalPrice', 'identities', 'background','services'));
        } else {
            return view("pages.cart", compact('identities','services'));
        }
    }



    /**
     * Get['add-to-cart/{id}']
     */
    public function store(Request $request, Product $product)
    {
        $qty = ($request->quantity > 0) ? $request->quantity : 1;
        
        if ($product->id) {
            //if cart already exist
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            
            $cart = new Cart($oldCart);

            $cart->addItem($product, $product->id, $qty);

            Session::put('cart', $cart);

            return response()->json([
                'total' => Session::get('cart')->totalQty,
                'minicart' => view('components.minicart')->render()
            ]);

          
        }

        abort(404);
    }



    /**
     * update whole cart
     */
    public function update(Request $request)
    {
        //remove cart from session
        if (Session::has('cart')) {
            Session::forget('cart');
        }

        $id = $request->item_id;
        $qty = $request->qty;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        for ($i = 0; $i < count($id); $i++) {
            $product = Product::find($id[$i]);
            $cart->update($id[$i], $product, $qty[$i]);
        }

        Session::put('cart', $cart);
        return redirect()->back();
    }



    /**
     * remove single item from cart
     */
    public function remove(Product $product)
    {
        if ($product->id) {
            //if cart already exist
            $oldCart = Session::has('cart') ? Session::get('cart') : null;

            $cart = new Cart($oldCart);
            $cart->remove($product->id);

            if ($cart->totalQty <= 0) {
                session()->forget('cart');
            } else {
                session()->put('cart', $cart);
            }
            return redirect()->back();
        } else {
           abort(404);
           
        }
    }



    /**
     * destroy the whole shopping cart
     */
    public function destroy()
    {
        if (Session::has('cart')) {
            Session::forget('cart');
        }
        return redirect()->route('cart');
    }
}
