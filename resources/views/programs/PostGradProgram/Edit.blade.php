@extends('home')

@section('title', 'TIMS | Create Post Graduation Program')

@section('main-content')

    <style>
        label.required::after{
            content:"*";
            color:red;
            margin-left: 3px;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">New Post Graduation Program</p>
            <a href="{{route('postgrad.index')}}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            @include('layouts._alert')
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="{{ route('postgrad.update', $program->program_id) }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <input type="hidden" value="PostGradProgram" name="program_type">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                                <label for="program_title" class="required">Program Title</label>
                                <input type="text" class="form-control" value="{{old('program_title', $program->program_title)}}" id="program_title" name="program_title" placeholder="Title">
                                @if ($errors->has('program_title'))
                                    <span class="help-block">{{ $errors->first('program_title') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('organised_by_id') ? 'has-error' : ''}}">
                                <label for="organised_by_id" class="required">Institute</label>
                                <input type="text" value="{{old('organised_by_id', $program->name)}}" class="form-control" name="organised_by_id" id="organised_by_id" placeholder="Institute">
                                <datalist id="orgs">
                                    @foreach($orgs as $org)
                                        <option value="{{$org->name}}"></option>
                                    @endforeach
                                </datalist>
                                @if ($errors->has('organised_by_id'))
                                    <span class="help-block">{{ $errors->first('organised_by_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('department') ? 'has-error' : ''}}">
                                <label for="department" class="required">Department</label>
                                <input type="text" value="{{old('department', $program->department)}}" name="department" class="form-control" id="department" placeholder="Department">
                                @if ($errors->has('department'))
                                    <span class="help-block">{{ $errors->first('department') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="">
                            <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                                <label for="target_group" class="required">Target Group</label>
                                <input type="text" value="{{old('target_group', $program->target_group)}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group">
                                @if ($errors->has('target_group'))
                                    <span class="help-block">{{ $errors->first('target_group') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('requirements') ? 'has-error' : ''}}">
                                <label for="requirements" class="required">Eligibility</label>
                                <textarea class="form-control" style="height: 100px; min-height: 100px; max-height: 200px; max-width: 100%;min-width: 100%" name="requirements" id="requirements" placeholder="Eligibility,&#13;&#10;Eligibility">@if(old('requirements')==null)@foreach($program->requirements as $req){{$req.","}}&#13;&#10;@endforeach @else {{old('requirements')}}@endif</textarea>
                                <small id="" class="form-text text-muted">
                                    Separate by a Comma
                                </small>
                                @if ($errors->has('requirements'))
                                    <span class="help-block">{{ $errors->first('requirements') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                                <label for="application_closing_date" class="required">Application Closing Date</label>
                                <input type="date" value="{{old('application_closing_date', \date('Y-m-d', strtotime($program->application_closing_date_time)))}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="">
                                @if ($errors->has('application_closing_date'))
                                    <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                                <label for="application_closing_time" class="required">Closing Time</label>
                                <input type="time" value="{{old('application_closing_time', \date('H:i', strtotime($program->application_closing_date_time)))}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="">
                                @if ($errors->has('application_closing_time'))
                                    <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                                <label for="start_date" class="required">Start Date</label>
                                <input type="date" value="{{old('start_date', \date('Y-m-d', strtotime($program->start_date)))}}" class="form-control" id="start_date" name="start_date">
                                @if ($errors->has('start_date'))
                                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-feedback {{$errors->has('duration') ? 'has-error' : ''}}">
                                <label for="duration" class="required inline">Duration</label>
                                <input type="number" value="{{old('duration', $program->duration)}}" class="form-control inline" id="duration" placeholder="Number of Months" id="duration" name="duration">
                                <small id="durationHelpBlock" class="form-text text-muted">
                                    Months
                                </small>
                                @if ($errors->has('duration'))
                                    <span class="help-block">{{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('registration_fees') ? 'has-error' : ''}}">
                                <label for="registration_fees" class="required">Registration Fees (Rs)</label>
                                <input type="number" value="{{old('registration_fees', $program->registration_fees)}}" class="form-control" id="registration_fees" name="registration_fees" placeholder="Registration Fees">
                                @if ($errors->has('registration_fees'))
                                    <span class="help-block">{{ $errors->first('registration_fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('installments') ? 'has-error' : ''}}">
                                <label for="installments" class="required">Installments</label>
                                <textarea class="form-control" style="height: 75px; min-height: 75px; max-height: 75px; max-width: 498.5px" name="installments" id="installments" placeholder="1 = Cost,&#13;&#10;2 = Cost,">@if(old('installments') == null)@foreach($costs as $cost)@if($cost['cost_name'] == 'installment'){{$cost['cost_content']}} = {{$cost['cost_value']}},&#13;&#10;@endif @endforeach @else{{old('installments')}}@endif</textarea>
                                <small id="" class="form-text text-muted">
                                    Separate by a Enter
                                </small>
                                @if ($errors->has('installments'))
                                    <span class="help-block">{{ $errors->first('installments') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
                                <label for="program_brochure">Program Brochure</label>
                                <input type="file" class="form-control-file"  id="program_brochure" name="program_brochure" class="form-control" name="program_brochure">
                                @if ($errors->has('program_brochure'))
                                    <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_brochure') }}</span>
                                @endif
                                <small id="program_brochureHelpBlock" class="form-text text-muted">
                                    Only DOC,PDF,DOCX,JPG,JPEG and PNG are allowed. Max size 4999KB.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                            <button type="reset" name="reset" class="btn btn-default mb-2 mr-2 pull-right" value="" style="margin-right: 15px;">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {

            $(function() {
                $('#is_long_term').click(function() {
                    if ($("#is_long_term").prop('checked') == true) {
                        $('#durationHelpBlock').text('Months');
                        $('#duration').attr("placeholder", "Number of Months");
                    } else if ($("#is_long_term").prop('checked') == false) {
                        $('#durationHelpBlock').text('Days');
                        $('#duration').attr("placeholder", "Number of Days");
                    }
                });
            });

            $(function(){
                $("input").focus(function() {
                    if($(this).parent().hasClass('has-error') || $(this).parent().parent().hasClass('has-error')){
                        $(this).parent().removeClass('has-error');
                        $(this).parent().parent().removeClass('has-error');
                        $(this).parent().find('span.help-block').detach();
                        $(this).parent().parent().find('span.help-block').detach();
                    }
                });
            });
        }
    </script>
@stop