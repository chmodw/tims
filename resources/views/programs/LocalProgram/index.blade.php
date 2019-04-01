@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Local Programs</h4>
                    <a href="/programs/local/create" class="btn btn-primary">New</a>
                </div>
                <div class="card-body  p-4">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong>{{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive-md">
                        @include('programs/_table', ['rootLink'=>'/programs/local/'])
                    </div>
                    {{$programs->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
