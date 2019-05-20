@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('postgrad.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')" style="margin-right:8px; margin-top: 14px;"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('program/PostGradProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{url('/postgrad/'.$program->program_id.'/edit')}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/postgrad/create"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
            <a href="{{route('postgrad.index')}}" class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            <div class="col-lg-9">
                <div class="page-header">
                    <h2>{{$program->program_title}}</h2>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <th style="width: 25%"></th>
                        <th style="width: 25%"></th>
                        <th style="width: 25%"></th>
                        <th style="width: 25%"></th>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="1"><p>Institute</p></th>
                        <td colspan="3">{{$program->organisation->name}}</td>
                    </tr>
                    <tr>
                        <th colspan="1"><p>Department</p></th>
                        <td colspan="3">{{$program->department}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Target Group</th>
                        <td colspan="3">{{$program->target_group}}</td>
                    </tr>
                    <tr>
                        <th colspan="1"><p>Eligibility</p></th>
                        <td colspan="3">
                            @foreach($program['requirements'] as $requirement)
                                <p>{{$requirement}},</p>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1">Start Date</th>
                        <td colspan="1">{{\date('Y-m-d',strtotime($program->start_date))}}</td>
                        <th colspan="1">Duration</th>
                        <td colspan="1">{{$program->duration}} <Months></Months></td>
                    </tr>
                    <re>
                        <th colspan="1">Application Closing Date</th>
                        <td colspan="1">{{\date('Y-m-d',strtotime($program->application_closing_date_time))}}</td>
                        <th colspan="1">Time</th>
                        <td colspan="1">{{\date('H:i',strtotime($program->application_closing_date_time))}}</td>
                    </re>
                    <tr>
                        <th colspan="1"><p>Registration Fee</p></th>
                        <td colspan="1">{{$program->registration_fees}}</td>
                        <th colspan="1"><p>Other Costs</p></th>
                        <td colspan="1">
                            @foreach($program->other_costs as $cost)
                                <p class="">Installment {{$cost['name']}} = {{$cost['value']}}/- </p>
                                <hr>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th colspan="1">Created By</th>
                        <td colspan="1">{{$program->created_by}}</td>
                        <th colspan="1">Created On</th>
                        <td colspan="1">{{$program->created_at}}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Updated By</th>
                        <td colspan="1">{{$program->updated_by}}</td>
                        <th colspan="1">Updated On</th>
                        <td colspan="1">{{$program->updated_at}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            {{--Status Bar--}}
            @include('programs.partials.sideBar')

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Documents
                    </div>
                    <div class="panel-body">
                        @include('programs.partials.docselect', ['program_type' => 'PostGradProgram'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            $(document).ready(function() {
                $('#summernote').summernote();
            });
        }
    </script>

@endsection