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
            return redirect()->route('verifed', '');
        }
        if(!Auth::check())
            return redirect()->route('home');
        $user=Auth::user();
        if($user->checkContract)
            return redirect()->route('home');

        if(session('smstime'))
        {
            return view('checkCode');
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
        $url_sms='https://'.env('SMS_EMAIL').':'.env('SMS_SECRET_KEY').'@gate.smsaero.ru/v2/sms/send?number='.$user->telephone.'&text='.$code.'&sign='.env('SMS_NAME');
        $server_answer=json_decode(file_get_contents($url_sms), true);
        if($server_answer['success']!=true)
        {
            $server_answer=json_decode(file_get_contents($url_sms), true);
            if($server_answer['success']!=true)
                return redirect()->route('contract')->with('message-success','Ошибка отправки. Повторите попытку позже');
        }

        return view('checkCode');
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
