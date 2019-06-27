@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'TIMS')


@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/datatable/datatable.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('content')
    @yield('main-content')
@stop

@section('js')
    <script src="{{ asset('vendor/adminlte/vendor/datatable/datatables.js')}}"></script>
    <script src="{{ asset('vendor/fullcalendar/moment.min.js')}}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@stop