@extends('admin.adminTemplate')
@section('title')
    Все пользователи
@endsection
@section('content')
    <h1>Все пользователи</h1>
    @include('includes.result_messages')
    <form action="{{ route('admin.user.search') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="search" value="{{ old('search', '') }}" autocomplete="off" placeholder="поиск по номеру">
        </div>
        <div class="form-group">
            <button class="btn btn-dark" type="submit">найти</button>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr style="text-align: left">
            <th>id</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Баланс</th>
            <th>Контракт</th>
            <th>Заморожен</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td align="left" width="5%">{{$user->id}}</td>
                <td align="left">
                    <a href="{{ route('admin.user.edit',$user->id) }}">
                        {{$user->name}}
                    </a>
                </td>
                <td align="left">{{$user->telephone}}</td>
                <td align="left">{{$user->money}}</td>
                <td align="left">{{($user->checkContract)?'Подписан':'Не подписан'}}</td>
                <td align="left">{{($user->frozen)?'Заморожен':'Не заморожен'}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($users instanceof Illuminate\Pagination\LengthAwarePaginator && $users->total() > $users->count() )
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
