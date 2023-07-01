<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$orders = Order::where('restaurant_id', Auth::id())
                //->orderBy('desc')
                ->get();*/

        $orders = Order::with('products')
                ->join('order_product', 'orders.id', 'order_product.order_id')
                ->join('products', 'product_id', 'products.id')
                ->where('restaurant_id', Auth::id())
                ->select('orders.*')
                ->orderBy('created_at', 'desc')
                ->distinct()
                ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if ($order->products()->first()->restaurant_id == Auth::id()) {
            return view('admin.orders.show', compact('order'));
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if ($order->products()->first()->restaurant_id == Auth::id()){
            $status = [
                [
                    'id' => 'pending',
                    'name' => 'pending'
                ],
                [
                    'id' => 'accepted',
                    'name' => 'accepted'
                ],
                [
                    'id' => 'finished',
                    'name' => 'finished'
                ],
                [
                    'id' => 'sent',
                    'name' => 'sent'
                ],
                [
                    'id' => 'done',
                    'name' => 'done'
                ],
            ];
            return view('admin.orders.edit', compact('order','status'));
        } else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if ($order->products()->first()->restaurant_id == Auth::id()) {

            $order->status = $request->status;
            $order->update();

            return to_route('admin.orders.show', ['order' => $order->order_code])
                ->with('status', 'Success! Order updated.');
        } else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
