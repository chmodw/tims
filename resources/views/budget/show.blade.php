@extends('home')


@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h1 class="program-title">{{$program[0]->program_title}}</h1>
            <a class="btn btn-danger pull-right" style="margin-right:8px;" href="/programs/delete/LocalProgram/{{$program[0]->program_id}}"><i class="glyphicon glyphicon-trash margin-right-md"></i>&nbsp;Delete</a>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="/programs/trainees/LocalProgram/{{$program[0]->program_id}}"><i class="glyphicon glyphicon-user margin-right-md"></i>&nbsp;Trainees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="/programs/edit/LocalProgram/{{$program[0]->program_id}}"><i class="glyphicon glyphicon-pencil margin-right-md"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/programs/create/LocalProgram"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
{{--            [{"id":3,"program_id":"35fa09e13f3892942356670ddf032925","program_title":"Est nostrum eos","organised_by":"Commodi veniam eum laudantium","target_group":"Nemo delectus neque facilis tempora et et necessitatibus possimus ut recusandae et ut iste","start_date":"2020-11-26 19:20:25.000","end_date":"2021-02-11 01:40:21.000","application_closing_date_time":"2019-07-17 00:27:32.000","nature_of_the_appointment":"Permanent","employee_category":"Technical","venue":"Main Hall","is_long_term":"1","course_fee":"1982.0","duration":"3","non_member_fee":"1407.0","member_fee":"1657.0","student_fee":"1446.0","brochure_url":"public\/brochures\/bd141fbc4195ca206c1fc474ad23410a.jpg","created_by":"monserrate80@example.org","updated_by":null,"created_at":"2019-04-09 10:56:07.000","updated_at":"2019-04-09 10:56:07.000"}]--}}
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th style="width: 15%">Origanised By</th>
                    <td colspan="3">{{$program[0]->organised_by}}</td>
                </tr>
                <tr>
                    <th style="width: 15%">Target Group</th>
                    <td colspan="3">{{$program[0]->target_group}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">start Date</th>
                    <td>{{date('Y-m-d',strtotime($program[0]->start_date))}}</td>
                    <th style="width: 20%">End Date</th>
                    <td>{{date('Y-m-d',strtotime($program[0]->end_date))}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">Application Closing Date</th>
                    <td>{{date('Y-m-d',strtotime($program[0]->application_closing_date_time))}}</td>
                    <th style="width: 10%">Venue</th>
                    <td>{{$program[0]->venue}}</td>
                </tr>
                <tr>
                    <th style="">Nature of the appointment</th>
                    <td>{{$program[0]->nature_of_the_appointment}}</td>
                    <th style="">Employee Category</th>
                    <td>{{$program[0]->employee_category}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">Member Fee (RS)</th>
                    <td>{{$program[0]->member_fee}}</td>
                    <th style="width: 10%">Student Fee (RS)</th>
                    <td>{{$program[0]->student_fee}}</td>
                </tr>
                <tr>
                    <th style="width: 10%">Non Member Fee (RS)</th>
                    <td>{{$program[0]->non_member_fee}}</td>
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
            <a class="btn btn-primary" style="margin-right:8px;" href="/pdf/LocalProgram/{{$program[0]->program_id}}">GM Approval Letter</a>
        </div>
    </div>

    <script>

    </script>
@endsection