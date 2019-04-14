@extends('home')

@section('title', 'TIMS | Create Local Program')

@section('main-content')

    <div class="panel panel-default">
        <div class="panel-heading">
            New Foreign Program
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('programs.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="ForeignProgram" name="program_type">

                <div class="col col-md-12">
                    <div class="from-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                        <label for="program_title">Program Title</label>
                        <input type="text" value="{{old('program_title')}}" class="form-control" id="program_title" name="program_title" placeholder="Title">
                        @if ($errors->has('program_title'))
                            <span class="help-block">{{ $errors->first('program_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-5">
                    <div class="from-group has-feedback {{$errors->has('organised_by') ? 'has-error' : ''}}">
                        <label for="organised_by">Organised By</label>
                        <input type="text" value="{{old('organised_by')}}" class="form-control {{ $errors->has('organised_by') ? 'has-error' : '' }}" name="organised_by" id="organised_by" placeholder="Program organiser">
                        @if ($errors->has('organised_by'))
                            <span class="help-block">{{ $errors->first('organised_by') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-7">
                    <div class="from-group has-feedback {{$errors->has('notified_by') ? 'has-error' : ''}}">
                        <label for="notified_by">Notified By</label>
                        <input type="text" value="{{old('notifiedBy')}}" name="notified_by" class="form-control {{ $errors->has('notified_by') ? 'has-error' : '' }}" id="notified_by" placeholder="Notified By">
                        @if ($errors->has('notified_by'))
                            <span class="help-block">{{ $errors->first('notified_by') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-12">
                    <div class="from-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                        <label for="target_group">Target Group</label>
                        <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control {{ $errors->has('target_group') ? 'has-error' : '' }}" id="target_group" placeholder="Target Group">
                        @if ($errors->has('target_group'))
                            <span class="help-block">{{ $errors->first('target_group') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="from-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                        <label for="start_date">Start Date</label>
                        <input type="date" value="{{old('start_date')}}" class="form-control {{ $errors->has('start_date') ? 'has-error' : '' }}" id="start_date" name="start_date">
                        @if ($errors->has('start_date'))
                            <span class="help-block">{{ $errors->first('start_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="from-group has-feedback {{$errors->has('end_date') ? 'has-error' : ''}}">
                        <label for="end_date">End Date</label>
                        <input type="date" value="{{old('end_date')}}" class="form-control {{ $errors->has('end_date') ? 'has-error' : '' }}" id="end_date" name="end_date">
                        @if ($errors->has('end_date'))
                            <span class="help-block">{{ $errors->first('end_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="from-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                        <label for="application_closing_date">Application Closing Date</label>
                        <input type="date" value="{{old('application_closing_date')}}" class="form-control {{ $errors->has('application_closing_date') ? 'has-error' : '' }}" id="application_closing_date" name="application_closing_date" placeholder="">
                        @if ($errors->has('application_closing_date'))
                            <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="from-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                        <label for="application_closing_time">Application Closing Time</label>
                        <input type="time" value="{{old('application_closing_time')}}" class="form-control {{ $errors->has('application_closing_time') ? 'has-error' : '' }}" id="application_closing_time" name="application_closing_time" placeholder="">
                        @if ($errors->has('application_closing_time'))
                            <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
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

@endsection