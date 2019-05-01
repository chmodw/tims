@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('foreign.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')" style="margin-right:8px;"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('trainee/index/ForeignProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{route('foreign.edit', $program->program_id)}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{route('foreign.create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <div class="page-header">
                <h1>{{$program->program_title}}</h1>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                <th style="width: 5%"></th>
                </thead>
                <tbody>
                <tr>
                    <th colspan="3">Target Group</th>
                    <td colspan="17">{{$program->target_group}}</td>
                </tr>
                <tr>
                    <th colspan="3">Organised By</th>
                    <td colspan="7">{{$program->name}}</td>
                    <th colspan="3">Venue</th>
                    <td colspan="7">{{$program->venue}}</td>
                </tr>
                <tr>
                    <th colspan="2">Start Date</th>
                    <td colspan="2">{{\date('Y-m-d',strtotime($program->start_date))}}</td>
                    <th colspan="2">Duration</th>
                    <td colspan="3">{{$program->duration}}{{$program->is_long_term == 1 ? ' months' : ' days'}}</td>
                    <th colspan="4">Application Closing Date</th>
                    <td colspan="2">{{\date('Y-m-d',strtotime($program->application_closing_date_time))}}</td>
                    <th colspan="2">Time</th>
                    <td colspan="3">{{\date('H:i',strtotime($program->application_closing_date_time))}}</td>
                </tr>
                <tr>
                    <th colspan="3">Nature of the Employment</th>
                    <td colspan="7">{{$program->nature_of_the_employment}}</td>
                    <th colspan="3">Employee Category</th>
                    <td colspan="7">{{$program->employee_category}}</td>
                </tr>
                <tr>
                    <th colspan="3">Program Fee (Rs)</th>
                    <td colspan="5">{{$program->program_fee}}</td>
                    <th colspan="3">Program Brochure</th>
                    <td colspan="9">{{$program->brochure_url}}</td>
                </tr>
                <tr>
                    <th colspan="2">Created By</th>
                    <td colspan="3">{{$program->created_by}}</td>
                    <th colspan="2">Created On</th>
                    <td colspan="3">{{$program->created_at}}</td>
                    <th colspan="2">Updated By</th>
                    <td colspan="3">{{$program->updated_by}}</td>
                    <th colspan="2">Updated On</th>
                    <td colspan="3">{{$program->updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            Documents
        </div>
        <div class="panel-body">
            <a class="btn btn-primary" style="margin-right:8px;" href="/pdf/LocalProgram/{{$program->program_id}}">Approval Letter</a>
        </div>
    </div>

    <script>

    </script>
@endsection