<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>Счет</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
<style>
    form{
        height: auto;
        padding: 20px 30px
    }
</style>
<div class="mobile-menu">
    <span class="menu-title">
        Меню
    </span>
    <ul>
        <li class="menu-item">
            <a href="" class="menu-link">Пункт 1</a>
        </li>
        <li class="menu-item">
            <form  method="post" action="{{ route('logout') }}">
                @csrf
                <input class="input btn" type="submit" value="Выйти" >
            </form>
        </li>
    </ul>
    <img src="{{asset('img/plus.png')}}" alt="close" class="menu-close">
</div>
<div class="wrapper">
    <div class="header">
        <img style="height: 15px; width: 15px;" src="{{asset('img/menu.png')}}" alt="Menu" class="menu-btn">
        <div>
            <span>счёт sop: <br></span>

            <span class="money">
                @if($user->money!=0)
                <?php
                   $money=explode('.',(string)$user->money );
                ?>
                {{ $money[0]}}@if(isset($money[1])).<span style="font-size: 15px">{{$money[1]}}</span>@endif
                 @else
                    0
                @endif
            </span>

        </div>
        <img style="height: 15px; width: 15px;" src="{{asset('img/plus.png')}}" alt="Plus" class="plus-btn">
    </div>

    <form method="POST" action="{{ route('transfer') }}">
        @csrf
        @include('includes.result_messages')
        <div class="form-title">
            <span>Перевод</span>
            <span><label><input  type="radio" name="type" class="radio" id="SOP" value="sop" required>В SOP</label>
            |
            <label><input type="radio" name="type" class="radio" value="card" required>На карту</label>
            </span>
        </div>
        <input class="input" type="phone" name="whom" id="whom" placeholder="номер телефона/номер карты" value="{{ old('whom', '') }}" required>
        <input class="input" type="text" name="money" id="money" placeholder="сумма для перевода" required>
        <input class="input btn" type="submit" value="Перевести" >
    </form>

    <div class="line"></div>
    <span class="title">{{ $money_transfer->count() }} переводов за все время</span>

    @if(isset($money_transfer) && $money_transfer->count() )
        @foreach($money_transfer as $transfer)
            @if($transfer->type=='sop')
                <div class="transfer">
                    <span class="{{ ($transfer->status=='1')?'transfer-status transfer-status-t':'transfer-status transfer-status-f' }}">
                        {{ ($transfer->status=='1')?'Успешно':'Отклонено' }}
                    </span>
                    <p class="transfer-text">Перевод в размере <strong>{{$transfer->money}} SOP</strong> на реквизиты:
                        <strong>{{ $transfer->whom }}</strong></p>
                </div>
            @else
                <div class="transfer">
                    @if($transfer->status!=2)
                        <span class="{{ ($transfer->status=='1')?'transfer-status transfer-status-t':'transfer-status transfer-status-f' }}">
                        {{ ($transfer->status=='1')?'Успешно':'Отклонено' }}
                    </span>
                    @else
                        <span class="transfer-status transfer-status-f">
                        В ожидании
                    </span>
                    @endif
                    <p class="transfer-text">Перевод в размере <strong>{{$transfer->money}} SOP</strong> на карту:
                        <strong>{{ $transfer->whom }}</strong></p>
                </div>
            @endif

        @endforeach
    @endif

</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
<script>

    window.onload = function() {
        @if( session()->has('message-success'))
        alert("{{ session()->get('message-success') }}");
        @endif
    };
</script>
</html>
