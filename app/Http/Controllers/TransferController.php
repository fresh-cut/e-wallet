<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferAddRequest;
use App\Models\MoneyTransfer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function transfer(TransferAddRequest $request)
    {
        $user=Auth::user();
        if($user->frozen==1)
            return back()->withErrors('Переводы заморожены!');
        $data=$request->all();
        $data['money']=str_replace(',', '.', $data['money']);
        $data['who']=$user->id;
        if($data['type']=='sop')
        {
            $whomuser=User::where('telephone', $data['whom'])->first();
            if(!$whomuser)
                return back()
                    ->withInput()
                    ->withErrors('Пользователь с таким номером не существует');
            if($data['whom']==$user->telephone)
                return back()
                    ->withInput()
                    ->withErrors('Нельзя перевести самому себе');
            if($user->money<$data['money'])
                return back()
                    ->withInput()
                    ->withErrors('Сумма вывода не может быть больше суммы на балансе');

            $user->money=$user->money-$data['money'];
            $whomuser->money=$whomuser->money+$data['money'];
            if($user->save() && $whomuser->save())
            {
                $data['status']='1';
                MoneyTransfer::create($data);
                return redirect()->route('dashboard')
                    ->with('message-success', 'Перевод успешно произведен');
            }
            return redirect()->route('dashboard')
                ->withErrors('Ошибка перевода');

        }
        else {
            if($user->money<$data['money'])
                return back()
                    ->withInput()
                    ->withErrors('Сумма вывода не может быть больше суммы на балансе');
            $data['status']='2';
            $user->money=$user->money-$data['money'];
            if($user->save())
            {
                $result=MoneyTransfer::create($data);
                if($result)
                    return redirect()->route('dashboard')
                        ->with('message-success', 'Запрос на вывод средств сформирован');
            }
        }
    }
}
