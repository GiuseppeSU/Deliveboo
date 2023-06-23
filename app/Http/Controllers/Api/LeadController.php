<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewOrder;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required'
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

        $newMail = new Lead();
        $newMail->fill($data);
        $newMail->save();

        $oggettoNewOrder = new NewOrder($newMail);

        Mail::to('ange.rouda@gmail.com')->send($oggettoNewOrder);

    }
}
