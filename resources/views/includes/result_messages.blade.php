@if($errors->any())
    <div style="width: 100%" class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li style="text-align: left">{{ $error }}</li>
                @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div style="width: 100%" class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif
