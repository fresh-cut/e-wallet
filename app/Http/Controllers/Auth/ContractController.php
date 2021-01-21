<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContractController extends Controller
{
    public function index()
    {
        if(Session::has('smstime'))
            Session::forget('smstime');
        if(!Auth::check())
            return redirect()->route('home');
        if(Auth::check() && Auth::user()->checkContract==0)
                return view('contract');
        else
            return redirect()->route('dashboard');
    }
}
