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
                    'id' => '1',
                    'name' => 'Pending'
                ],
                [
                    'id' => '2',
                    'name' => 'Accepted'
                ],
                [
                    'id' => '3',
                    'name' => 'Finished'
                ],
                [
                    'id' => '4',
                    'name' => 'Sent'
                ],
                [
                    'id' => '5',
                    'name' => 'Done'
                ],
            ];
            return view('admin.orders.edit', compact('order'));
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
            $validated_data = $request->validated();

            $order->update($validated_data);

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
