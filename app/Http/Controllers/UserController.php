<?php

namespace App\Http\Controllers;

use App\Models\MoneyTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        if(Session::has('smstime'))
            Session::forget('smstime');
        if(Session::has('typeTransfer'))
            Session::forget('typeTransfer');
        if(Session::has('whomTransfer'))
            Session::forget('whomTransfer');
        if(Session::has('moneyTransfer'))
            Session::forget('moneyTransfer');
        $user= Auth::user();
        $money_transfer=MoneyTransfer::where('who', $user->id)->orderBy('updated_at', 'desc')->toBase()->get();
        return view('cabinet', compact('user', 'money_transfer'));
    }
}
