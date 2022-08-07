<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\FooterInfo;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCategory;
use App\Models\WebsiteIdentity;
use App\Models\Service;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Get['shop']
     */
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate(8);
        $categories = ProductCategory::with('products')->get();
        $background = DB::table('backgrounds')->where('background_type', 'shop_page')->first();
        $identities = WebsiteIdentity::first();
        $services = Service::all();
        
        if($request->ajax()){
           
                     $view = view('pages.shop_products',compact('products'))->render();
                        return response()->json([
                            'html' => $view
                        ]);
            
            
           
        }

        return view('pages.shop', compact('products', 'categories', 'background', 'identities','services'));
    }



    /**
     * Get['slug']
     */
    public function categoryProduct(string $slug)
    {
        
      
        $background = DB::table('backgrounds')->where('background_type', 'shop_page' )->first();
        $identities = WebsiteIdentity::first();
        $category = ProductCategory::where('slug', $slug)->first();
        $categories = ProductCategory::with('products')->get();
         $services = Service::all();

        if ($category) {
            $products = Product::where('category_id', $category->id)->paginate(12);

            return view('pages.shop', compact('products', 'categories', 'background', 'identities','slug','category','services'));
        }
        abort(404, 'not found!');
    }



    /**
     * Get['shop/{slug}']
     */
    public function item(string $category_slug, string $product_slug)
    {
        
        $background = DB::table('backgrounds')->where('background_type', 'shop_page')->first();
        $identities = WebsiteIdentity::first();
        $product = Product::where('slug', $product_slug)->first();
        $oldCart = Session::get('cart');
         $services = Service::all();

        if ($oldCart) {
            $cartItem = isset($oldCart->items[$product->id]) ? $oldCart->items[$product->id] : null;
        } else {
            $cartItem = null;
        }

        if ($product->id) {
            return view('pages.product', compact('product', 'cartItem', 'background', 'identities','services'));
        } else {
            abort(404);
        }
    }
}
