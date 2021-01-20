<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MoneyTransfer;
use App\Models\User;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card=MoneyTransfer::join('users', 'money_transfers.who', '=', 'users.id')->select('money_transfers.*', 'users.name')->where('type', 'card')->orderBy('status', 'asc')->toBase()->get();
        $sop=MoneyTransfer::join('users', 'money_transfers.who', '=', 'users.id')->select('money_transfers.*', 'users.name')->where('type', 'sop')->orderBy('id', 'desc')->toBase()->get();
        return view('admin.transfer.all', compact('card', 'sop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $transfer=MoneyTransfer::join('users', 'money_transfers.who', '=', 'users.id')->select('money_transfers.*', 'users.name', 'users.telephone')->where('money_transfers.id', $id)->toBase()->first();
        if(!$transfer)
            return back()->withErrors('Перевод не найден');
        return view('admin.transfer.show', compact('transfer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transfer=MoneyTransfer::join('users', 'money_transfers.who', '=', 'users.id')->select('money_transfers.*', 'users.name', 'users.telephone')->where('money_transfers.id', $id)->toBase()->first();
        if(!$transfer)
            return back()->withErrors('Перевод не найден');
        return view('admin.transfer.edit', compact('transfer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data=$request->all();
        $transfer=MoneyTransfer::find($id);
        if(!$transfer)
            return back()->withErrors('Перевод не найден. Попробуйте перезагрузить страницу');
        if($data['button']=='success')
        {
            $result=$transfer->update(['status'=>'1']);
            if(!$result)
                return back()->withErrors('Перевод не найден. Попробуйте перезагрузить страницу');
            return redirect()
                ->route('admin.transfer.show',$id)
                ->with(['success'=>'Операция успешно завершена.']);
        }
        else
        {
            $user=User::find($data['who']);
            if(!$user)
                return back()->withErrors('Ошибка. Попробуйте перезагрузить страницу');
            $result=$transfer->update(['status'=>'0']);
            if(!$result)
                return back()->withErrors('Перевод не найден. Попробуйте перезагрузить страницу');
            $user->money=$user->money+$transfer->money;
            $user_result=$user->save();
            if(!$user_result){
                $transfer->update(['status'=>'2']);
                return back()->withErrors('Произошла ошибка перевода средств');
            }
            return redirect()
                ->route('admin.transfer.show',$id)
                ->with(['success'=>'Операция успешно завершена. Деньги возвращены.']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
