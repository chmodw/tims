@extends('layouts.app')

@section('main')

    @include('layouts._nav')
    <div class="container ">
        <div class="row">
            {{--SIDE BAR--}}
            @include('layouts._side')

            <div class="col-md-10 col-lg-10 main-container">

                @yield('content')

            </div>

        </div>
    </div>
@endsection
