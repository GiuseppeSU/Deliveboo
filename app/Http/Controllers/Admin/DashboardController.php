<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('restaurant_id', Auth::id())->count();
        $orders = Product::where('restaurant_id', Auth::id())
            ->join('order_product', 'product_id', 'products.id')
            ->select('order_id')
            ->distinct()
            ->get()
            ->count();

        /*
        $total_orders = Order::with('products')
            ->join('order_product', 'orders.id', 'order_product.order_id')
            ->join('products', 'product_id', 'products.id')
            ->where('restaurant_id', Auth::id())
            ->select('orders.*')
            ->get()
            ->toJson();
        */

        return view('admin.dashboard', compact('products', 'orders'));
        //'total_orders'
    }
}
