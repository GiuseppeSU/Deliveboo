<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Braintree\Gateway; 
use App\Models\Order;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Mail;

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
            'amount' => $request->total, // Update with your desired amount
            'paymentMethodNonce' => $request->paymentMethodNonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
    
        if ($result->success) {
            // Payment successful
            $newMail = new Order();
            $newMail->name = $request->name;
            $newMail->email = $request->email;
            $newMail->address = $request->address;

            /*if ($request->has('products')) {
                $newMail->products()->attach($request->products);
            }*/
        
            $newMail->save();

            $oggettoNewOrder = new NewOrder($newMail);

            Mail::to('ange.rouda@gmail.com')->send($oggettoNewOrder);

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
