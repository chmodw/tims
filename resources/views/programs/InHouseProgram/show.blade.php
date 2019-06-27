@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('inhouse.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" style="margin-right:8px; margin-top: 14px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('program/InHouseProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{url('/inhouse/'.$program->program_id.'/edit')}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/inhouse/create"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
            <a href="{{route('inhouse.index')}}" class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
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
                            <th colspan="1"><p>Organised By</p></th>
                            <td colspan="3">{{$program->organisation->name}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Target Group</th>
                            <td colspan="3">{{$program->target_group}}</td>
                        </tr>
                        <tr>
                            <th colspan="1"><p>Nature Of The Employment</p></th>
                            <td colspan="3">{{$program->nature_of_the_employment}}</td>
                        </tr>
                        <tr>
                            <th colspan="1"><p>Employee Category</p></th>
                            <td colspan="3">{{$program->employee_category}}</td>
                        </tr>
                        <tr>
                            <th colspan="1"><p>Resource Person(s)</p></th>
                            <td colspan="3">
                                @foreach($program->resource_person as $person)
                                    <p class="cost-title"><b>Name: </b> {{$person['name']}}</p>
                                    <p class="cost-title"><b>Designation: </b> {{$person['designation']}}</p>
                                    <p class="cost-title"><b>Cost(Rs): </b> {{$person['cost']}}/=</p>
                                    <hr>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th colspan="1"><p>Application Closing Date</p></th>
                            <td colspan="1">{{\date('Y-m-d', \strtotime($program->application_closing_date_time))}}
                            <th colspan="1">Time</th>
                            <td colspan="1">{{\date('H:i', \strtotime($program->application_closing_date_time))}}</td>
                        </tr>
                        <tr>
                            <th colspan="1"><p>Start Date</p></th>
                            <td colspan="1">{{\date('Y-m-d', \strtotime($program->start_date))}}</td>
                            <th colspan="1">Time</th>
                            <td colspan="1">{{\date('H:i', \strtotime($program->start_date))}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">End Time</th>
                            <td colspan="1">{{\date('H:i', \strtotime($program->end_time))}}</td>
                            <th colspan="1"><p>Duration</p></th>
                            <td colspan="1">{{\number_format((float)$program->hours, 2, '.', '')}} Hours</td>
                        </tr>
                    <tr>
                        <th colspan="1"><p>No-Show Fee (Rs)</p></th>
                        <td colspan="1">{{$program->no_show_fee}}</td>
                        <th colspan="1"><p>Per person Fee (Rs)</p></th>
                        <td colspan="1">{{$program->per_person_fee}}</td>
                    </tr>
                    <tr>
                        <th colspan="1"><p>Other Costs (Rs)</p></th>
                        <td colspan="3">
                            @foreach($program->other_costs as $cost)
                                <p class="cost-title"><b>{{ucfirst($cost['name'])}}</b> - {{$cost['value']}}/=</p>
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

                @include('programs.partials.sideBar')
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Documents
                    </div>
                    <div class="panel-body">
                        @include('programs.partials.docselect', ['program_type' => 'InHouseProgram'])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection