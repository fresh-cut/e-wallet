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
        $user=Auth::user();
        if($user->checkContract)
            return redirect()->route('home');
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
        return view('checkCode');
    }

    public function checkCode(Request $request)
    {
        $request->validate([
            'code' => 'required|max:4',
        ]);
        if(!$user_token=user_token::where('telephone', Auth::user()->telephone)->where('code', $request->code)->first()){
            dd('error');
        }
        $data=[
            'checkContract'=>1,
        ];
        $user_id=Auth::id();
        $user=User::find($user_id);
        $user->checkContract=1;
        $user->save();
        return redirect()
            ->route('dashboard')
            ->with(['success'=>'регистрация прошла успешно']);

    }
}
