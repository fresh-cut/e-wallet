function backClick()
{
    location.href="/contractVerifed?back=12";
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
        $('#timerBlock').html('<button onclick="backClick()">Выслать код повторно</button>');
    }, num*1000);
}


