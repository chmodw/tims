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

                        <div class="table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="">Title</th>
                                    <th class="">Application Closing Date</th>
                                    <th class="">Start Date</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($programs as $program)
                                    <tr>
                                        <td>1</td>
                                        <td>{{$program->title}}</td>
                                        <td>{{$program->applicationClosingDate}}</td>
                                        <td>{{$program->startingDate}}</td>
                                        <td><a href="/programs/local/{{$program->programId}}">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td><a href="/programs/local/{{$program->programId}}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td><a href="/programs/local/{{$program->programId}}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td><a href="/programs/local/{{$program->programId}}">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
