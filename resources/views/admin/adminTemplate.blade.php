<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="{{asset('css/css/app.css')}}">
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
    <link rel="icon" href="/favicon.png" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

    {{--    <script src="//code.jquery.com/jquery-3.5.1.min.js" ></script>--}}

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-2 sidebar" >
            <ul class="sidebar-menu list-unstyled">

                <li class="sidebar-menu-item"><a class="sidebar-menu-link" href="{{ route('admin.user.index') }}">Пользователи</a></li>
                <li class="sidebar-menu-item"><a class="sidebar-menu-link" href="{{ route('admin.logout') }}">Выход</a></li>
            </ul>
        </div>
        <div class="col-10">

        @yield('content')
        </div>
    </div>
</div>
<script scr="{{ asset('js/app.js')}}"></script>
</body>
</html>
