@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">New Post-Graduation Program</h4>
                </div>
                <div class="card-body  p-4">
                    @include('_alert')
                    <form action="{{ route('programs/postgrad/create') }}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            {{ csrf_field() }}
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="programTitle">Title</label>
                                    <input type="text" value="{{old('programTitle')}}" class="form-control {{$errors->has('programTitle') ? 'is-invalid' : '' }}" id="programTitle" name="programTitle" placeholder="Title">
                                    @if ($errors->has('institute'))
                                        <span class="invalid-feedback">{{$errors->first('programTitle')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-7">
                                <div class="form-group">
                                    <label for="institute">Institute</label>
                                    <input type="text" value="{{old('institute')}}" class="form-control {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute" id="institute" placeholder="Institute of The Program">
                                    @if ($errors->has('institute'))
                                        <span class="invalid-feedback">{{ $errors->first('institute') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-5">
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <input type="text" value="{{old('department')}}" name="department" class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" id="department" placeholder="Department">
                                    @if ($errors->has('department'))
                                        <span class="invalid-feedback">{{ $errors->first('department')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="programs">Courses</label>
                                    <textarea class="form-control {{ $errors->has('programs') ? 'is-invalid' : '' }}" style="resize: vertical; min-height: 4em; max-height: 10em;" name="programs" id="programs" placeholder="Available Courses" rows="3">{{old('programs')}}</textarea>
                                    @if ($errors->has('programs'))
                                        <span class="invalid-feedback">{{ $errors->first('programs') }}</span>
                                    @endif
                                    <small id="contentHelpBlock" class="form-text text-muted">
                                        separate content by a single comma
                                    </small>
                                </div>
                            </div>
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="requirements">Requirements</label>
                                    <textarea class="form-control {{ $errors->has('requirements') ? 'is-invalid' : '' }}" style="resize: vertical; min-height: 4em; max-height: 10em;" name="requirements" id="requirements" placeholder="Requirements" rows="3">{{old('requirements')}}</textarea>
                                    @if ($errors->has('requirements'))
                                        <span class="invalid-feedback">{{ $errors->first('requirements')}}</span>
                                    @endif
                                    <small id="contentHelpBlock" class="form-text text-muted">
                                        separate content by a single comma
                                    </small>
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="applicationClosingDate">Application Closing Date</label>
                                    <input type="date" value="{{old('applicationClosingDate')}}" class="form-control {{ $errors->has('applicationClosingDate') ? 'is-invalid' : '' }}" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                                    @if ($errors->has('applicationClosingDate'))
                                        <span class="invalid-feedback">{{ $errors->first('applicationClosingDate') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="applicationClosingTime">Application Closing Time</label>
                                    <input type="time" value="{{old('applicationClosingTime')}}" class="form-control {{ $errors->has('applicationClosingTime') ? 'is-invalid' : '' }}" id="applicationClosingTime" name="applicationClosingTime" placeholder="HH:MM">
                                    @if ($errors->has('applicationClosingTime'))
                                        <span class="invalid-feedback">{{ $errors->first('applicationClosingTime') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="registrationFees">Registration Fees (Rs)</label>
                                    <input type="number"  value="{{old('registrationFees')}}" class="form-control {{ $errors->has('registrationFees') ? 'is-invalid' : '' }}" id="registrationFees" name="registrationFees" placeholder="Registration Fees">
                                    @if ($errors->has('registrationFees'))
                                        <span class="invalid-feedback">{{ $errors->first('registrationFees') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="firstYearFees">First Year (Rs)</label>
                                    <input type="number" value="{{old('firstYearFees')}}" class="form-control {{ $errors->has('firstYearFees') ? 'is-invalid' : '' }}" id="firstYearFees" name="firstYearFees" placeholder="First Year Fees">
                                    @if ($errors->has('firstYearFees'))
                                        <span class="invalid-feedback">{{ $errors->first('firstYearFees') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-md-4">
                                <div class="form-group">
                                    <label for="secondYearFees">Second Year (Rs)</label>
                                    <input type="number" value="{{old('secondYearFees')}}" class="form-control {{ $errors->has('secondYearFees') ? 'is-invalid' : '' }}" id="secondYearFees" name="secondYearFees" placeholder="Second Year Fees">
                                    @if ($errors->has('secondYearFees'))
                                        <span class="invalid-feedback">{{ $errors->first('secondYearFees') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col col-md-6">
                                <div class="form-group">
                                    <label for="programBrochure">Program Brochure</label>
                                    <input type="file" value="{{old('programBrochure')}}" class="form-control-file {{ $errors->has('programBrochure') ? 'is-invalid' : '' }}" id="programBrochure" name="programBrochure">
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
                                    <a class="btn btn-default mr-2 form-cancel-link" href="{{url('/programs/postgrad')}}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
