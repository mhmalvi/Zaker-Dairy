<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Get['admin/orders']
     */
    public function index()
    {
        $orders = Order::with('actionuser')->orderBy('created_at', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $cart = unserialize($order->cart_details);
        return view('admin.order.view', compact('order', 'cart'));
    }

    public function updateStatus(Request $request)
    {
      
        $order = Order::where('uuid', $request->uuid)->firstOrFail();

        switch ($request->status) {
            case "p":
                $status = 'pending';
                break;
            case "d":
                $status = 'delivered';
                break;
            default:
                $status = 'pending';
                break;
        }

        $order->update([
            'status' => $status,
        ]);
        
        $request->session()->flash('order-success-msg', 'Successfully updated the status!');
        
        return redirect()->route('admin.orders');

    }

    //filter the orders
    public function orderFilter(Request $request)
    {


        $status = $request->status;
        $min_amount = $request->min_amount;
        $max_amount = $request->max_amount;
        $date = $request->date;

        $query = Order::query();

        if (!empty($status)) {
            $query = $query->where('status', $status);
        }
        if (!empty($min_amount) && empty($max_amount)) {
            $query = $query->where('total', '>=', $min_amount);
        }
        if (!empty($max_amount) && empty($min_amount)) {
            $query = $query->where('total', '<=', $max_amount);
        }
        if (!empty($max_amount) && !empty($min_amount)) {
            $query = $query->whereBetween('total', [$min_amount, $max_amount]);
        }
        if (!empty($date)) {
            $query = $query->whereDate('created_at', '=', $date);
        }

        $orders = $query->get();

        return view('admin.order.index', compact('orders'));
    }
}
