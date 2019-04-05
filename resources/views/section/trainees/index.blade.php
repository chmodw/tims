@extends('layouts.app')

@section('content-title', 'Sections')

@section('content')

    <div class="row">

        @foreach($sections as $section)

            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Section Name : {!! $section->sectionName !!}</h4>
                    </div>
                    <div class="card-body">
                        {{--table start--}}
                        <div class="table-responsive table-full-width">
                            <table class="table table-hover">
                                <thead>
                                <th>Program ID</th>
                                <th>Full name </th>
                                <th>Mobile Number</th>
                                <th>Email</th>
                                </thead>
                                <tbody>
                                @foreach($section->trainees as $trainee)

                                    <tr>
                                        <td>{!! $trainee->program_id !!}</td>
                                        <td>{!! $trainee->full_name !!}</td>
                                        {{--<td>{{$section->createdBy}}</td>--}}

                                        <td>{!! $trainee->mobile !!}</td>
                                        <td>{!! $trainee->office_email !!}</td>

                                        {{--<td><a href="{{route('section.edit',$section->id)}}" class="btn btn-primary btn-xs" > Edit | {{$section->id}}</a></td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>

        @endforeach

    </div>

@endsection



