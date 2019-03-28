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
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong>{{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
          <form action="{{ route('programs/foreign') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
              {{ csrf_field() }}
              <div class="col col-md-12">
                  <div class="form-group">
                    <label for="institute">Title</label>
                    <input type="text" class="form-control  {{ $errors->has('programTitle') ? 'is-invalid' : '' }}" id="programTitle" name="programTitle" placeholder="Title">
                    @if ($errors->has('programTitle'))
                      <span class="invalid-feedback">{{ $errors->first('programTitle') }}</span>
                    @endif
                  </div>
              </div>
              <div class="col col-md-7">
                <div class="form-group">
                  <label for="institute">Institute</label>
                  <input type="text" class="form-control {{ $errors->has('institute') ? 'is-invalid' : '' }}" name="institute" id="institute" placeholder="Institute of The Program">
                  @if ($errors->has('institute'))
                    <span class="invalid-feedback">{{ $errors->first('institute') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-5">
                <div class="form-group">
                  <label for="department">Department</label>
                  <input type="text" name="department" class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" id="department" placeholder="Department">
                  @if ($errors->has('department'))
                    <span class="invalid-feedback">{{ $errors->first('department') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-12">
                <div class="form-group">
                  <label for="programs">Courses</label>
                  <textarea class="form-control {{ $errors->has('programs') ? 'is-invalid' : '' }}" style="resize: vertical; min-height: 4em; max-height: 10em;" name="programs" id="programs" placeholder="Available Courses" rows="3"></textarea>
                  @if ($errors->has('programs'))
                    <span class="invalid-feedback">{{ $errors->first('programs') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-12">
                <div class="form-group">
                  <label for="requirements">Requirements</label>
                  <textarea class="form-control {{ $errors->has('requirements') ? 'is-invalid' : '' }}" style="resize: vertical; min-height: 4em; max-height: 10em;" name="requirements" id="requirements" placeholder="Requirements" rows="3"></textarea>
                  @if ($errors->has('requirements'))
                    <span class="invalid-feedback">{{ $errors->first('requirements') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-6">
                <div class="form-group">
                  <label for="applicationClosingDate">Application Closing Date</label>
                  <input type="date" class="form-control {{ $errors->has('applicationClosingDate') ? 'is-invalid' : '' }}" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                  @if ($errors->has('applicationClosingDate'))
                    <span class="invalid-feedback">{{ $errors->first('applicationClosingDate') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-6">
                <div class="form-group">
                  <label for="applicationClosingTime">Application Closing Time</label>
                  <input type="time" class="form-control {{ $errors->has('applicationClosingTime') ? 'is-invalid' : '' }}" id="applicationClosingTime" name="applicationClosingTime" placeholder="HH:MM">
                  @if ($errors->has('applicationClosingTime'))
                    <span class="invalid-feedback">{{ $errors->first('applicationClosingTime') }}</span>
                  @endif
                </div>
              </div>

              <div class="col col-md-4">
                <div class="form-group {{ $errors->has('registrationFees') ? 'has-error' : '' }}">
                  <label for="registrationFees">Registration Fees (Rs)</label>
                  <input type="number" class="form-control" id="registrationFees" name="registrationFees" placeholder="Registration Fees">
                  @if ($errors->has('registrationFees'))
                    <span class="invalid-feedback">{{ $errors->first('registrationFees') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-4">
                <div class="form-group">
                  <label for="firstYearFees">First Year (Rs)</label>
                  <input type="number" class="form-control {{ $errors->has('firstYearFees') ? 'is-invalid' : '' }}" id="firstYearFees" name="firstYearFees" placeholder="First Year Fees">
                  @if ($errors->has('firstYearFees'))
                    <span class="invalid-feedback">{{ $errors->first('firstYearFees') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-4">
                <div class="form-group">
                  <label for="secondYearFees">Second Year (Rs)</label>
                  <input type="number" class="form-control {{ $errors->has('secondYearFees') ? 'is-invalid' : '' }}" id="secondYearFees" name="secondYearFees" placeholder="Second Year Fees">
                  @if ($errors->has('secondYearFees'))
                    <span class="invalid-feedback">{{ $errors->first('secondYearFees') }}</span>
                  @endif
                </div>
              </div>

              <div class="col col-md-6">
                <div class="form-group">
                  <label for="programBrochure">Program Brochure</label>
                  <input type="file" class="form-control-file {{ $errors->has('programBrochure') ? 'is-invalid' : '' }}" id="programBrochure" name="programBrochure">
                  @if ($errors->has('programBrochure'))
                    <span class="invalid-feedback">{{ $errors->first('programBrochure') }}</span>
                  @endif
                  {{--<p class="help-block">Example block-level help text here.</p>--}}
                </div>
              </div>
              <div class="col col-md-6 trainingFormBtnContainer d-flex justify-content-end">
                <a class="btn btn-default trainingFormBtn mr-2" href="/programs">Cancel</a>
                <input type="submit" class="btn btn-primary trainingFormBtn" value="Save" name="submitLocalTrainingForm">
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>
@endsection
