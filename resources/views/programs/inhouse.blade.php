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
                <div class="col col-md-12">
                    <div class="form-group {{ $errors->has('programContent') ? 'has-error' : '' }}">
                        <label for="programContent">Program Content</label>
                        <textarea class="form-control" style="resize: vertical; min-height: 4em; max-height: 10em;" name="programContent" id="programContent" placeholder="Content" rows="3"></textarea>
                        @if ($errors->has('programContent'))
                            <span class="help-block">{{ $errors->first('programContent') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-12">
                    <div class="form-group">
                        <label for="targetGroup">Target Group</label>
                        <input type="text" name="targetGroup" class="form-control" id="targetGroup" placeholder="Department">
                        @if ($errors->has('targetGroup'))
                            <span class="help-block">{{ $errors->first('targetGroup') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="organisedBy">Organised By</label>
                        <input type="text" class="form-control" id="organisedBy" name="organizedBy" placeholder="Program Organiser">
                        @if ($errors->has('organisedBy'))
                            <span class="help-block">{{ $errors->first('organisedBy') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="venue">Location</label>
                        <input type="text" class="form-control" id="venue" name="venue" placeholder="Venue">
                        @if ($errors->has('venue'))
                            <span class="help-block">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="startDate">Start Date</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" placeholder="">
                        @if ($errors->has('startDate'))
                            <span class="help-block">{{ $errors->first('startDate') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="startTime">Start Time</label>
                        <input type="time" class="form-control" id="startTime" name="startTime" placeholder="">
                        @if ($errors->has('startTime'))
                            <span class="help-block">{{ $errors->first('startTime') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="endDate">End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" placeholder="">
                        @if ($errors->has('endDate'))
                            <span class="help-block">{{ $errors->first('endDate') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-3">
                    <div class="form-group">
                        <label for="startTime">End Time</label>
                        <input type="time" class="form-control" id="startTime" name="startTime" placeholder="">
                        @if ($errors->has('startTime'))
                            <span class="help-block">{{ $errors->first('startTime') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="applicationClosingDate">Application Closing Date</label>
                        <input type="date" class="form-control" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                        @if ($errors->has('applicationClosingDate'))
                            <span class="help-block">{{ $errors->first('applicationClosingDate') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="form-group">
                        <label for="applicationClosingTime">Application Closing Time</label>
                        <input type="time" class="form-control" id="applicationClosingTime" name="applicationClosingTime" placeholder="">
                        @if ($errors->has('applicationClosingTime'))
                            <span class="help-block">{{ $errors->first('applicationClosingTime') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-5">
                    <div class="form-group">
                        <label for="keyPerson">Key Person</label>
                        <input type="text" class="form-control" id="keyPerson" name="keyPerson" placeholder="Key Person">
                        @if ($errors->has('keyPerson'))
                            <span class="help-block">{{ $errors->first('keyPerson') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-7">
                    <div class="form-group">
                        <label for="keyPersonDesignation">Key Person Designation</label>
                        <input type="text" class="form-control" id="keyPersonDesignation" name="keyPersonDesignation" placeholder="Key Person Designation">
                        @if ($errors->has('keyPersonDesignation'))
                            <span class="help-block">{{ $errors->first('keyPersonDesignation') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="registrationCost">Registration Fee (Rs)</label>
                        <input type="number" class="form-control" id="registrationCost" name="registrationCost" placeholder="Registration">
                        @if ($errors->has('registrationCost'))
                            <span class="help-block">{{ $errors->first('registrationCost') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="nonRegistrationCost">Penalty Fee (Rs)</label>
                        <input type="number" class="form-control" id="nonRegistrationCost" name="nonRegistrationCost" placeholder="penalty">
                        @if ($errors->has('nonRegistrationCost'))
                            <span class="help-block">{{ $errors->first('nonRegistrationCost') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="headCost">Head Cost (Rs)</label>
                        <input type="number" class="form-control" id="headCost" name="headCost" placeholder="Const per Person">
                        @if ($errors->has('headCost'))
                            <span class="help-block">{{ $errors->first('headCost') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="lecturerCost">Lecturer Cost (Per hour)</label>
                        <input type="number" class="form-control" id="lecturerCost" name="lecturerCost" placeholder="Key Person Designation">
                        @if ($errors->has('lecturerCost'))
                            <span class="help-block">{{ $errors->first('lecturerCost') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="form-group">
                        <label for="lecturerCostHours">Hours</label>
                        <input type="number" class="form-control" id="lecturerCostHours" name="lecturerCostHours" placeholder="Lecture Hours">
                        @if ($errors->has('lecturerCostHours'))
                            <span class="help-block">{{ $errors->first('lecturerCostHours') }}</span>
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
      {{--card-body end--}}
    </div>
  {{--card end--}}
  </div>
  {{--Col-md-12 END--}}
</div>
  {{--row end--}}
@endsection
