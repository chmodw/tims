@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('foreign.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" onclick="return confirm('Are you sure?')" style="margin-right:8px; margin-top: 14px;"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('program/ForeignProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{route('foreign.edit', $program->program_id)}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{route('foreign.create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
            <a href="{{route('foreign.index')}}" class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            <div class="col-md-9">
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
                            <th colspan="1">Target Group</th>
                            <td colspan="3">{{$program->target_group}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Organised By</th>
                            <td colspan="3">{{$program->organisation->name}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Venue</th>
                            <td colspan="3">{{$program->venue}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Start Date</th>
                            <td colspan="1">{{\date('Y-m-d',strtotime($program->start_date))}}</td>
                            <th colspan="1">Duration</th>
                            <td colspan="1">{{$program->duration}} {{$program->is_long_term == 1 ? ' months' : ' days'}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Application Closing Date</th>
                            <td colspan="1">{{\date('Y-m-d',strtotime($program->application_closing_date_time))}}</td>
                            <th colspan="1">Time</th>
                            <td colspan="1">{{\date('H:i',strtotime($program->application_closing_date_time))}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Nature of the Employment</th>
                            <td colspan="1">{{$program->nature_of_the_employment}}</td>
                            <th colspan="1">Employee Category</th>
                            <td colspan="1">{{$program->employee_category}}</td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <th colspan="1">Program Fee</th>
                            <td colspan="1">{{$program->program_fee}}</td>
                            <th colspan="1">Other Fees</th>
                            <td colspan="1">
                                @foreach($program->costs as $cost)
                                    {{$cost->cost_content.' = '.$cost->cost_value}}
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th colspan="1">Program Brochure</th>
                            <td colspan="3">{{$program->brochure_url}}</td>
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

            <div class="col-lg-3">

                <div class="program-brochure">
                    <a href="/storage/brochures/{{$program->brochure_url}}" target="_blank"><img src="/storage/brochures/{{$program->brochure_url}}" class="img-thumbnail" alt="program brochure"></a>
                </div>

                @include('programs.partials.programStatusBar')
            </div>
            {{--Status Bar--}}


            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Documents
                    </div>
                    <div class="panel-body">
                        @include('programs.partials.docselect', ['program_type' => 'ForeignProgram'])
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

    </script>
@endsection