<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index(Order $order) {

        

        $total_orders = Order::with('products')
                ->join('order_product', 'orders.id', 'order_product.order_id')
                ->join('products', 'product_id', 'products.id')
                ->where('restaurant_id', 2)
                ->select('orders.*')
                ->distinct()
                ->get();

        
        return response()->json([

            'success' => true,
            'results' => $total_orders,
        ]);
    }
}
