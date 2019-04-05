@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body p-4">
                    @include('layouts._alert')
                    {{$programs[0]}}
                </div>
            </div>
        </div>
    </div>
@endsection
