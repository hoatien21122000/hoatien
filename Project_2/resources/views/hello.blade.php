@extends('layout')
@section('content')
HELLO
    @if (Session::has('registrar_name'))
            {{ Session::get('registrar_name') }}
    @else(Session::has('teacher_name'))
            {{ Session::get('teacher_name') }}
    @endif
@endsection