@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Post-Graduation Programs</h4>
            <a href="/programs/postgrad/create" class="btn btn-primary">New</a>
        </div>
        <div class="card-body  p-4">
            @include('layouts._alert')
                <div class="table-responsive table-full-width">
                    @include('programs/_table', ['rootLink'=>'/programs/postgrad/'])
                </div>
        </div>
    </div>
@endsection
