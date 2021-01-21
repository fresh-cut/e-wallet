<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
  , initial-scale=1.0">
    <title>Подтверждение через смс</title>
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
    <form id="form">
        <div class="form-title">
            <span style="margin-bottom: 15px"> Введите 4-ех значный код с вашего мобильного телефона для подтвеждения операции
            </span>
            <span></span>
        </div>
        <span id="error" class="visually-hidden" style="color:red; font-size: 15px">Перепроверьте SMS-код</span>
        <input class="input" onclick="removeBorder()" type="number" name="code" id="code" placeholder="code" required>
        <div id="timerBlock" class="visually-hidden"  style="margin-bottom: 10px">
            <p style="font-size: 14px">Выслать код повторно через <span class="seconds">60</span> секунд</p>
        </div>
        <input type="button" onclick="run()" value="Подтвердить" class="btn input">
    </form>

</div>
</body>
</html>

<script src="//code.jquery.com/jquery-3.5.1.min.js" ></script>
<script src="{{ asset('js/check.js') }}"></script>
<script>
    form.addEventListener('keydown', function(event) {
        if(event.keyCode == 13) {
            event.preventDefault();
        }
    });

    function backClick()
    {
        location.href="/operationCheck?back=14";
    }

    $('#timerBlock').removeClass('visually-hidden');
    time(60);

    function removeBorder(){
        $('#code').removeClass('red-border');
        $('#error').addClass('visually-hidden');
    }

    function time(time)
    {
        var timerBlock = $('.seconds');
        var num = time; //количество секунд
        var index = num;
        var timerId = setInterval(function() {
            timerBlock.html(--index);
        }, 1000)

        setTimeout(function() {
            clearInterval(timerId);
            $('#timerBlock').html('<button type="button" onclick="backClick()">Выслать код повторно</button>');
        }, num*1000);
    }

    function run(){
        var value=$('#code').val();
        $.ajax({
            url: '{{ route('operationCheckCode') }}',
            type: "POST",
            traditional: true,
            data:  {
                "code": value,
                "_token": "{{ csrf_token() }}",
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function (data) {
                console.log('ok');
                window.location.pathname = '/continueTransfer';
            },
            error: function (msg) {
                $('#error').removeClass('visually-hidden');
                $('#timerBlock').removeClass('visually-hidden');
                $('#code').addClass('red-border');
                console.log('error');
            }
        });
    }
</script>




