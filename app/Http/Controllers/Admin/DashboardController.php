<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::where('restaurant_id', Auth::id())->get();

        return view('admin.dashboard', compact('products'));
    }
}
