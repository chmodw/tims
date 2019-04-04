@extends('layouts.main')

@section('content-title', 'Local Programs')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h4 class="card-title">Local Programs</h4>
            <a href="/programs/local/create" class="btn btn-primary">New</a>
        </div>
        <div class="card-body  p-4">
            @include('layouts._alert')
            <div class="table-responsive-md">
                @include('programs/_table', ['rootLink'=>'/programs/local/'])
            </div>
            {{$programs->links()}}
        </div>
    </div>
@endsection
