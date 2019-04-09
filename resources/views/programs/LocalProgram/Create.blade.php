@extends('home')


@section('main-content')

<div class="panel panel-default">
    <div class="panel-heading">
        New Local Program
    </div>
    <div class="panel-body">
        <form method="POST" action="{{ route('programs.create') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="LocalProgram" name="program_type">
            <div class="col-md-12">
                <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                    <label for="program_title">Program Title</label>
                    <input type="text" class="form-control" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title">
                    @if ($errors->has('program_title'))
                        <span class="help-block">{{ $errors->first('program_title') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback {{$errors->has('organised_by') ? 'has-error' : ''}}">
                    <label for="organised_by">Organised By</label>
                    <input type="text" value="{{old('organised_by')}}" class="form-control" name="organised_by" id="organised_by" placeholder="Program organiser">
                    @if ($errors->has('organised_by'))
                        <span class="help-block">{{ $errors->first('organised_by') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                    <label for="target_group">Target Group</label>
                    <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group">
                    @if ($errors->has('target_group'))
                        <span class="help-block">{{ $errors->first('target_group') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                    <label for="start_date">Start Date</label>
                    <input type="date" value="{{old('start_date')}}" class="form-control" id="start_date" name="start_date">
                    @if ($errors->has('start_date'))
                        <span class="help-block">{{ $errors->first('start_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('start_time') ? 'has-error' : ''}}">
                    <label for="start_time">Start Time</label>
                    <input type="time" value="{{old('start_time')}}" class="form-control" id="start_time" name="start_time">
                    @if ($errors->has('start_time'))
                        <span class="help-block">{{ $errors->first('start_time') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('end_date') ? 'has-error' : ''}}">
                    <label for="end_date">End Date</label>
                    <input type="date" value="{{old('end_date')}}" class="form-control" id="end_date" name="end_date">
                    @if ($errors->has('end_date'))
                        <span class="help-block">{{ $errors->first('end_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('end_time') ? 'has-error' : ''}}">
                    <label for="end_time">End Time</label>
                    <input type="time" value="{{old('end_time')}}" class="form-control" id="end_time" name="end_time">
                    @if ($errors->has('end_time'))
                        <span class="help-block">{{ $errors->first('end_time') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                    <label for="venue">Venue</label>
                    <input type="text" value="{{old('venue')}}" class="form-control" id="venue" name="venue">
                    @if ($errors->has('venue'))
                        <span class="help-block">{{ $errors->first('venue') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('nature_of_the_appointment') ? 'has-error' : ''}}">
                    <label for="nature_of_the_appointment">Nature of The Appointment</label>
                    <select class="form-control" id="nature_of_the_appointment" name="nature_of_the_appointment">
                        <option value="permanent">Permanent</option>
                        <option value="fixed">Fixed</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('employee_category') ? 'has-error' : ''}}">
                    <label for="employee_category">Employee Category</label>
                    <select class="form-control" id="employee_category" name="employee_category">
                        <option value="non-technical">Technical</option>
                        <option value="technical">Non-Technical</option>
                        <option value="both">Both</option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 padding-right-xl padding-left-xl">
                <div class="well">
                    <div class="row">
                        <p class="text-muted col-md-12">Long Term</p>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('course_fee') ? 'has-error' : ''}}">
                                <label for="course_fee">Course Fee</label>
                                <input type="number" value="{{old('course_fee')}}" class="form-control" id="course_fee" name="course_fee">
                                @if ($errors->has('course_fee'))
                                    <span class="help-block">{{ $errors->first('course_fee') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('duration') ? 'has-error' : ''}}">
                                <label for="duration">Duration</label>
                                <input type="number" value="{{old('duration')}}" class="form-control" id="duration" name="duration">
                                <small id="durationHelpBlock" class="form-text text-muted">
                                    Months
                                </small>
                                @if ($errors->has('duration'))
                                    <span class="help-block">{{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                    <label for="application_closing_date">Application Closing Date</label>
                    <input type="date" value="{{old('application_closing_date')}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="">
                    @if ($errors->has('application_closing_date'))
                        <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                    <label for="application_closing_time">Application Closing Time</label>
                    <input type="time" value="{{old('application_closing_time')}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="">
                    @if ($errors->has('application_closing_time'))
                        <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback {{$errors->has('non_member_fee') ? 'has-error' : ''}}">
                    <label for="non_member_fee">Non Member Fee (Rs)</label>
                    <input type="number" value="{{old('non_member_fee')}}" class="form-control" id="non_member_fee" name="non_member_fee" placeholder="Non-Member Fee">
                    @if ($errors->has('non_member_fee'))
                        <span class="help-block">{{ $errors->first('non_member_fee') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{$errors->has('member_fee') ? 'has-error' : ''}}">
                    <label for="member_fee">Member Fee (Rs)</label>
                    <input type="number" value="{{old('member_fee')}}" class="form-control" id="member_fee" name="member_fee" placeholder="Member Fee">
                    @if ($errors->has('member_fee'))
                        <span class="help-block">{{ $errors->first('member_fee') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group has-feedback {{$errors->has('student_fee') ? 'has-error' : ''}}">
                    <label for="student_fee">Student Fee (Rs)</label>
                    <input type="number" value="{{old('student_fee')}}" class="form-control" id="student_fee" name="student_fee" placeholder="Student Fee">
                    @if ($errors->has('student_fee'))
                        <span class="help-block">{{ $errors->first('student_fee') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
                    <label for="program_brochure">Program Brochure</label>
                    <input type="file" class="form-control-file"  id="program_brochure" name="program_brochure" class="form-control" name="program_brochure">
                    @if ($errors->has('program_brochure'))
                        <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_brochure') }}</span>
                    @endif
                    <small id="program_brochureHelpBlock" class="form-text text-muted">
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

@endsection