<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewOrder;
use App\Mail\ClientMail;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function getToken()
    {

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
    public function processPayment(Request $request)
    {

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
                'submitForSettlement' => true
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

            $restaurantName = DB::table('users')->where('id',$data['restaurant_id'])->get('name');

            $newOrder = new Order();
            $newOrder->order_code = 'ExampleOrderSerialNumber';
            $newOrder->fill($data);
            $newOrder->save();

            if ($data['products']) {
                foreach ($data['products'] as $product) {
                    $newOrder->products()->attach($product['id'], ['quantity' => $product['quantity']]);
                }
            }

            $newMail = new NewOrder($newOrder);
            $clientMail = new ClientMail($newOrder, $restaurantName);


            $restaurant = DB::table('users')->where('id',$data['restaurant_id'])->get('email');

            Mail::to($restaurant)->send($newMail);
            Mail::to($newOrder->email)->send($clientMail);

            return response()->json([
                'message' => 'Payment successful',
                'orderCode' => $newOrder->order_code,
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
