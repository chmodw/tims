@extends('home')

@section('content_header')
    <h1 class="inline">Edit Foreign Training Program</h1>
    <a href="{{url('/foreign')}}" class="btn btn-default pull-right">Back</a>
@stop

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
            <form method="POST" action="{{ route('foreign.update', $program[0]->program_id) }}" enctype="multipart/form-data">
                {{method_field('PATCH')}}
                @csrf
                <input type="hidden" value="LocalProgram" name="program_type">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                            <label for="program_title" class="required">Program Title</label>
                            <input type="text" class="form-control" value="{{old('program_title', $program[0]->program_title)}}" id="program_title" name="program_title" placeholder="Title">
                            @if ($errors->has('program_title'))
                                <span class="help-block">{{ $errors->first('program_title') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group has-feedback {{$errors->has('organised_by_id') ? 'has-error' : ''}}">
                            <label for="organised_by_id" class="required">Organised By</label>
                            <input type="text" value="{{old('organised_by_id', $program[0]->name)}}" class="form-control" name="organised_by_id" id="organised_by_id" placeholder="Program organiser" list="orgs">
                            <datalist id="orgs">
                                @foreach($orgs as $org)
                                    <option value="{{\ucwords($org->name)}}"></option>
                                @endforeach
                            </datalist>
                            @if ($errors->has('organised_by_id'))
                                <span class="help-block">{{ $errors->first('organised_by_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="from-group has-feedback {{$errors->has('notified_by') ? 'has-error' : ''}}">
                            <label for="notified_by" class="required">Notified By</label>
                            <input type="text" value="{{old('notified_by', $program[0]->notified_by)}}" name="notified_by" class="form-control {{ $errors->has('notified_by') ? 'has-error' : '' }}" id="notified_by" placeholder="Notified By">
                            @if ($errors->has('notified_by'))
                                <span class="help-block">{{ $errors->first('notified_by') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="from-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                            <label for="venue" class="">Venue</label>
                            <input type="text" value="{{old('venue', $program[0]->venue)}}" class="form-control {{ $errors->has('venue') ? 'has-error' : '' }}" id="venue" name="venue" placeholder="Venue">
                            @if ($errors->has('venue'))
                                <span class="help-block">{{ $errors->first('venue') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group has-feedback {{$errors->has('currency') ? 'has-error' : ''}}">
                            <label for="currency" class="">Currency</label>
                            <select type="text" value="{{old('currency', $program[0]->currency)}}" class="form-control {{ $errors->has('currency') ? 'has-error' : '' }}" id="currency" name="currency">
                                <option value="lkr">LKR</option>
                                <option value="gbp">GBP</option>
                                <option value="usd">USD</option>
                                <option value="euro">EURO</option>
                            </select>
                            @if ($errors->has('currency'))
                                <span class="help-block">{{ $errors->first('currency') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="from-group has-feedback {{$errors->has('program_fee') ? 'has-error' : ''}}">
                            <label for="program_fee" class="">Program Fee</label>
                            <input type="number" value="{{old('program_fee', $program[0]->program_fee)}}" class="form-control {{ $errors->has('program_fee') ? 'has-error' : '' }}" id="program_fee" name="program_fee" placeholder="program_fee">
                            @if ($errors->has('program_fee'))
                                <span class="help-block">{{ $errors->first('program_fee') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <div class="from-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                            <label for="target_group" class="required">Target Group</label>
                            <input type="text" value="{{old('target_group', $program[0]->target_group)}}" name="target_group" class="form-control {{ $errors->has('target_group') ? 'has-error' : '' }}" id="target_group" placeholder="Target Group">
                            @if ($errors->has('target_group'))
                                <span class="help-block">{{ $errors->first('target_group') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('employment_nature') ? 'has-error' : ''}}">
                            <div>
                                <label for="nature_of_the_employment" class="required margin-bottom-sm">Nature of the Employment</label>
                            </div>
                            <div class="inline margin-right-md">
                                <input type="checkbox" id="employment_permanent" name="employment_nature[]" class="styled-checkbox" value="Permanent" name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('Permanent', old('employment_nature')) or \strpos($program[0]->nature_of_the_employment, 'Permanent') !== false) ? ' checked' : '' }}>
                                <label for="employment_permanent">Permanent</label>
                            </div>
                            <div class="inline margin-right-md">
                                <input type="checkbox" id="employment_permanent_and_confirm" class="styled-checkbox" value="Permanent and Confirm" name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('Permanent and Confirm', old('employment_nature')) or \strpos($program[0]->nature_of_the_employment, 'Permanent and Confirm') !== false) ? ' checked' : '' }}>
                                <label for="employment_permanent_and_confirm">Permanent and Confirm</label>
                            </div>
                            @if ($errors->has('employment_nature'))
                                <span class="help-block">{{ $errors->first('employment_nature') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group has-feedback {{$errors->has('employee_category') ? 'has-error' : ''}}">
                            <div>
                                <label class="required margin-bottom-sm">Employee Category</label>
                            </div>
                            <div class="inline margin-right-md">
                                <input type="checkbox" id="employee_category_tech" class="styled-checkbox" value="Technical" name="employee_category[]" {{ (is_array(old('employee_category')) and in_array('Technical', old('employee_category'))  or \strpos($program[0]->employee_category, 'Technical') !== false) ? ' checked' : '' }}>
                                <label for="employee_category_tech" >Technical</label>
                            </div>
                            <div class="inline">
                                <input type="checkbox" id="employee_category_nontech" class="styled-checkbox" value="Non-Technical" name="employee_category[]" {{ (is_array(old('employee_category')) and in_array('Non-Technical', old('employee_category')) or \strpos($program[0]->employee_category, 'Non-Technical') !== false) ? ' checked' : '' }}>
                                <label for="employee_category_nontech" class="">Non-Technical</label>
                            </div>
                            @if ($errors->has('employee_category'))
                                <span class="help-block">{{ $errors->first('employee_category') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="from-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                            <label for="application_closing_date" class="required">Application Closing Date</label>
                            <input type="date" value="{{old('application_closing_date', date('Y-m-d',strtotime($program[0]->application_closing_date_time)))}}" class="form-control {{ $errors->has('application_closing_date') ? 'has-error' : '' }}" id="application_closing_date" name="application_closing_date" placeholder="">
                            @if ($errors->has('application_closing_date'))
                                <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="from-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                            <label for="application_closing_time" class="required">Closing Time</label>
                            <input type="time" value="{{old('application_closing_time', date('H:i',strtotime($program[0]->application_closing_date_time)))}}" class="form-control {{ $errors->has('application_closing_time') ? 'has-error' : '' }}" id="application_closing_time" name="application_closing_time" placeholder="">
                            @if ($errors->has('application_closing_time'))
                                <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="from-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                            <label for="start_date" class="required">Start Date</label>
                            <input type="date" value="{{old('start_date', date('Y-m-d', strtotime($program[0]->start_date)))}}" class="form-control {{ $errors->has('start_date') ? 'has-error' : '' }}" id="start_date" name="start_date">
                            @if ($errors->has('start_date'))
                                <span class="help-block">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="from-group has-feedback {{$errors->has('end_date') ? 'has-error' : ''}}">
                            <label for="end_date" class="required">End Date</label>
                            <input type="date" value="{{old('end_date', $program[0]->end_date)}}" class="form-control {{ $errors->has('end_date') ? 'has-error' : '' }}" id="end_date" name="end_date">
                            @if ($errors->has('end_date'))
                                <span class="help-block">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group has-feedback {{$errors->has('duration') ? 'has-error' : ''}}">
                            <label for="duration" class="required inline">Duration</label>
                            <input type="number" value="{{old('duration', $program[0]->duration)}}" class="form-control inline" id="duration" placeholder="Number of Days" id="duration" name="duration">
                            <small id="durationHelpBlock" class="form-text text-muted">
                                Days
                            </small>
                            @if ($errors->has('duration'))
                                <span class="help-block">{{ $errors->first('duration') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
                        <label for="program_brochure">Program Brochure</label>
                        <input type="file" class="form-control-file" name="program_brochure" id="program_brochure" name="program_brochure">
                        @if ($errors->has('program_brochure'))
                            <span class="help-block">{{ $errors->first('program_brochure') }}</span>
                        @endif
                        <small id="programBrochureHelpBlock" class="form-text text-muted">
                            Only JPEG are allowed. Max size 1999KB.
                        </small>
                    </div>
                </div>

                <div class="col-md-12">
                    <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                    <button type="submit" name="_submit" class="btn btn-primary mb-2 pull-right" style="margin-right: 15px;" value="redirect">Save &amp; Go Back</button>
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