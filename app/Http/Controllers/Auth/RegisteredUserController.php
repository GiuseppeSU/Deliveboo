<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data= $request->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'vat'=> ['required','numeric','min_digits:11','max_digits:11','unique:restaurants'],
            'address'=>['required','string','max:100'],
            'image'=>['nullable','image']
        ],
        //personalized message
        [
            'name.required' => 'Il campo Nome è obbligatorio',
            'name.max' => 'Il campo nome deve avere al massimo :max caratteri',
            'name.string'=>'Il campo nome deve contenere caratteri alfabetici',
            'email.required' => 'Il campo E-mail è obbligatorio',
            'email.email' => 'Il campo E-mail deve contenere un indirizzo e-mail valido',
            'email.max' => 'Il campo E-mail deve avere al massimo :max caratteri',
            'email.unique' => 'L\'E-mail inserita è già presente',
            'password.required' => 'Il campo Password è obbligatorio',
            'password.confirmed' => 'Le due password non corrispondono',
            'vat.required' => 'Il campo Partita IVA è obbligatorio',
            'vat.numeric' => 'Il campo Partita IVA deve essere un numero',
            'vat.min_digits' => 'Il campo Partita IVA deve essere di :min caratteri',
            'vat.max_digits' => 'Il campo Partita IVA deve essere di :max caratteri',
            'vat.unique' => 'La Partita IVA inserita è già presente',
            'address.required' => 'Il campo Indirizzo è obbligatorio',
            'address.max' => 'Il campo Indirizzo deve avere al massimo :max caratteri',
            'image.image' => 'Il tipo di file non corrisponde ad un Immagine'

        ]
    );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);



        $restaurant = Restaurant::create([
            'name' => $request->name,
            'vat' => $request->vat,
            'address' => $request->address,
            'image' => $request->image,
            'slug' =>$request->name,
            'user_id'=> $user->id,


        ]);


        if ($request->hasFile('image')) {
            $img_path = Storage::put('public/img', $request->image);
            $request['image'] = $img_path;
        };
        event(new Registered($user));


        Auth::login($user);


        return redirect(RouteServiceProvider::HOME);
    }
}
