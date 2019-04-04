@extends('layouts.app')

@section('main')

    @include('layouts._nav')
    <div class="container ">
        <div class="row">
            {{--SIDE BAR--}}
            @include('layouts._side')
            <main role="main" class="col-md-10 ml-sm-auto col-lg-10">
                @yield('content')
            </main>
        </div>
    </div>
@endsection
