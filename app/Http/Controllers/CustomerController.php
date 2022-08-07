<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Order;
use App\Models\FooterInfo;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\WebsiteIdentity;
use App\Models\Background;
use App\Models\Service;



class CustomerController extends Controller
{
    /**
     * Get['dashboard]
     */
    public function index()
    {
        $services = Service::all();
        $identities = WebsiteIdentity::first();
        $orders = Order::where('action_user', Auth::id())->orderBy('created_at', 'desc')->get();
        $user = auth()->user();
        $user_info = UserInfo::where('user_id',$user->id)->first();
        $background = Background::where('background_type', 'dashboard_page')->first();

        return view('dashboard', compact('orders', 'user', 'identities', 'user_info','background','services'));
    }
    
      /**
     * 
     * update billing address
     * 
     */
    public function updateBillingAddress(Request $request)
    {
        $user_id = $request->user_id;
        $billing_address = $request->billing_address;

        //validate the input
        $request->validate([

            'billing_address' => 'required'

        ]);

        //update the users infos
        $updated = DB::table('user_infos')
            ->where('user_id', $user_id)
            ->update(['billing_address' => $billing_address]);

        if ($updated) {
            return  redirect()->route('dashboard')->with('success', 'Billing Address has been updated Successfully... ');
        }
    }
    
     /**
     * 
     * update user
     * 
     */
    public function updateUser(Request $request)
    {

        $user_id = $request->user_id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $display_name = $request->display_name;
        $email = $request->email;
        $phone = $request->mobile;
        $current_password = $request->current_password;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
 

        //validate the input
        $request->validate(
            [

                'first_name' => 'required',
                'last_name' => 'required',
                'display_name' => 'required',
                'mobile' => 'required',
               
            ]


        );
        
        if(is_null($current_password) == false ){
                //validate the input
                $request->validate(
                    [
        
                        'current_password' => 'required',
                        'password' => 'required|confirmed|min:8',
                        'password_confirmation' => 'required'
        
                    ]
        
        
                );
                
                $user = auth()->user();
                if(!(Hash::check($current_password, $user->password))){
                    
                    return back()->with('error','your current password does not match...!');
                    
                }
               
                
           
        }
        //update users table 

        DB::table('users')
            ->where('id', $user_id)
            ->update([
                'name' => $display_name,
                'email' => $email,
            ]);
        if(is_null($current_password) == false){
              DB::table('users')
                ->where('id', $user_id)
                ->update([
                    'password'  => Hash::make($password)
                ]);
        }
        //update the users infos
        DB::table('user_infos')
            ->where('user_id', $user_id)
            ->update([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone' => $phone,
            ]);


        return  redirect()->route('dashboard')->with('success', 'account details have been updated');
    }
    
         //view users order
        public function viewOrder($id)
        {
            //get the expected order
            $order = Order::find($id);
    
            //get the order items
            $orderItems = OrderDetails::where('order_id', $order->id)->get();
    
            $identities = WebsiteIdentity::first();
             $services = Service::all();
            
            $user = auth()->user();
    
            $user_info = UserInfo::where('user_id', $user->id)->first();
    
            return view('components.view-order', compact('order', 'orderItems', 'identities', 'user', 'user_info','services'));
        }
}
