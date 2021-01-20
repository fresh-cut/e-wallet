@extends('admin.adminTemplate')
@section('title')
    Перевода id - {{ $transfer->id }}
@endsection
@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <h1>Перевод id - {{ $transfer->id }}</h1>
                @include('includes.result_messages')
                <p>
                    <b>Имя отправителя:</b> {{$transfer->name}}
                </p>
                <p>
                    <b>Номер отправителя:</b> {{$transfer->telephone}}
                </p>
                @if($transfer->type=='sop')
                    <p>
                        <b>Номер получателя:</b> {{$transfer->whom}}
                    </p>
                @else
                    <p>
                        <b>Номер карты:</b> {{$transfer->whom}}
                    </p>
                @endif
                <p>
                    <b>Сумма перевода:</b> {{$transfer->money}} SOP
                </p>
                <p>
                    <b>Дата перевода:</b> {{$transfer->created_at}}
                </p>
                <p>
                    <b>Cтатус перевода:</b> <span style="color:blue">{{($transfer->status==2)?'В ожидании':''}}</span>
                </p>
                <form action="{{ route('admin.transfer.update', $transfer->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="who" value="{{$transfer->who}}">
                    <input type="hidden" name="button" value="success">
                    <button class="btn btn-success">Подтвердить перевод</button>
                </form>
                <form style="margin-top: 10px " action="{{ route('admin.transfer.update', $transfer->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="who" value="{{$transfer->who}}">
                    <input type="hidden" name="button" value="back">
                    <button class="btn btn-danger">Отклонить перевод и вернуть деньги на счет</button>
                </form>
                <a style="margin-top: 10px" href="{{ route('admin.transfer.index') }}" class="btn btn-secondary">назад</a>
            </div>
        </div>
    </div>

@endsection


