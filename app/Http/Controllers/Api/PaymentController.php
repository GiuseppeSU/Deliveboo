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
use Faker\Generator as Faker;

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
    public function processPayment(Request $request,Faker $faker)
    {

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key')
        ]);

        // Validazione form utente
        $data = $request->order;

        do{
            $data->order_code = $faker->number;

        }while (Order::where('order_code',$data->order_code)->first());

        $validator = Validator::make(

            $data,
            [
                'name' => 'required|max:100',
                'email' => 'required|email|max:50',
                'address' => 'required|max:100',
                'phone_number' => ['required', 'max:10', 'not-regex:/[^0-9]/g'],
                'total' => 'decimal:0,2|between:0,9999'
            ],
            [
                'required' => 'Il campo :attribute non può essere vuoto.',
                'name.max' => 'Il :attribute non può superare i 100 caratteri.',
                'email.max' => 'La :attribute supera la lunghezza massima consentita (50 caratteri).',
                'phone_number.max' => 'Il :attribute è composto da 10 cifre al massimo.',
                'phone_number.not-regex' => 'Il :attribute può contenere solo cifre numeriche.',
                'total.decimal' => 'Si è verificato un errore imprevisto.',
                'total.between' => 'Si è verificato un errore imprevisto.',
            ],
            [
                'name' => 'Nome',
                'email' => 'E-mail',
                'address' => 'Indirizzo',
                'phone_number' => 'Numero di telefono',
                'total' => 'Totale',
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


        $result = $gateway->transaction()->sale([
            'amount' => $request->order['total'], // Update with your desired amount
            'paymentMethodNonce' => $request->paymentMethodNonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // Payment successful

            $restaurantName = DB::table('users')->where('id', $data['restaurant_id'])->get('name');

            $newOrder = new Order();
            $newOrder->order_code = 'AspettaESperaChePoiSiAvvera!!!!!';
            $newOrder->fill($data);
            $newOrder->save();

            if ($data['products']) {
                foreach ($data['products'] as $product) {
                    $newOrder->products()->attach($product['id'], ['quantity' => $product['quantity']]);
                }
            }

            $newOrderMail = new NewOrder($newOrder);
            $clientMail = new ClientMail($newOrder, $restaurantName);


            $restaurantMail = DB::table('users')->where('id', $data['restaurant_id'])->get('email');

            Mail::to($restaurantMail)->send($newOrderMail);
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
