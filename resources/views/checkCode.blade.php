<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>Подстверждение через смс</title>
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
    <form method="POST" action="{{ route('checkCode') }}">
        @csrf
        <div class="form-title">
            <span style="margin-bottom: 15px"> Введите 4-ех значный код с вашего мобильного телефона для подписания договора и создания счета</span>
            <span></span>
        </div>
        @include('includes.result_messages')
        <input type="number" name="code" placeholder="code" required>
        <input type="submit" value="Подтвердить" class="btn">
    </form>
</div>
</body>
</html>




