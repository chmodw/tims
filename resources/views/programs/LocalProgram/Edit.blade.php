@extends('home')

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
            <p class="" style="">Edit Local Program</p>
            <a href="{{route('local.show', $program->program_id)}}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            @include('layouts._alert')
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="{{ route('local.update', $program->program_id) }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <input type="hidden" value="LocalProgram" name="program_type">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                                <label for="program_title" class="required">Program Title</label>
                                <input type="text" class="form-control" value="{{old('program_title', $program->program_title)}}" id="program_title" name="program_title" placeholder="Title" required>
                                @if ($errors->has('program_title'))
                                    <span class="help-block">{{ $errors->first('program_title') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('organised_by') ? 'has-error' : ''}}">
                                <label for="organised_by" class="required">Organised By</label>
                                <input type="text" value="{{old('organised_by', $program->organisation->name)}}" class="form-control" name="organised_by_id" id="organised_by" placeholder="Program organiser" list="orgs" required>
                                <datalist id="orgs">
                                    @foreach($orgs as $org)
                                        <option value="{{$org->name}}"></option>
                                    @endforeach
                                </datalist>
                                @if ($errors->has('organised_by'))
                                    <span class="help-block">{{ $errors->first('organised_by') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                                <label for="target_group" class="required">Target Group</label>
                                <input type="text" value="{{old('target_group', $program->target_group)}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group" required>
                                @if ($errors->has('target_group'))
                                    <span class="help-block">{{ $errors->first('target_group') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                                <label for="venue" class="required">Venue</label>
                                <input type="text" value="{{old('venue', $program->venue)}}" class="form-control" id="venue" name="venue" required>
                                @if ($errors->has('venue'))
                                    <span class="help-block">{{ $errors->first('venue') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                                <label for="start_date" class="required">Start Date</label>
                                <input type="date" value="{{old('start_date', \date('Y-m-d', strtotime($program->start_date)))}}" class="form-control" id="start_date" name="start_date"  required>
                                @if ($errors->has('start_date'))
                                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('start_time') ? 'has-error' : ''}}">
                                <label for="start_time">Start Time</label>
                                <input type="time" value="{{old('start_time', \date('H:i', strtotime($program->start_date)))}}" class="form-control" id="start_time" name="start_time"  required>
                                @if ($errors->has('start_time'))
                                    <span class="help-block">{{ $errors->first('start_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('duration') ? 'has-error' : ''}}">
                                <label for="duration" class="required inline">Duration</label>
                                <input type="number" value="{{old('duration', $program->duration)}}" class="form-control" id="duration" placeholder="Duration" id="duration" name="duration" required>
                                @if ($errors->has('duration'))
                                    <span class="help-block">{{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 {{$errors->has('duration_by') ? 'has-error' : ''}}" style="margin-top:25px;">
                            <div class="form-group has-feedback">
                                <label class="radio-inline">
                                    <input type="radio" name="duration_by" value="months" {{(old('duration_by') == 'months') || $program->duration_by =='months' ? 'checked' : ''}}>Months
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="duration_by" value="days" {{(old('duration_by') == 'days') || $program->duration_by =='days' ? 'checked' : ''}}>Days
                                </label>
                            </div>
                            @if ($errors->has('duration_by'))
                                <span class="help-block">{{ $errors->first('duration') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        @include('programs.partials.employeementselectsedit')
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                                <label for="application_closing_date" class="required">Application Closing Date</label>
                                <input type="date" value="{{old('application_closing_date', date('Y-m-d',strtotime($program->application_closing_date_time)))}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="" required>
                                @if ($errors->has('application_closing_date'))
                                    <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                                <label for="application_closing_time" class="required">Closing Time</label>
                                <input type="time" value="{{old('application_closing_time', date('H:i',strtotime($program->application_closing_date_time)))}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="" required>
                                @if ($errors->has('application_closing_time'))
                                    <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('program_fee') ? 'has-error' : ''}}">
                                <label for="program_fee">Program Fee (Rs)</label>
                                <input type="number" value="{{old('program_fee', $program->program_fee)}}" class="form-control" placeholder="program fee" id="program_fee" name="program_fee">
                                <small id="" class="form-text text-muted">
                                    If the Program has a program fee
                                </small>
                                @if ($errors->has('program_fee'))
                                    <span class="help-block">{{ $errors->first('program_fee') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('member_fee') ? 'has-error' : ''}}">
                                <label for="member_fee">Member Fee (Rs)</label>
                                <input type="number" value="{{old('member_fee', $program->member_fee)}}" class="form-control" id="member_fee" name="member_fee" placeholder="Member Fee">
                                @if ($errors->has('member_fee'))
                                    <span class="help-block">{{ $errors->first('member_fee') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('non_member_fee') ? 'has-error' : ''}}">
                                <label for="non_member_fee">Non Member Fee (Rs)</label>
                                <input type="number" value="{{old('non_member_fee', $program->non_member_fee)}}" class="form-control" id="non_member_fee" name="non_member_fee" placeholder="Non-Member Fee">
                                @if ($errors->has('non_member_fee'))
                                    <span class="help-block">{{ $errors->first('non_member_fee') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('student_fee') ? 'has-error' : ''}}">
                                <label for="student_fee">Student Fee (Rs)</label>
                                <input type="number" value="{{old('student_fee', $program->student_fee)}}" class="form-control" id="student_fee" name="student_fee" placeholder="Student Fee">
                                @if ($errors->has('student_fee'))
                                    <span class="help-block">{{ $errors->first('student_fee') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Current Program Brochure</label>
                            <img src="/storage/brochures/{{$program->brochure_url}}" class="img-thumbnail" alt="program brochure">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
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
                    </div>
                    <div class="col-md-12">
                        <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                        <button type="reset" name="reset" class="btn btn-default mb-2 mr-2 pull-right" value="" style="margin-right: 15px;">Clear</button>
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