<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContractVerificatedRequest;
use App\Models\User;
use App\Models\user_token;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractVerificatedController extends Controller
{
    public function verifed(Request $request)
    {
        if($request->back==12)
        {
            $request->session()->forget('smstime');
            return redirect()->route('verifed');
        }
        if(!Auth::check())
            return redirect()->route('home');
        $user=Auth::user();
        if($user->checkContract)
            return redirect()->route('home');

        if(session('smstime'))
        {
            $code=0;
            return view('checkCode', compact('code'));
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

        return view('checkCode', compact('code'));
    }

    public function checkCode(Request $request)
    {
        if(!$user_token=user_token::where('telephone', Auth::user()->telephone)->where('code', $request->code)->first()){
            return response()->json('', 404);
        }
        $data=[
            'checkContract'=>1,
        ];
        $user_id=Auth::id();
        $user=User::find($user_id);
        $user->checkContract=1;
        $user->save();
        $request->session()->forget('smstime');
        $request->session()->put('message-success', 'Вы успешно подписали договор');
        return response()->json('', 200);
    }
}
