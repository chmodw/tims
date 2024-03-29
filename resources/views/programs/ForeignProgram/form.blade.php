@extends('layouts.main')

@section('content-title', 'Programs')

@section('content')

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">New Foreign Program</h4>
        </div>
        <div class="card-body">
            @include('layouts._alert')
            <form action="{{ route('programs/foreign/create') }}" method="POST" enctype="multipart/form-data">
                <div class="row">
                    {{ csrf_field() }}
                    <input type="hidden" name="program_type" id="programType" value="ForeignTrainingProgram" />
                    <div class="col col-md-12">
                        <div class="form-group">
                            <label for="programTitle">Program Title</label>
                            <input type="text" value="{{old('programTitle')}}" class="form-control  {{ $errors->has('programTitle') ? 'is-invalid' : '' }}" id="programTitle" name="programTitle" placeholder="Title">
                            @if ($errors->has('programTitle'))
                                <span class="invalid-feedback">{{ $errors->first('programTitle') }}</span>
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
                    <div class="col col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary form-submit-btn" value="Save" name="submit">
                            <a class="btn btn-default mr-2 form-cancel-link" href="{{url('/programs/foreign')}}">Cancel</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
