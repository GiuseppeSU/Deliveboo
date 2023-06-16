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
            'vat'=> ['required','min:11','max:11'],
            'address'=>['required','string','max:100'],
            'image'=>['nullable','image']
        ]);

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
