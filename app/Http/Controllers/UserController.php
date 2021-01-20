<?php

namespace App\Http\Controllers;

use App\Models\MoneyTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user= Auth::user();
        $money_transfer=MoneyTransfer::where('who', $user->id)->orderBy('updated_at', 'desc')->toBase()->get();
        return view('cabinet', compact('user', 'money_transfer'));
    }
}
