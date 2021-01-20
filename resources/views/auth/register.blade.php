<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>Регистрация</title>
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
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-title">
            <span style="margin-bottom: 15px">Регистрация</span>
            <span></span>
        </div>
        @include('includes.result_messages')
        <input class="input" type="text" name="name" id="name" placeholder="Введите фио" required value="{{ old('name', '') }}">
        <input class="input" type="email" name="email" id="email" placeholder="Введите e-mail" required value="{{ old('email', '') }}">
        <input class="input" type="text" name="telephone" id="telephone" placeholder="Введите номер телефона" required value="{{ old('telephone', '') }}">
        <input class="input" type="password" name="password" id="password" placeholder="Введите пароль" required>
        <input class="input" type="password" name="password_confirmation" id="password_confirmation" placeholder="Повторите пароль" required>
        <input class="input btn" type="submit" value="Зарегистрироваться" >
    </form>
</div>
</body>
</html>




