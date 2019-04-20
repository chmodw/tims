@extends('home')


@section('main-content')

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Add Trainee
            </div>
            <div class="panel-body">
                <form class="form-inline"  action="{{ route('trainee.find') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group mx-sm-3 mb-3">
                        <label for="epfNo" class="mr-5">EPF No:</label>
                        <input type="text" class="form-control" id="epfNo" name="epfNo" placeholder="" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Find</button>
                </form>
            </div>
        </div>
        @include('layouts._alert')
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Results
            </div>
            <div class="panel-body">
                @if(session('trainee'))
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th style="width: 35%">Name</th>
                            <td>{{session('trainee')[0]['Initial'].' '.\ucwords(strtolower(session('trainee')[0]['Name']))}}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{session('trainee')[0]['DesignationName']}}</td>
                        </tr>
                        <tr>
                            <th>Date Of Appointment</th>
                            <td>{{date('Y-m-d', strtotime(session('trainee')[0]['DateOfAppointment']))}}</td>
                        </tr>
                        <tr>
                            <th>Experience</th>
                            <td>{{
                            date_diff(
                            date_create(date('Y-m-d', strtotime('today'))),
                            date_create(date('Y-m-d', strtotime(session('trainee')[0]['DateOfAppointment']))))
                            ->format('%Y years and %m months')
                            }}</td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td>{{session('trainee')[0]['WorkSpaceTypeName']}}</td>
                        </tr>
                        <tr>
                            <th>EPF</th>
                            <td>{{session('trainee')[0]['EPFNo']}}</td>
                        </tr>
                        <tr>
                            <th>Recruitment Type</th>
                            <td>{{session('trainee')[0]['EmployeeRecruitmentType']}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <form action="{{route('program.store')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="program_id" value="{{$program[0]['program_id']}}">
                                    <input type="hidden" name="epf_no" value="{{session('trainee')[0]['EPFNo']}}">
                                    <input type="hidden" name="recommendation" value="{{session('trainee')[0]['WorkSpaceTypeName']}}">
                                    <input type="hidden" name="type" value="{{$program_type}}">
                                    <input type="submit" class="btn btn-primary padding-left-md" value="Add">
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1" style="">
        <div class="panel panel-default">
            <div class="panel-heading">
                Selected Trainees
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Experience</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--                @foreach($trainees as $trainee)--}}
                    {{--                    <tr>--}}
                    {{--                        <th scope="row">{{$trainee[0]['NameWithInitial']}}</th>--}}
                    {{--                        <td>{{$trainee[0]['DesignationId']}}</td>--}}
                    {{--                        <td>{{date('Y-m-d',strtotime($trainee[0]['DateOfAppointment']))}}</td>--}}
                    {{--                        <td></td>--}}
                    {{--                    </tr>--}}
                    {{--                @endforeach--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>

</script>
@endsection