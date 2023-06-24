<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function getToken() {

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json([
            'success' => 'true',
            'clientToken' => $clientToken,
        ]);
    }
    public function processPayment(Request $request) {

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        
        $result = $gateway->transaction()->sale([
            'amount' => $request->order['total'], // Update with your desired amount
            'paymentMethodNonce' => $request->paymentMethodNonce,
            'options' => [
                'submitForSettlement' => false
            ]
        ]);
    
        if ($result->success) {
            // Payment successful

            $data = $request->order;

            $validator = Validator::make( 
                
                $data,
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'address' => 'required',
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

            $newOrder = new Order();
            $newOrder->fill($data);
    
            // if ($request->has('products')) {
            //     $newMail->products()->attach($request->products);
            // }
            
            $newOrder->save();
    
            $newMail = new NewOrder($newOrder);

    
            Mail::to('mail@gmail.com')->send($newMail);

            return response()->json([
                'message' => 'Payment successful',
                'success' => true
            ]);
        } else {
            // Payment failed
            return response()->json([
                'message' => 'Payment failed',
                'success' => false
            ]);
        
        }
    }
    
}
