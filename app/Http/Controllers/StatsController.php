<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index()
    {

        $total_orders = Order::with('products')
            ->join('order_product', 'orders.id', 'order_product.order_id')
            ->join('products', 'product_id', 'products.id')
            ->where('restaurant_id', Auth::id())
            ->select('orders.*')
            ->get()
            ->toJson();



        return view('admin.stats.index', compact('total_orders'));
    }
}
