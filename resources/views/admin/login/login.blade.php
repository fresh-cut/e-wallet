<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="{{asset('css/css/app.css')}}">
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <h2 align="center">Login</h2>
                @include('includes.result_messages')
                <div class="form-group">
                    <input type="text" id="login" name="login" class="form-control" placeholder="Login" required autofocus>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-dark btn-block" type="submit">Go</button>
            </form>
        </div>
    </div>

</body>
</html>
