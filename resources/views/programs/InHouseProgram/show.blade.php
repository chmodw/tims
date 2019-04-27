@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('inhouse.destroy', $program->program_id) }}">
                {{method_field('DELETE')}}
                <input type="hidden" value="LocalProgram" name="program_type">
                <input type="hidden" value="{{$program->program_id}}" name="program_id">
                <button  class="btn btn-danger pull-right" style="margin-right:8px;"><i class="glyphicon glyphicon-trash margin-right-md"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="/programs/trainee/LocalProgram/{{$program->program_id}}"><i class="glyphicon glyphicon-user margin-right-md"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="/programs/edit/LocalProgram/{{$program->program_id}}"><i class="glyphicon glyphicon-pencil margin-right-md"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/programs/create/LocalProgram"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
{{$program}}
            <br>
            {{$costs}}
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Organised By</th>
                            <td class="col-md-4">{{$program->name}}</td>
                            <th class="col-md-2">Target Group</th>
                            <td class="col-md-4">{{$program->target_group}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Start Date</th>
                            <td class="col-md-4">{{$program->start_date}}</td>
                            <th class="col-md-2">Duration</th>
                            <td class="col-md-4">{{$program->duration}}{{$program->is_long_term == 1 ? ' months' : ' days'}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Application Closing On</th>
                            <td class="col-md-4">{{$program->application_closing_date_time}}</td>
                            <th class="col-md-2">Nature of the Employment</th>
                            <td class="col-md-4">{{$program->nature_of_the_employment}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Employee Category</th>
                            <td class="col-md-4">{{$program->employee_category}}</td>
                            <th class="col-md-2">Venue</th>
                            <td class="col-md-4">{{$program->venue}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Registration Fee</th>
                            <td class="col-md-4">{{$program->program_fee}}</td>
                            <th class="col-md-2">Non Member Fee</th>
                            <td class="col-md-4">{{$program->non_member_fee}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Member Fee</th>
                            <td class="col-md-4">{{$program->member_fee}}</td>
                            <th class="col-md-2">Student Fee</th>
                            <td class="col-md-4">{{$program->student_fee}}</td>
                        </div>
                    </tr>

                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Program Brochure</th>
                            <td class="col-md-4"><a href="{{$program->brochure_url}}" class="{{$program->brochure_url == null ? ' hide' : ''}}">View</a></td>
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
            <a class="btn btn-primary" style="margin-right:8px;" href="/pdf/LocalProgram/{{$program->program_id}}">Approval Letter</a>
        </div>
    </div>

    <script>

    </script>
@endsection