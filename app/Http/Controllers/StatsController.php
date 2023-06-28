<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index(Order $order) {

        /*$total_orders = Order::with('products')
                ->join('order_product', 'orders.id', 'order_product.order_id')
                ->join('products', 'product_id', 'products.id')
                ->where('restaurant_id', Auth::id())
                ->select('orders.*')
                ->distinct()
                ->get();*/
        

        $total_orders = [
            '0' => 56,
            '1' => 45,
            '2' => 78,
            '3' => 36,
            '4' => 98,
        ];

        
        return view('admin.stats.index', compact('total_orders'));
    }
}
