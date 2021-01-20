<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>Contract</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <form method="get" action="{{ route('verifed') }}">
        <div class="form-title">
            <span style="margin-bottom: 15px">Подписание договора</span>
            <span></span>
        </div>
        <a style="text-align: left; width: 100%" href="{{ asset('terms-of-use.docx') }}">Пользовательское соглашение</a>
        <input class=" btn input" type="submit" value="Подписать">
    </form>

</div>
</body>
</html>




