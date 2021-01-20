<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i|max:191|unique:users',
            'telephone' => 'required|string|regex:/(8)[0-9]{10}/|max:11|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        Auth::login(User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone'=>$request->telephone,
            'password' => Hash::make($request->password),
        ]));
//        dd($user);
//        event(new Registered($user));
        return redirect()->route('contract');
//        return redirect(RouteServiceProvider::HOME);
    }
}
