<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StatsController extends Controller
{
    public function index()
    {
        $firstStart = "2022-01-01 00:00:00";
        $firstEnd = "2022-12-31 23:59:00";
        $secondStart = "2023-01-01 00:00:00";
        $secondEnd = "2023-12-31 23:59:00";


        $total_orders_2022 = Order::with('products')
            ->join('order_product', 'orders.id', 'order_product.order_id')
            ->join('products', 'product_id', 'products.id')
            ->where('restaurant_id', Auth::id())
            ->select('orders.*')
            ->whereBetween('orders.created_at',[$firstStart, $firstEnd])
            ->get()
            ->toJson();

        $total_orders_2023 = Order::with('products')
            ->join('order_product', 'orders.id', 'order_product.order_id')
            ->join('products', 'product_id', 'products.id')
            ->where('restaurant_id', Auth::id())
            ->select('orders.*')
            ->whereBetween('orders.created_at',[$secondStart, $secondEnd])
            ->get()
            ->toJson();

            

        return view('admin.stats.index', compact('total_orders_2022','total_orders_2023'));
    }
}
