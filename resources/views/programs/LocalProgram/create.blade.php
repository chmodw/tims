@extends('lap::layouts.auth')

@section('title', 'New Local Programs')
@section('child-content')
    <form method="POST" action="{{ route('programs.create') }}" novalidate data-ajax-form enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="LocalProgram" name="program_type">

        <div class="container">
            <div class="row">
                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="program_title">Program Title</label>
                        <input type="text" class="form-control {{ $errors->has('program_title') ? 'is-invalid' : '' }}" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title">
                        @if ($errors->has('program_title'))
                            <span class="invalid-feedback">{{ $errors->first('program_title') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="organised_by">Organised By</label>
                        <input type="text" value="{{old('organised_by')}}" class="form-control  {{ $errors->has('organised_by') ? 'is-invalid' : '' }}" name="organised_by" id="organised_by" placeholder="Program organiser">
                        @if ($errors->has('organised_by'))
                            <span class="invalid-feedback">{{ $errors->first('organised_by') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-8">
                    <div class="form-group">
                        <label for="target_group">Target Group</label>
                        <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control  {{ $errors->has('target_group') ? 'is-invalid' : '' }}" id="target_group" placeholder="Target Group">
                        @if ($errors->has('target_group'))
                            <span class="invalid-feedback">{{ $errors->first('target_group') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" value="{{old('start_date')}}" class="form-control  {{ $errors->has('start_date') ? 'is-invalid' : '' }}" id="start_date" name="start_date">
                        @if ($errors->has('start_date'))
                            <span class="invalid-feedback">{{ $errors->first('start_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input type="time" value="{{old('start_time')}}" class="form-control  {{ $errors->has('start_time') ? 'is-invalid' : '' }}" id="start_time" name="start_time">
                        @if ($errors->has('start_time'))
                            <span class="invalid-feedback">{{ $errors->first('start_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" value="{{old('end_date')}}" class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" id="end_date" name="end_date">
                        @if ($errors->has('end_date'))
                            <span class="invalid-feedback">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input type="time" value="{{old('end_time')}}" class="form-control  {{ $errors->has('end_time') ? 'is-invalid' : '' }}" id="end_time" name="end_time">
                        @if ($errors->has('end_time'))
                            <span class="invalid-feedback">{{ $errors->first('end_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input type="text" value="{{old('venue')}}" class="form-control  {{ $errors->has('venue') ? 'is-invalid' : '' }}" id="venue" name="venue">
                        @if ($errors->has('venue'))
                            <span class="invalid-feedback">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="nature_of_the_appointment">Nature of The Appointment</label>
                        <select class="form-control {{ $errors->has('nature_of_the_appointment') ? 'is-invalid' : '' }}" id="nature_of_the_appointment" name="nature_of_the_appointment">
                            <option value="permanent">Permanent</option>
                            <option value="fixed">Fixed</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="employee_category">Employee Category</label>
                        <select class="form-control" id="employee_category" name="employee_category">
                            <option value="non-technical">Technical</option>
                            <option value="technical">Non-Technical</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 ">
                    <div class="diff-from-from-container bg-light">
                        <div class="row">
                            <h3 class="title col col-md-12">Long Term</h3>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="course_fee">Course Fee</label>
                                    <input type="number" value="{{old('course_fee')}}" class="form-control  {{ $errors->has('course_fee') ? 'is-invalid' : '' }}" id="course_fee" name="course_fee">
                                    @if ($errors->has('course_fee'))
                                        <span class="invalid-feedback">{{ $errors->first('course_fee') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="duration">Duration</label>
                                    <input type="number" value="{{old('duration')}}" class="form-control  {{ $errors->has('endTime') ? 'is-invalid' : '' }}" id="duration" name="duration">
                                    <small id="durationHelpBlock" class="form-text text-muted">
                                        Months
                                    </small>
                                    @if ($errors->has('duration'))
                                        <span class="invalid-feedback">{{ $errors->first('duration') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="application_closing_date">Application Closing Date</label>
                        <input type="date" value="{{old('application_closing_date')}}" class="form-control  {{ $errors->has('application_closing_date') ? 'is-invalid' : '' }}" id="application_closing_date" name="application_closing_date" placeholder="">
                        @if ($errors->has('application_closing_date'))
                            <span class="invalid-feedback">{{ $errors->first('application_closing_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="application_closing_time">Application Closing Time</label>
                        <input type="time" value="{{old('application_closing_time')}}" class="form-control  {{ $errors->has('application_closing_time') ? 'is-invalid' : '' }}" id="application_closing_time" name="application_closing_time" placeholder="">
                        @if ($errors->has('application_closing_time'))
                            <span class="invalid-feedback">{{ $errors->first('application_closing_time') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="non_member_fee">Non Member Fee (Rs)</label>
                        <input type="number" value="{{old('non_member_fee')}}" class="form-control  {{ $errors->has('non_member_fee') ? 'is-invalid' : '' }}" id="non_member_fee" name="non_member_fee" placeholder="Non-Member Fee">
                        @if ($errors->has('non_member_fee'))
                            <span class="invalid-feedback">{{ $errors->first('non_member_fee') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="member_fee">Member Fee (Rs)</label>
                        <input type="number" value="{{old('member_fee')}}" class="form-control  {{ $errors->has('member_fee') ? 'is-invalid' : '' }}" id="member_fee" name="member_fee" placeholder="Member Fee">
                        @if ($errors->has('member_fee'))
                            <span class="invalid-feedback">{{ $errors->first('member_fee') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="student_fee">Student Fee (Rs)</label>
                        <input type="number" value="{{old('student_fee')}}" class="form-control  {{ $errors->has('student_fee') ? 'is-invalid' : '' }}" id="student_fee" name="student_fee" placeholder="Student Fee">
                        @if ($errors->has('student_fee'))
                            <span class="invalid-feedback">{{ $errors->first('student_fee') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="program_brochure">Program Brochure</label>
                        <input type="file" class="form-control-file"  id="program_brochure" name="program_brochure" class="{{ $errors->has('program_brochure') ? 'is-invalid' : '' }}" name="program_brochure">
                        @if ($errors->has('program_brochure'))
                            <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_brochure') }}</span>
                        @endif
                        <small id="program_brochureHelpBlock" class="form-text text-muted">
                            Only JPEG are allowed. Max size 1999KB.
                        </small>
                    </div>
                </div>
            </div>
            <div class="col col-md-12 d-flex justify-content-end">
                <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2" value="reload_page">Save</button>
                <button type="submit" name="_submit" class="btn btn-primary mb-2" value="redirect">Save &amp; Go Back</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')

@endpush