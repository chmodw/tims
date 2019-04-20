@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('foreign.destroy', $program[0]->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')" style="margin-right:8px;"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('trainee/index/ForeignProgram/'.$program[0]->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{route('foreign.edit', $program[0]->program_id)}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{route('foreign.create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Organised By</th>
                            <td class="col-md-4">{{$program[0]->name}}</td>
                            <th class="col-md-2">Target Group</th>
                            <td class="col-md-4">{{$program[0]->target_group}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Start Date</th>
                            <td class="col-md-4">{{$program[0]->start_date}}</td>
                            <th class="col-md-2">Duration</th>
                            <td class="col-md-4">{{$program[0]->duration}}{{$program[0]->is_long_term == 1 ? ' months' : ' days'}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Application Closing On</th>
                            <td class="col-md-4">{{$program[0]->application_closing_date_time}}</td>
                            <th class="col-md-2">Nature of the Employment</th>
                            <td class="col-md-4">{{$program[0]->nature_of_the_employment}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Employee Category</th>
                            <td class="col-md-4">{{$program[0]->employee_category}}</td>
                            <th class="col-md-2">Venue</th>
                            <td class="col-md-4">{{$program[0]->venue}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Program Fee</th>
                            <td class="col-md-4">{{$program[0]->program_fee}}</td>
                        </div>
                    </tr>

                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Program Brochure</th>
                            <td class="col-md-4"><a href="/storage/brochures/{{$program[0]->brochure_url}}" class="{{$program[0]->brochure_url == null ? ' hide' : ''}}">View</a></td>
                            <th class="col-md-2"></th>
                            <td class="col-md-4"></td>
                        </div>
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
            <a class="btn btn-primary" style="margin-right:8px;" href="/pdf/LocalProgram/{{$program[0]->program_id}}">Approval Letter</a>
        </div>
    </div>

    <script>

    </script>
@endsection