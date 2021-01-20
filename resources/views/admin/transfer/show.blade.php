@extends('admin.adminTemplate')
@section('title')
    Перевод id - {{ $transfer->id }}
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
                @if($transfer->status==1)
                    <p>
                        <b>Cтатус перевода:</b> <span style="color:green">Успешно</span>
                    </p>
                @elseif($transfer->status==0)
                    <p>
                        <b>Cтатус перевода:</b> <span style="color:red">Отклонено</span>
                    </p>
                @endif
                <a href="{{ route('admin.transfer.index') }}" class="btn btn-secondary">назад</a>
            </div>
        </div>
    </div>

@endsection


