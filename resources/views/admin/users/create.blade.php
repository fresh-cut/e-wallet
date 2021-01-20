@extends('admin.adminTemplate')
@section('title')
    Добавление региона
@endsection
@section('content')
    <h1>Добавление региона</h1>
    @include('admin.includes.result_messages')
    <form action="{{ route('admin.regions.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', '') }}" autocomplete="off" required>
        </div>

        <div class="form-group">
            <label for="url">Url</label>
            <input type="text" class="form-control" id="url" name="url" value="{{ old('url', '') }}" autocomplete="off" required>
        </div>
        <div class="form-group">
            <button class="btn btn-dark" type="submit">Сохранить</button>
            <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary ">назад</a>
        </div>
    </form>

@endsection
