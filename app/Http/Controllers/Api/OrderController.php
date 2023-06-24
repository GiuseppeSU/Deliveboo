<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        $validator = Validator::make( 
            
            $data,
            [
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'price' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors()
                ]
            );
        }

        $newMail = new Order();
        $newMail->fill($data);

        if ($request->has('products')) {
            $newMail->products()->attach($request->products);
        }
        
        $newMail->save();

        $oggettoNewOrder = new NewOrder($newMail);

        Mail::to('ange.rouda@gmail.com')->send($oggettoNewOrder);

    }
}
