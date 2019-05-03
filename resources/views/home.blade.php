@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'TIMS')

@section('content')
    @yield('main-content')
@stop

@section('css')
{{--    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/datatable/datatable.css')}}">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('vendor/summernote/summernote.css')}}">
@stop

@section('js')
{{--    <script src="{{ asset('vendor/adminlte/vendor/datatable/datatables.js')}}"></script>--}}
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Summer Note -->
    <script src="{{ asset('vendor/summernote/summernote.js') }}"></script>
    <script>
    </script>
@stop