@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">New Foreign Program</h4>
      </div>
      <div class="card-body  p-4">
        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif
          <form action="{{ route('programs/foreign') }}" method="POST" enctype="multipart/form-data">
            <div class="row">
              {{ csrf_field() }}
              <div class="col col-md-12">
                <div class="form-group {{ $errors->has('programTitle') ? 'has-error' : '' }}">
                  <label for="programTitle">Program Title</label>
                  <input type="text" class="form-control" id="programTitle" name="programTitle" placeholder="Title">
                  @if ($errors->has('programTitle'))
                    <span class="help-block">{{ $errors->first('programTitle') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-5">
                <div class="form-group {{ $errors->has('organisedBy') ? 'has-error' : '' }}">
                  <label for="organisedBy">Organised By</label>
                  <input type="text" class="form-control" name="organisedBy" id="organisedBy" placeholder="Program organiser">
                  @if ($errors->has('organisedBy'))
                    <span class="help-block">{{ $errors->first('organisedBy') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-7">
                <div class="form-group {{ $errors->has('notifiedBy') ? 'has-error' : '' }}">
                  <label for="notifiedBy">Notified By</label>
                  <input type="text" name="notifiedBy" class="form-control" id="notifiedBy" placeholder="Notified By">
                  @if ($errors->has('notifiedBy'))
                    <span class="help-block">{{ $errors->first('notifiedBy') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-12">
                <div class="form-group {{ $errors->has('targetGroup') ? 'has-error' : '' }}">
                  <label for="targetGroup">Target Group</label>
                  <input type="text" name="targetGroup" class="form-control" id="targetGroup" placeholder="Target Group">
                  @if ($errors->has('targetGroup'))
                    <span class="help-block">{{ $errors->first('targetGroup') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-3">
                <div class="form-group {{ $errors->has('startDate') ? 'has-error' : '' }}">
                  <label for="startDate">Start Date</label>
                  <input type="date" class="form-control" id="startDate" name="startDate">
                  @if ($errors->has('startDate'))
                    <span class="help-block">{{ $errors->first('startDate') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-3">
                <div class="form-group {{ $errors->has('endDate') ? 'has-error' : '' }}">
                  <label for="endDate">End Date</label>
                  <input type="date" class="form-control" id="endDate" name="endDate">
                  @if ($errors->has('endDate'))
                    <span class="help-block">{{ $errors->first('endDate') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-3">
                <div class="form-group {{ $errors->has('applicationClosingDate') ? 'has-error' : '' }}">
                  <label for="applicationClosingDate">Application Closing Date</label>
                  <input type="date" class="form-control" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                  @if ($errors->has('applicationClosingDate'))
                    <span class="help-block">{{ $errors->first('applicationClosingDate') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-3">
                <div class="form-group {{ $errors->has('applicationClosingTime') ? 'has-error' : '' }}">
                  <label for="applicationClosingTime">Application Closing Time</label>
                  <input type="time" class="form-control" id="applicationClosingTime" name="applicationClosingTime" placeholder="">
                  @if ($errors->has('applicationClosingTime'))
                    <span class="help-block">{{ $errors->first('applicationClosingTime') }}</span>
                  @endif
                </div>
              </div>
              <div class="col col-md-6">
                <div class="form-group {{ $errors->has('programBrochure') ? 'has-error' : '' }}">
                  <label for="programBrochure">Program Brochure</label>
                  <input type="file" id="programBrochure" name="programBrochure">
                  {{--<p class="help-block">Example block-level help text here.</p>--}}
                  @if ($errors->has('programBrochure'))
                    <span class="help-block">{{ $errors->first('programBrochure') }}</span>
                  @endif
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
