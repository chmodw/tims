@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <form method="POST" action="{{ route('postgrad.destroy', $program->program_id) }}">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button  class="btn btn-danger pull-right" style="margin-right:8px;" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbsp;Delete</button>
            </form>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('trainee/index/PostGradProgram/'.$program->program_id)}}"><i class="glyphicon glyphicon-user margin-right-sm"></i>Employees</a>
            <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{url('/postgrad/'.$program->program_id.'/edit')}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            <a class="btn btn-primary pull-right" style="margin-right:8px;" href="/postgrad/create"><i class="glyphicon glyphicon-plus margin-right-sm"></i>&nbsp;New</a>
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
                    <th colspan="3"><p>Institute</p></th>
                    <td colspan="7">{{$program->name}}</td>
                    <th colspan="3"><p>Department</p></th>
                    <td colspan="7">{{$program->department}}</td>
                </tr>
                <tr>
                    <th colspan="3">Target Group</th>
                    <td colspan="17">{{$program->target_group}}</td>
                </tr>
                <tr>
                    <th colspan="2">Start Date</th>
                    <td colspan="2">{{\date('Y-m-d',strtotime($program->start_date))}}</td>
                    <th colspan="2">Duration</th>
                    <td colspan="3">{{$program->duration}}{{$program->is_long_term == 1 ? ' months' : ' days'}}</td>
                    <th colspan="4">Application Closing Date</th>
                    <td colspan="2">{{\date('Y-m-d',strtotime($program->application_closing_date_time))}}</td>
                    <th colspan="2">Time</th>
                    <td colspan="3">{{\date('H:i',strtotime($program->application_closing_date_time))}}</td>
                </tr>
                <tr>
                    <th colspan="2"><p>Eligibility</p></th>
                    <td colspan="18">
                        @foreach($program['requirements'] as $requirement)
                            <p>{{$requirement}},</p>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th colspan="3"><p>Installments</p></th>
                    <td colspan="6">
                        @foreach($costs as $cost)
                            @if($cost['cost_name'] == 'installment')
                                <span><p class="cost-title">Installment</p> {{$cost['cost_content']}}</span>
                                <span><p class="cost-title">Fee:</p> {{$cost['cost_value']}}/=</span>
                                <br>
                            @endif
                        @endforeach
                    </td>
                    <th colspan="3"><p>Registration Fee</p></th>
                    <td colspan="8">{{$program->registration_fees}}</td>
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
            <form class="form-inline" method="POST" action="{{route('doc.generate')}}">
                {{ csrf_field() }}
                <input type="hidden" name="program_id"  value="{{$program->program_id}}">
                <input type="hidden" name="program_type"  value="PostGradProgram">
                <div class="col-md-2">
                    <label for="doc_option" class="v-middle" style="margin-top: 4px;">Select Document Type :</label>
                </div>
                <div class="col-md-6">
                    <select name="doc_type" id="doc_option" class="form-control" style="width: 100%;">
                        <option value="committee_approval">Committee Approval</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <textarea name="summernote" id="summernote"></textarea>
                </div>
                <div class="col-md-4">
                    <input type="submit" name="submit" value="Customize and Generate" class="btn btn-default margin-right-sm">
                    <input type="submit" name="submit" value="Generate" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {
            $(document).ready(function() {
                $('#summernote').summernote();
            });
        }
    </script>

@endsection