<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        if (!empty(session('authenticated')) && !empty(session('_token'))) {
            return redirect()->route('admin.user.index');
        }
        return view('admin.login.login');
    }

    public function authenticate(Request $request)
    {
        $login = $request->only('login');
        $password = $request->only('password');
        $password=md5($password['password']);
        if($login['login']===env('ADMIN_LOGIN') && $password===env('ADMIN_PASSWORD'))
        {
            $request->session()->regenerate();
            $request->session()->put('authenticated', time());
            return redirect()->route('admin.user.index');
        }
        else
        {
            return back()->withErrors(['msg'=>'Неверный логин/пароль']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('admin.login.index');
    }
}
