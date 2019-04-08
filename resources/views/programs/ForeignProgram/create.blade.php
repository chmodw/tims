@extends('lap::layouts.auth')

@section('title', 'New Foreign Program')
@section('child-content')
    <form method="POST" action="{{ route('programs.create') }}" novalidate data-ajax-form enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="ForeignProgram" name="program_type">

        <div class="container">
            <div class="row">

                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="program_title">Program Title</label>
                        <input type="text" value="{{old('program_title')}}" class="form-control  {{ $errors->has('program_title') ? 'is-invalid' : '' }}" id="program_title" name="program_title" placeholder="Title">
                        @if ($errors->has('program_title'))
                            <span class="invalid-feedback">{{ $errors->first('program_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-5">
                    <div class="form-group">
                        <label for="organisedBy">Organised By</label>
                        <input type="text" value="{{old('organisedBy')}}" class="form-control {{ $errors->has('organisedBy') ? 'is-invalid' : '' }}" name="organisedBy" id="organisedBy" placeholder="Program organiser">
                        @if ($errors->has('organisedBy'))
                            <span class="invalid-feedback">{{ $errors->first('organisedBy') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-7">
                    <div class="form-group">
                        <label for="notifiedBy">Notified By</label>
                        <input type="text" value="{{old('notifiedBy')}}" name="notifiedBy" class="form-control {{ $errors->has('notifiedBy') ? 'is-invalid' : '' }}" id="notifiedBy" placeholder="Notified By">
                        @if ($errors->has('notifiedBy'))
                            <span class="invalid-feedback">{{ $errors->first('notifiedBy') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="targetGroup">Target Group</label>
                        <input type="text" value="{{old('targetGroup')}}" name="targetGroup" class="form-control {{ $errors->has('targetGroup') ? 'is-invalid' : '' }}" id="targetGroup" placeholder="Target Group">
                        @if ($errors->has('targetGroup'))
                            <span class="invalid-feedback">{{ $errors->first('targetGroup') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="venue">Venue</label>
                        <input type="text" value="{{old('venue')}}" name="venue" class="form-control {{ $errors->has('venue') ? 'is-invalid' : '' }}" id="venue" placeholder="Venue">
                        @if ($errors->has('venue'))
                            <span class="invalid-feedback">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col col-md-2">
                    <div class="form-group">
                        <label for="currency">Currency</label>
                        <select class="form-control {{ $errors->has('currency') ? 'is-invalid' : '' }}" id="currency" name="currency">
                            <option value="usd">USD</option>
                            <option value="euro">EURO</option>
                            <option value="gbp">GBP</option>
                            <option value="lkr">LKR</option>
                        </select>
                        @if ($errors->has('currency'))
                            <span class="invalid-feedback">{{ $errors->first('currency') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="course_fee">Course Fee</label>
                        <input type="text" value="{{old('course_fee')}}" name="course_fee" class="form-control {{ $errors->has('course_fee') ? 'is-invalid' : '' }}" id="course_fee" placeholder="Course Fee">
                        @if ($errors->has('course_fee'))
                            <span class="invalid-feedback">{{ $errors->first('course_fee') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" value="{{old('startDate')}}" class="form-control {{ $errors->has('startDate') ? 'is-invalid' : '' }}" id="startDate" name="startDate">
                        @if ($errors->has('startDate'))
                            <span class="invalid-feedback">{{ $errors->first('startDate') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" value="{{old('endDate')}}" class="form-control {{ $errors->has('endDate') ? 'is-invalid' : '' }}" id="endDate" name="endDate">
                        @if ($errors->has('endDate'))
                            <span class="invalid-feedback">{{ $errors->first('endDate') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="applicationClosingDate">Application Closing Date</label>
                        <input type="date" value="{{old('applicationClosingDate')}}" class="form-control {{ $errors->has('applicationClosingDate') ? 'is-invalid' : '' }}" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                        @if ($errors->has('applicationClosingDate'))
                            <span class="invalid-feedback">{{ $errors->first('applicationClosingDate') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="applicationClosingTime">Application Closing Time</label>
                        <input type="time" value="{{old('applicationClosingTime')}}" class="form-control {{ $errors->has('applicationClosingTime') ? 'is-invalid' : '' }}" id="applicationClosingTime" name="applicationClosingTime" placeholder="">
                        @if ($errors->has('applicationClosingTime'))
                            <span class="invalid-feedback">{{ $errors->first('applicationClosingTime') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="nature_of_the_appointment">Nature of The Appointment</label>
                        <select class="form-control" id="nature_of_the_appointment" name="nature_of_the_appointment">
                            <option value="permanent">Permanent</option>
                            <option value="fixed">Fixed</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="employee_category">Employee Category</label>
                        <select class="form-control" id="employee_category" name="employee_category">
                            <option value="non-tech">Technical</option>
                            <option value="tech">Non-Technical</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="programBrochure">Program Brochure</label>
                        <input type="file" class="form-control-file" name="programBrochure" id="programBrochure" name="programBrochure">
                        @if ($errors->has('programBrochure'))
                            <span class="invalid-feedback">{{ $errors->first('programBrochure') }}</span>
                        @endif
                        <small id="programBrochureHelpBlock" class="form-text text-muted">
                            Only JPEG are allowed. Max size 1999KB.
                        </small>
                    </div>
                </div>
                <div class="col col-md-12 d-flex justify-content-end">
                    <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2" value="reload_page">Save</button>
                    <button type="submit" name="_submit" class="btn btn-primary mb-2" value="redirect">Save &amp; Go Back</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')

@endpush