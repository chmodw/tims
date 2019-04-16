@extends('home')

@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <a class="btn btn-danger pull-right" style="margin-right:8px;" href="/programs/delete/LocalProgram/{{$program[0]->program_id}}"><i class="glyphicon glyphicon-trash margin-right-md"></i>&nbsp;Delete</a>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="/programs/trainee/LocalProgram/{{$program[0]->program_id}}"><i class="glyphicon glyphicon-user margin-right-md"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="/programs/edit/LocalProgram/{{$program[0]->program_id}}"><i class="glyphicon glyphicon-pencil margin-right-md"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/programs/create/LocalProgram"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
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
                    {{--            [{"program_id":"c086f1aa1ea0ead56f1a6fea1ae9ee9d","program_title":"748skdj","target_group":"kjndfjnk","start_date":"2019-04-26 00:00","duration":"878","application_closing_date_time":"2019-04-16 11:03","nature_of_the_employment":"a:1:{i:0;s:14:\"fixed contract\";}","employee_category":"s:51:\"a:2:{i:0;s:9:\"technical\";i:1;s:13:\"non-technical\";}\";","venue":"000","is_long_term":"0","program_fee":null,"non_member_fee":"0.0","member_fee":"0.0","student_fee":"0.0","brochure_url":null,"name":"new institute"}]--}}
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Employee Category</th>
                            <td class="col-md-4">{{$program[0]->nature_of_the_employment}}</td>
                            <th class="col-md-2">Venue</th>
                            <td class="col-md-4">{{$program[0]->venue}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Program Fee</th>
                            <td class="col-md-4">{{$program[0]->program_fee}}</td>
                            <th class="col-md-2">Non Member Fee</th>
                            <td class="col-md-4">{{$program[0]->non_member_fee}}</td>
                        </div>
                    </tr>
                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Member Fee</th>
                            <td class="col-md-4">{{$program[0]->member_fee}}</td>
                            <th class="col-md-2">Student Fee</th>
                            <td class="col-md-4">{{$program[0]->student_fee}}</td>
                        </div>
                    </tr>

                    <tr class="row">
                        <div class="col-md-12">
                            <th class="col-md-2">Program Brochure</th>
                            <td class="col-md-4"><a href="{{$program[0]->brochure_url}}" class="{{$program[0]->brochure_url == null ? ' hide' : ''}}">View</a></td>
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