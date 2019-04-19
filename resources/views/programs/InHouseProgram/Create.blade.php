@extends('home')

@section('content_header')
    <h1 class="inline">New In House Program</h1>
    <a href="{{url('programs/InHousePrograms')}}" class="btn btn-default pull-right">Back</a>
@stop

@section('title', 'TIMS | Create In-House Program')

@section('main-content')

    <style>
        label.required::after{
            content:"*";
            color:red;
            margin-left: 3px;
        }
    </style>

    <div class="panel panel-default">
        @include('layouts._alert')
        <div class="panel-body">
            <form method="POST" action="{{ route('programs.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="LocalProgram" name="program_type">
















                <div class="col-md-12">
                    <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                        <label for="program_title" class="required">Program Title</label>
                        <input type="text" class="form-control" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title">
                        @if ($errors->has('program_title'))
                            <span class="help-block">{{ $errors->first('program_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                            <label for="target_group" class="required">Target Group</label>
                            <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group">
                            @if ($errors->has('target_group'))
                                <span class="help-block">{{ $errors->first('target_group') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{$errors->has('employment_nature') ? 'has-error' : ''}}">
                            <label for="nature_of_the_employment" class="required">Employment</label>
                            <div>
                                <input type="checkbox" id="employment_permanent" value="permanent" name="employment_nature[]">
                                <label for="employment_permanent">Permanent</label>
                            </div>
                            <div>
                                <input type="checkbox" id="employment_fixed_contract" value="fixed contract" name="employment_nature[]">
                                <label for="employment_fixed_contract">Fixed Contract</label>
                            </div>
                            <div>
                                <input type="checkbox" id="employment_job_contract" value="job contract" name="employment_nature[]">
                                <label for="employment_job_contract">Job Contract</label>
                            </div>
                            @if ($errors->has('employment_nature'))
                                <span class="help-block">{{ $errors->first('employment_nature') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-feedback {{$errors->has('employee_category') ? 'has-error' : ''}}">
                            <label for="employee_category" class="required">Employee Category</label>
                            <div>
                                <input type="checkbox" id="employee_category_tech" value="technical" name="employee_category[]">
                                <label for="employee_category_tech">Technical</label>
                            </div>
                            <div>
                                <input type="checkbox" id="employee_category_nontech" value="non-technical" name="employee_category[]">
                                <label for="employee_category_nontech">Non-Technical</label>
                            </div>
                            @if ($errors->has('employee_category'))
                                <span class="help-block">{{ $errors->first('employee_category') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="form-group has-feedback {{$errors->has('content') ? 'has-error' : ''}}">
                            <label for="content" class="required">Program Content</label>
                            <textarea class="form-control" style="height: 175px; min-height: 175px; max-height: 175px; max-width: 468px" name="content" id="content" placeholder="Program Content">{{old('content')}}</textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">{{ $errors->first('content') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('organised_by') ? 'has-error' : ''}}">
                            <label for="organised_by" class="required">Organised By</label>
                            <input type="text" value="{{old('organised_by')}}" class="form-control" name="organised_by_id" id="organised_by" placeholder="Program organiser" list="orgs">
                            <datalist id="orgs">
                                @foreach($orgs as $org)
                                    <option value="{{$org->organisation_id}}">{{$org->name}}</option>
                                @endforeach
                            </datalist>
                            @if ($errors->has('organised_by'))
                                <span class="help-block">{{ $errors->first('organised_by') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                            <label for="venue" class="required">Venue</label>
                            <input type="text" value="{{old('venue')}}" class="form-control" id="venue" name="venue">
                            @if ($errors->has('venue'))
                                <span class="help-block">{{ $errors->first('venue') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                            <label for="start_date" class="required">Start Date</label>
                            <input type="date" value="{{old('start_date')}}" class="form-control" id="start_date" name="start_date">
                            @if ($errors->has('start_date'))
                                <span class="help-block">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-feedback {{$errors->has('start_time') ? 'has-error' : ''}}">
                            <label for="start_time">Start Time</label>
                            <input type="time" value="{{old('start_time')}}" class="form-control" id="start_time" name="start_time">
                            @if ($errors->has('start_time'))
                                <span class="help-block">{{ $errors->first('start_time') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-feedback {{$errors->has('end_time') ? 'has-error' : ''}}">
                            <label for="end_time">End Time</label>
                            <input type="time" value="{{old('end_time')}}" class="form-control" id="end_time" name="end_time">
                            @if ($errors->has('end_time'))
                                <span class="help-block">{{ $errors->first('end_time') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                            <label for="application_closing_date" class="required">Application Closing Date</label>
                            <input type="date" value="{{old('application_closing_date')}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="">
                            @if ($errors->has('application_closing_date'))
                                <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                            <label for="application_closing_time" class="required">Closing Time</label>
                            <input type="time" value="{{old('application_closing_time')}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="">
                            @if ($errors->has('application_closing_time'))
                                <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group has-feedback {{$errors->has('key_person') ? 'has-error' : ''}}">
                            <label for="key_person" class="required">Key Person</label>
                            <input type="text" class="form-control" value="{{old('key_person')}}" id="key_person" name="key_person" placeholder="Title">
                            @if ($errors->has('key_person'))
                                <span class="help-block">{{ $errors->first('key_person') }}</span>
                            @endif
                        </div>
                    </div><div class="col-md-7">
                        <div class="form-group has-feedback {{$errors->has('key_person_designation') ? 'has-error' : ''}}">
                            <label for="key_person_designation" class="required">Key Person Designation</label>
                            <input type="text" class="form-control" value="{{old('key_person_designation')}}" id="key_person_designation" name="key_person_designation" placeholder="Title">
                            @if ($errors->has('key_person_designation'))
                                <span class="help-block">{{ $errors->first('key_person_designation') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('registration_cost') ? 'has-error' : ''}}">
                            <label for="registration_cost">Registration Cost</label>
                            <input type="number" value="{{old('registration_cost')}}" class="form-control" id="registration_cost" name="registration_cost">
                            @if ($errors->has('registration_cost'))
                                <span class="help-block">{{ $errors->first('registration_cost') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('non_registration_cost') ? 'has-error' : ''}}">
                            <label for="non_registration_cost">Non-Registration Cost</label>
                            <input type="number" value="{{old('non_registration_cost')}}" class="form-control" id="non_registration_cost" name="registration_cost">
                            @if ($errors->has('non_registration_cost'))
                                <span class="help-block">{{ $errors->first('non_registration_cost') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('non_registration_cost') ? 'has-error' : ''}}">
                            <label for="head_cost">Head Cost</label>
                            <input type="number" value="{{old('head_cost')}}" class="form-control" id="head_cost" name="head_cost">
                            @if ($errors->has('head_cost'))
                                <span class="help-block">{{ $errors->first('head_cost') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('lecturer_cost') ? 'has-error' : ''}}">
                            <label for="lecturer_cost">lecturer_cost</label>
                            <input type="number" value="{{old('Lecturer Cost')}}" class="form-control" id="lecturer_cost" name="lecturer_cost">
                            @if ($errors->has('lecturer_cost'))
                                <span class="help-block">{{ $errors->first('lecturer_cost') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('hours') ? 'has-error' : ''}}">
                            <label for="hours">Lecture hours</label>
                            <input type="number" value="{{old('hours')}}" class="form-control" id="hours" name="hours">
                            @if ($errors->has('hours'))
                                <span class="help-block">{{ $errors->first('hours') }}</span>
                            @endif
                        </div>
                    </div>
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
                    <div class="col-md-12">
                        <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                        {{--                    <button type="submit" name="_submit" class="btn btn-primary mb-2 pull-right" style="margin-right: 15px;" value="redirect">Save &amp; Go Back</button>--}}
                        <button type="reset" name="reset" class="btn btn-default mb-2 mr-2 pull-right" value="" style="margin-right: 15px;">Clear</button>
                    </div>
                </div>
            </form>
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