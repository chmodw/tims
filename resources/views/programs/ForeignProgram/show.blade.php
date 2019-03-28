@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">{{$program->title}}</h4>
                    <a href="/programs/foreign/create" class="btn btn-primary">New</a>
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($localPrograms as $program)
                                <tr>
                                    <td>1</td>
                                    <td>{{$program->title}}</td>
                                    <td>{{$program->applicationClosingDate}}</td>
                                    <td>sdkjnsdfdjfsjkndf</td>
                                    <td><a href="/programs/local/{{$program->programId}}">View</a></td>
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
