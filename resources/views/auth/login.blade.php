<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>Авторизация</title>
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
    .form-title{
        font-size: 25px;
    }

</style>
<div class="wrapper">
    <form method="POST" action="{{route('login')}}">
        @csrf
        <div class="form-title">
            <span style="margin-bottom: 15px">Вход в систему</span>
            <span></span>
        </div>
        @include('includes.result_messages')
        <input class="input" type="phone" name="telephone" id="telephone" placeholder="Введите номер телефона">
        <input class="input" type="password" name="password" id="password" placeholder="Введите пароль">

        <div class="form-title">
            {!! app('captcha')->display() !!}
            <span></span>
        </div>
        <input class="input btn" type="submit" value="Авторизоваться">
    </form>
</div>
</body>
{!! NoCaptcha::renderJs()  !!}
</html>




