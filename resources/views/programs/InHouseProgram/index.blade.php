@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">In-House Programs</h4>
            <a href="/programs/inhouse/create" class="btn btn-primary">New</a>
        </div>
        <div class="card-body  p-4">
            @include('layouts._alert')

                <div class="table-responsive table-full-width">
                    @include('programs/_table', ['rootLink' => '/programs/inhouse/'])
                </div>

        </div>
    </div>
@endsection
