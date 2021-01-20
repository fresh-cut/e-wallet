<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function index()
    {
        if(!Auth::check())
            return redirect()->route('home');
//        dd(Auth::user());
        return view('contract');
    }
}
