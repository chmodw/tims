@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="btn-container">
                <form method="POST" action="{{ route('local.destroy', $program->program_id) }}">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button  class="btn btn-danger pull-right" style="margin-right:8px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
                </form>
                <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('program/LocalProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
                <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{route('local.edit', $program->program_id)}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
                <a class="btn btn-primary pull-right" style="margin-right:8px;" href="{{route('local.create')}}"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
                <a href="{{route('local.index')}}" class="btn btn-default pull-right margin-right-sm"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
            </div>
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
                            <th colspan="1">Nature of the Employment</th>
                            <td colspan="3">{{$program->nature_of_the_employment}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Employee Category</th>
                            <td colspan="3">{{$program->employee_category}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Application Closing Date</th>
                            <td colspan="1">{{\date('Y-m-d', \strtotime($program->application_closing_date_time))}}</td>
                            <th colspan="1">Time</th>
                            <td colspan="1">{{\date('H:i', \strtotime($program->application_closing_date_time))}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Start Date</th>
                            <td colspan="1">{{\date('Y-m-d', \strtotime($program->start_date))}}</td>
                            <th colspan="1">Duration</th>
                            <td colspan="1">{{$program->duration}} {{$program->duration_by}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Program Fee (Rs)</th>
                            <td colspan="1">{{$program->program_fee}}</td>
                            <th colspan="1">Member Fee (Rs)</th>
                            <td colspan="1">{{$program->member_fee}}</td>
                        </tr>
                        <tr>
                            <th colspan="1">Non Member Fee (Rs)</th>
                            <td colspan="1">{{$program->non_member_fee}}</td>
                            <th colspan="1">Student Fee (Rs)</th>
                            <td colspan="1">{{$program->student_fee}}</td>
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
            {{--Status Bar--}}
            @include('programs.partials.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <p>Documents</p>
                    </div>
                    <div class="panel-body">
                        @include('programs.partials.docselect', ['program_type' => 'LocalProgram'])
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading clearfix">
                        <p>Payments</p>
                    </div>
                    <div class="panel-body">

                        <table class="table table-bordered">
                            <colgroup>
                                <col class="bg-gray-light">
                                <col span="2" class="">
                                <col span="2" class="bg-gray-light">
                                <col span="2" class="">
                                <col class="bg-gray-light">
                                <col span="2" class="bg-success">
                            </colgroup>
                            <thead>
                                <th>Section/Unit</th>

                                <th>Member Count</th>
                                <th>Total Member Fee (Rs)</th>

                                <th>Non-Member Count</th>
                                <th>Non-member Fee (Rs)</th>

                                <th>Student Count</th>
                                <th>Total Student Fee (Rs)</th>

                                <th>Program Fee (Rs)</th>

                                <th>Employee Count</th>
                                <th>Total Payment<th>
                            </thead>
                            <tbody>
                                @foreach($payments as $key => $payment)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$payment['member_count']}}</td>
                                        <td>Rs. {{$payment['member_total_cost']}}/=</td>
                                        <td>{{$payment['nonmember_count']}}</td>
                                        <td>Rs. {{$payment['nonmember_total_cost']}}/=</td>
                                        <td>{{$payment['student_count']}}</td>
                                        <td>Rs. {{$payment['student_total_cost']}}/=</td>
                                        <td>Rs. {{$payment['program_fee']}}/=</td>
                                        <td>{{$payment['total_count']}}</td>
                                        <td>Rs. {{$payment['total_cost']}}/=</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" href="{{route('payment.create',
                                            ['program'=> serialize([
                                                'program_id' => $program->program_id,
                                                'program_type' => 'LocalProgram',
                                                'program_fee' => $program->program_fee,
                                                'member_fee' => $program->member_fee,
                                                'non_member_fee' => $program->non_member_fee,
                                                'student_fee' => $program->student_fee
                                            ]),
                                            'payments'=> serialize(['section' => $key,'data' => $payment])])}}">Pay</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>

    </script>
@endsection