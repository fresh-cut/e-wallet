<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::toBase()->paginate(20);
        return view('admin.users.all', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $user=User::find($id);
        if(!$user)
            return back()->withErrors('Ошибка. Повторите еще раз');
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminUserUpdateRequest $request, $id)
    {
        $data=$request->all();
        $user=User::find($id);
        if(!$user)
            return back()->withErrors('Пользователь не найден');
        $len_money=strlen((string)((int)$data['money']));
        if($len_money>6)
            return back()->withErrors('Баланс не может быть больше 999999.9999999');
//        $data['frozen']=(string)$data['frozen'];
        $result=$user->update($data);
        if(!$result)
            return back()->withErrors('Ошибка сохранения');
        return redirect()
            ->route('admin.user.edit',$id)
            ->with(['success'=>'Успешно сохранено']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }

    public function search(Request $request)
    {
        $user=User::select('id')->where('telephone', $request->search)->toBase()->first();
        if(!$user)
            return back()->withErrors('Пользователь по номеру '.$request->search.' не найден.');
        return redirect()->route('admin.user.edit', $user->id)->with(['success'=>'Польователь найден']);;
    }
}
