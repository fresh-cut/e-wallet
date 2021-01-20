@extends('admin.adminTemplate')
@section('title')
    Редактирование пользователя
@endsection
@section('content')
            <h1>Редактирование пользователя</h1>
            @include('includes.result_messages')
            <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="id">ID - {{($user->checkContract==1)?'Контракт подписан':'Контракт не подписан'}}</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{$user->id}}" disabled>
                </div>
                <div class="form-group">
                    <label for="name">ФИО</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Телефон</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone', $user->telephone) }}" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="money">Баланс</label>
                    <input type="text" class="form-control" id="money" name="money" value="{{ old('money', $user->money) }}" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="percent">Процентная ставка</label>
                    <input type="number" class="form-control" id="percent" name="percent" value="{{ old('percent', $user->percent) }}" autocomplete="off" required>
                </div>


                <div class="form-check">
                    <input name="frozen"
                           type="hidden"
                           value="0">
                    <input type="checkbox" id="frozen" class="form-check-input" value="1" name="frozen" @if($user->frozen==1) checked @endif>
                    <label for="frozen" class="form-check-label">Заморожен</label>
                </div>


                <div class="form-group">
                    <button class="btn btn-dark" type="submit">Сохранить</button>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary ">назад</a>
                </div>
            </form>
@endsection
