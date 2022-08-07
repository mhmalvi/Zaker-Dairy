<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterInfo;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;


use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Get['admin/dashboard']
     */
    public function index()
    {
        //get the total pending orders 
        $order_numbers = Order::where('status','pending')->count();
        
        //get the current date
        $today = Carbon::now()->format('Y-m-d');
        
        //get the current date pending orders
        $today_orders_numbers = Order::where('status','pending')->whereDate('created_at', $today)->count();
        
        //get the total active users
        $total_users = User::where('is_suspended','no')->count();
        
        //get the total published products
        $total_products = Product::where('publish', 1)->count();
        
        //get the registered user name and email
        $users = User::select('name','email','is_suspended')->paginate(5);
        

         return view('admin.home.index',compact('order_numbers','today_orders_numbers','total_users','total_products','users'));
    }
}
