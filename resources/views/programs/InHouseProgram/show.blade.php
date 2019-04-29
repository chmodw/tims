@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('inhouse.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" style="margin-right:8px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('trainee/index/InHouseProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{url('/inhouse/'.$program->program_id.'/edit')}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/inhouse/create"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">

            <div class="table-striped-custom">
                <div class="row">
                    <div class="table-title col-md-2"><p>Title</p></div>
                    <div class="table-content col-md-10"><h>{{$program->program_title}}</h></div>
                </div>
                <div class="row">
                    <div class="table-title col-md-2"><p>Organised By</p></div>
                    <div class="table-content col-md-4">{{$program->program_title}}</div>
                    <div class="table-title col-md-2"><p>Target Group</p></div>
                    <div class="table-content col-md-4">{{$program->program_title}}</div>
                </div>
                <div class="row">
                    <div class="table-title col-md-2"><p>Start Date and Time</p></div>
                    <div class="table-content col-md-2">{{\date('Y-m-d', \strtotime($program->start_date))}}<br>{{\date('H:i', \strtotime($program->start_date))}}</div>
                    <div class="table-title col-md-3"><p>Application Closing Date And Time</p></div>
                    <div class="table-content col-md-2">{{\date('Y-m-d', \strtotime($program->application_closing_date_time))}}<br>{{\date('H:i', \strtotime($program->application_closing_date_time))}}</div>
                    <div class="table-title col-md-1"><p>Duration</p></div>
                    <div class="table-content col-md-2">{{$program->hours}} Hours</div>
                </div>
                <div class="row">
                    <div class="table-title col-md-2"><p>Nature Of The Employment</p></div>
                    <div class="table-content col-md-4">{{$program->nature_of_the_employment}}</div>
                    <div class="table-title col-md-2"><p>Employee Category</p></div>
                    <div class="table-content col-md-4">{{$program->employee_category}}</div>
                </div>

                <div class="row">
                    <div class="table-title col-md-2"><p>Resource Person(s)</p></div>
                    <div class="table-content col-md-6">
                        @foreach($costs as $cost)
                            @if($cost['cost_name'] == 'resource person')
                                <span><p class="cost-title">Name:</p> {{$cost['cost_content'][0]}}</span>
                                <span><p class="cost-title">Designation:</p> {{$cost['cost_content'][1]}}</span>
                                <span><p class="cost-title">Cost(Rs):</p> {{$cost['cost_value']}}/=</span>
                                <br>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="table-title col-md-2"><p>Other Costs</p></div>
                    <div class="table-content col-md-4">
                        @foreach($costs as $cost)
                            @if($cost['cost_name'] == 'other cost')
                                <span><p class="cost-title">{{ucfirst($cost['cost_content'])}} = </p> {{$cost['cost_value']}}/=</span>
                                <br>
                            @endif
                        @endforeach
                    </div>
                    <div class="table-title col-md-2"><p>Program Brochure</p></div>
                    <div class="table-content col-md-4">
                    </div>
                </div>
                <div class="row">
                    <div class="table-title col-md-2"><p>No-Show Fee</p></div>
                    <div class="table-content col-md-2">{{$program->no_show_fee}}</div>
                    <div class="table-title col-md-2"><p>Per person fee</p></div>
                    <div class="table-content col-md-2">{{$program->per_person_fee}}</div>
                </div>
                <div class="row">
                    <div class="table-title col-md-2"><p>Created By</p></div>
                    <div class="table-content col-md-2">{{$program->created_by}}</div>
                    <div class="table-title col-md-2"><p>Created On</p></div>
                    <div class="table-content col-md-2">{{$program->created_at}}</div>
                </div>
            </div>
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