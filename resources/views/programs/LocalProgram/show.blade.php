{{--search employees--}}
{{--add employees--}}
{{--show program results--}}

@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">{{$program[0]->title}}</h4>
                </div>
                <div class="card-body  p-4">
                    {{--Messages--}}
                    @include('_alert')

                    <img src="{{str_replace("public", "storage", url($program[0]->brochureUrl))}}" alt="" class="img-thumbnail">
                    {{$program[0]}}


                </div>
            </div>
        </div>
    </div>
@endsection
