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
                        <table border="0" class="table table-striped">
                            <thead class="">
                                <tr>
                                    <th class="" scope="col">#</th>
                                    <th class="" scope="col">Title</th>
                                    <th class="" scope="col">Application Closing Date</th>
                                    <th class="" scope="col">Start Date</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($programs as $i => $program)
                                        <tr>
{{--                                            <td scope="row">{{16*$i}}</td>--}}
                                            <td scope="row">{{isset($_GET['page']) ? (16 * $_GET['page']) - (16-$i) + 1 : $i+1}}</td>
                                            <td><a href="/programs/local/{{$program->programId}}">{{$program->title}}</a></td>
                                            <td>{{$program->applicationClosingDate}}</td>
                                            <td>{{$program->startingDate}}</td>
                                            <td><a href="/programs/local/{{$program->programId}}">
                                                    <i class="fa fa-eye" style="color: blue" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if(strtotime($program->applicationClosingDate) > strtotime('now'))
                                                    <a href="{{url('/programs/local/'.$program->programId)}}">
                                                        <i class="fa fa-plus" style="color: green;" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtotime($program->applicationClosingDate) > strtotime('now'))
                                                    <a href="{{url('programs/local/edit/'.$program->programId)}}">
                                                        <i class="fa fa-pencil" style="color: orange;" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(strtotime($program->applicationClosingDate) > strtotime('now'))
                                                    <a href="/programs/local/{{$program->programId}}">
                                                        <i class="fa fa-trash " style="color: red" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$programs->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
