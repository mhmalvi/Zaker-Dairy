<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Background;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PromotionalBanner;
use App\Models\Content;
use App\Models\WebsiteIdentity;
use App\Models\HomeSlider;
use App\Models\Service;

class HomeController extends Controller
{
    /**
     * Get['/']
     */
    public function index()
    {

        $categories = ProductCategory::all()->filter(function ($category) {
            // only take the categories that doesn't contain any parent
            if ($category->parent == null)
                return true;
            return false;
        });

        $products = Product::where('publish', 1)->get();

        // get only sweets category's products
        $sweets = ProductCategory::where('category', 'LIKE', '%Sweets%')->first();
        $sweets_url = "javascript:void(0)";
        $sweets_products = [];
        if ($sweets) {
            $sweets_products = $sweets->products()->where('publish', 1)->get();
            $sweets_url = route('category', ['slug' => $sweets->slug]);
        }

        // get only bakery category's products
        $bakery = ProductCategory::where('category', 'LIKE', '%Bakery%')->first();
        $bakery_url = "javascript:void(0)";
        $bakery_products = [];
        if ($bakery) {
            $bakery_products = $bakery->products()->where('publish', 1)->get();
            $bakery_url = route('category', ['slug' => $bakery->slug]);
        }
        

        // get only dairy category's products
        $dairy = ProductCategory::where('category', 'LIKE', '%Dairy%')->first();
        $dairy_url = "javascript:void(0)";
        $dairy_products = [];
        if ($dairy) {
            $dairy_products = $dairy->products()->where('publish', 1)->get();
            $dairy_url = route('category', ['slug' => $dairy->slug]);
        }
        
     

        $featured = Product::where('featured', 1)->limit(8)->get();

        $ignored_ids = [];
        if ($sweets) $ignored_ids[] = $sweets->id;
        if ($bakery) $ignored_ids[] = $bakery->id;
        if ($dairy) $ignored_ids[] = $dairy->id;
        

        $other_products = Product::where('publish', 1)
            ->whereNotIn('category_id', $ignored_ids)
            ->orWhere('category_id', null)
            ->limit(8)
            ->get();
            
            
      

        $banner_1 = PromotionalBanner::where('name', 'banner_1')->first();
        $banner_1_url = $banner_1 ? asset('storage/app/public/promotional_banners/' . $banner_1->image) : null;
        $banner_2 = PromotionalBanner::where('name', 'banner_2')->first();
        $banner_2_url = $banner_2 ? asset('storage/app/public/promotional_banners/' . $banner_2->image) : null;


        $identities = WebsiteIdentity::first();
        
        $homeSliders = HomeSlider::all();
        
        //get all services
        $services = Service::all();
        

        return view('pages.index', compact(
            'categories',
            'products',
            'featured',
            'sweets_products',
            'bakery_products',
            'dairy_products',
            'other_products',
            'sweets_url',
            'bakery_url',
            'dairy_url',
            'banner_1_url',
            'banner_2_url',
            'identities',
            'homeSliders',
            'services'
        ));
    }


    /**
     * Get['contact-us']
     */
    public function ContactUs()
    {
         $background = Background::where('background_type', 'contact_page')->first();
         $identities = WebsiteIdentity::first();
          $services = Service::all();
         
        return view('pages.contact_us', compact('identities','background','services'));
    }

    /**
     * Get['about-us']
     */
    public function AboutUs()
    {
        $background = Background::where('background_type', 'about_us_page')->first();
        $identities = WebsiteIdentity::first();
        $content = Content::where('key', 'about_us')->first();
        $image = Content::where('key', 'about_us_image')->first();
         $services = Service::all();

        return view('pages.about_us', compact('content', 'image','identities','background','services'));
    }


    public function product(Product $product)
    {
        $identities = WebsiteIdentity::first();
         $services = Service::all();
         
        return view('components.quickview', compact('product','identities','services'));
    }

    public function terms_conditions()
    {
         $background = Background::where('background_type', 'terms_condition_page')->first();
        $terms_conditions = Content::where('key', 'terms_conditions')->first();
         $services = Service::all();
         
        return view('pages.terms_conditions', compact('terms_conditions','background','services'));
    }
    
  
}
