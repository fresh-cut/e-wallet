<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationCheckController extends Controller
{
    public function verifedOperation(Request $request)
    {
        if(!$request->session()->has('typeTransfer') || !$request->session()->has('whomTransfer') || !$request->session()->has('moneyTransfer'))
            return redirect()->route('dashboard');
        if($request->back==14)
        {
            $request->session()->forget('smstime');
            return redirect()->route('operationCheck','');
        }
        if(!Auth::check())
            return redirect()->route('home');
        $user=Auth::user();

        if(session('smstime'))
        {
            $code=0;
            return view('operationCheck', compact('code'));
        }
        session(['smstime'=> 60]);
        $code=random_int ( 1111, 9999);
        $data=[
            'telephone'=>$user->telephone,
            'code'=>$code,
        ];
        if($user_token=user_token::where('telephone', $user->telephone)->first())
        {
            $user_token->update($data);
        }
        else {
            $user_token=user_token::create($data);
        }
        // отправляем смс

        return view('operationCheck', compact('code'));
    }

    public function checkCode(Request $request)
    {
        if(!$user_token=user_token::where('telephone', Auth::user()->telephone)->where('code', $request->code)->first()){
            return response()->json('', 404);
        }
        $request->session()->put('checkCode', 'success');
        $request->session()->forget('smstime');
        return response()->json('', 200);
    }
}
