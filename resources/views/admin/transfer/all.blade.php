@extends('admin.adminTemplate')
@section('title')
    Переводы
@endsection
@section('content')
    <h1>Переводы</h1>
    <br>
    @include('includes.result_messages')
    @include('admin.transfer.includes.main_col')

@endsection
