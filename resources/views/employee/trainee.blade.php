@extends('home')


@section('main-content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading clearfix">
                <p>Add Employee</p>
                <a href="
                @if($program_type == 'LocalProgram')
                    {{'/local/'.$program['program_id']}}
                @endif
                @if($program_type == 'ForeignProgram')
                    {{'/foreign/'.$program['program_id']}}
                @endif
                @if($program_type == 'InHouseProgram')
                    {{'/inhouse/'.$program['program_id']}}
                @endif
                @if($program_type == 'PostGradProgram')
                    {{'/postgrad/'.$program['program_id']}}
                @endif
                 " class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
            </div>
            <div class="panel-body">
                <form class=""  action="{{ route('trainee.find') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="select_option">Select Search Option</label>
                            <select id="select_option" name="select_option" class="form-control">
                                <option value="EPFNo">EPF Number</option>
                                <option value="NIC">NIC Number</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" style="">
                        <label for="search_content" class="">Content</label>
                        <input type="text" class="form-control" id="search_content" name="search_content" placeholder="Search Content" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" style="margin-top: 23px" class="btn btn-primary">Find</button>
                    </div>
                </form>
            </div>
        </div>
        @include('layouts._alert')
    </div>
    @if(session('trainee'))
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>Results</p>
                </div>
                <div class="panel-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th style="width: 20%">Full Name</th>
                                <td>{{session('trainee')['FullName']}}</td>
                            </tr>
                            <form action="{{route('trainee.store')}}" method="POST">
                                <tr>
                                    <th style="width: 20%">Name With Initials</th>
                                    <td>{{session('trainee')['Initial'].' '.\ucwords(strtolower(session('trainee')['Name']))}}</td>
                                </tr>
                                <tr>
                                    <th>Designation</th>
                                    <td>{{session('trainee')['DesignationName']}}</td>
                                </tr>
                                <tr>
                                    <th>Date Of Appointment</th>
                                    <td>{{date('Y-m-d', strtotime(session('trainee')['DateOfAppointment']))}}</td>
                                </tr>
                                <tr>
                                    <th>Experience</th>
                                    <td>{{
                                    date_diff(
                                    date_create(date('Y-m-d', strtotime('today'))),
                                    date_create(date('Y-m-d', strtotime(session('trainee')['DateOfAppointment']))))
                                    ->format('%Y years and %m months')
                                    }}</td>
                                </tr>
                                <tr>
                                    <th>Recommendation</th>
                                    <td>

                                        <div class="row margin-bottom-md">
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="radio" name="recommendation_radio" aria-label="dgm" checked="checked">
                                                </span>
                                                    <input type="text" name="DGMRecommendation" class="form-control margin-bottom-sm" value="{{str_replace('Unit','',session('trainee')['DGMWorkSpaceTypeName']).'('.session('trainee')['DGMWorkspaceName'].')'}}" aria-label="dgm">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Work Space Code</strong>
                                            </div>
                                            <div class="col-md-3">
                                                {{session('trainee')['DGMWorkSpaceCode']}}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <input type="radio" name="recommendation_radio" aria-label="agm">
                                                </span>
                                                    <input type="text" name="AGMRecommendation" class="form-control margin-bottom-sm" value="{{str_replace('Unit','',session('trainee')['AGMWorkSpaceTypeName']).'('.session('trainee')['AGMWorkspaceName'].')'}}" aria-label="agm">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <strong>Work Space Code</strong>
                                            </div>
                                            <div class="col-md-3">
                                                {{session('trainee')['AGMWorkspaceCode']}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Grade</th>
                                    <td>{{session('trainee')['GradeName']}}</td>
                                </tr>
                                <tr>
                                    <th>EPF</th>
                                    <td>{{session('trainee')['EPFNo']}}</td>
                                </tr>
                                <tr>
                                    <th>Recruitment Type</th>
                                    <td>{{session('trainee')['EmployeeRecruitmentType']}}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        {{ csrf_field() }}
                                        <input type="hidden" required name="program_id" value="{{$program['program_id']}}">
                                        <input type="hidden" required name="epf_no" value="{{session('trainee')['EPFNo']}}">
                                        <input type="hidden" required name="type" value="{{$program_type}}">
                                        <input type="submit" class="btn btn-primary padding-left-md" value="Add">
                                    </td>
                                </tr>
                            </form>
                            </tbody>
                        </table>
                </div>

            </div>
        </div>
    @endif
    <div class="col-md-12" style="">
        <div class="panel panel-default">
            <div class="panel-heading">
                <p>Selected Trainees</p>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Experience</th>
                        <th scope="col">Recommendation</th>
                        <th scope="col">Recruitment Type</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($programs as $program)
                        <tr>
                            <td scope="row"><a href="{{route('employee.show', $program['EPFNo'])}}">{{$program['Initial'].' '.\ucwords(strtolower($program['Name']))}}</a></td>
                            <td>{{$program['DesignationName']}}</td>
                            <td>{{
                                    date_diff(
                                    date_create(date('Y-m-d', strtotime('today'))),
                                    date_create(date('Y-m-d', strtotime($program['DateOfAppointment']))))
                                    ->format('%Y years and %m months')
                                    }}
                            </td>
                            <td>{{$program['recommendation']}}</td>
                            <td>{{$program['EmployeeRecruitmentType']}}</td>
                            <td>
                                <form method="POST" action="{{ route('trainee.destroy', $program['program_id'])}}">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <input name="EPFNo" type="hidden" value="{{$program['EPFNo']}}">
                                    <input name="program_id" type="hidden" value="{{$program['program_id']}}">
                                    <button  class="btn btn-link" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-minus-sign" style="color: red;"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>

</script>
@endsection