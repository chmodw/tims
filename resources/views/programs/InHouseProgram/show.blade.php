@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form meth` od="POST" action="{{ route('inhouse.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" style="margin-right:8px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('trainee/index/InHouseProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{url('/inhouse/'.$program->program_id.'/edit')}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/inhouse/create"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
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
                        <th colspan="2"><p>Organised By</p></th>
                        <td colspan="8">{{$program->program_title}}</td>
                        <th colspan="2"><p>Target Group</p></th>
                        <td colspan="8">{{$program->target_group}}</td>
                    </tr>
                    <tr>
                        <th colspan="2"><p>Start Date</p></th>
                        <td colspan="3">{{\date('Y-m-d', \strtotime($program->start_date))}}</td>
                        <th colspan="1">Time</th>
                        <td colspan="2">{{\date('H:i', \strtotime($program->start_date))}}</td>
                        <th colspan="3"><p>Application Closing Date</p></th>
                        <td colspan="2">{{\date('Y-m-d', \strtotime($program->application_closing_date_time))}}</td>
                        <th colspan="2">Time</th>
                        <td colspan="1">{{\date('H:i', \strtotime($program->application_closing_date_time))}}</td>
                        <th colspan="2"><p>Duration</p></th>
                        <td colspan="2">{{$program->hours}} Hours</td>
                    </tr>
                    <tr>
                        <th colspan="3"><p>Nature Of The Employment</p></th>
                        <td colspan="7">{{$program->nature_of_the_employment}}</td>
                        <th colspan="2"><p>Employee Category</p></th>
                        <td colspan="8">{{$program->employee_category}}</td>
                    </tr>
                    <tr>
                        <th colspan="3"><p>Resource Person(s)</p></th>
                        <td colspan="17">
                            @foreach($costs as $cost)
                                @if($cost['cost_name'] == 'resource person')
                                    <span><p class="cost-title">Name:</p> {{$cost['cost_content'][0]}}</span>
                                    <span><p class="cost-title">Designation:</p> {{$cost['cost_content'][1]}}</span>
                                    <span><p class="cost-title">Cost(Rs):</p> {{$cost['cost_value']}}/=</span>
                                    <br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2"><p>No-Show Fee (Rs)</p></th>
                        <td colspan="3">{{$program->no_show_fee}}</td>
                        <th colspan="2"><p>Per person Fee (Rs)</p></th>
                        <td colspan="3">{{$program->per_person_fee}}</td>
                        <th colspan="2"><p>Other Costs (Rs)</p></th>
                        <td colspan="8">
                            @foreach($costs as $cost)
                                @if($cost['cost_name'] == 'other cost')
                                    <span><p class="cost-title">{{ucfirst($cost['cost_content'])}} = </p> {{$cost['cost_value']}}/=</span>
                                    <br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3">Program Brochure</th>
                        <td colspan="17">{{$program->brochure_url}}</td>
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
            <form>

                <select name="document_name">
                    <option value=""></option>
                </select>
                
            </form>
            <a class="btn btn-primary" style="margin-right:8px;" href="/pdf/LocalProgram/{{$program->program_id}}">Approval Letter</a>

        </div>
    </div>


@endsection