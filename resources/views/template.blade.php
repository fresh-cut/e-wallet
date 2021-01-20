<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>sop.one</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
<style>
    form{
        height: 280px;
        padding: 20px 30px
    }
    .form-title{
        font-size: 25px;
    }

</style>
<div class="wrapper">
    <form action="">
        <div class="form-title">
            <span>Добро пожаловать</span>
            <span></span>
        </div>
        <a href="{{ route('register') }}" class="link btn" >Зарегистрироваться</a>
        <a href="{{ route('login') }}" class="link btn" >Авторизоваться</a>
    </form>
</div>
</body>
</html>
