@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update In House Program</h4>
                </div>
                <div class="card-body  p-4">
                    @if (session('success'))
                        @include('_alert')
                        @if(isset($editProgram))
                        <form action="{{ route('programs/inhouse/update', $editProgram[0]->id)}}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                {{ csrf_field() }}
                                {{method_field('PATCH')}}
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        <label for="programTitle">Program Title</label>
                                        <input type="text" value="{{old('programTitle', $editProgram[0]->title)}}" class="form-control {{ $errors->has('programTitle') ? 'is-invalid' : '' }}" id="programTitle" name="programTitle" placeholder="Title">
                                        @if ($errors->has('programTitle'))
                                            <span class="invalid-feedback">{{ $errors->first('programTitle') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        <label for="programContent">Program Content</label>
                                        <textarea class="form-control {{ $errors->has('programContent') ? 'is-invalid' : '' }}" style="resize: vertical; min-height: 4em; max-height: 10em;" name="programContent" id="programContent" placeholder="Content" rows="3">{{old('programContent', implode(', ', unserialize($editProgram[0]->content)))}}</textarea>
                                        <small id="contentHelpBlock" class="form-text text-muted">
                                            separate content by a single comma
                                        </small>
                                        @if ($errors->has('programContent'))
                                            <span class="invalid-feedback">{{ $errors->first('programContent') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        <label for="targetGroup">Target Group</label>
                                        <input type="text" value="{{old('targetGroup', $editProgram[0]->targetGroup)}}" name="targetGroup" class="form-control {{ $errors->has('targetGroup') ? 'is-invalid' : '' }}" id="targetGroup" placeholder="Department">
                                        @if ($errors->has('targetGroup'))
                                            <span class="invalid-feedback">{{ $errors->first('targetGroup') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="organisedBy">Organised By</label>
                                        <input type="text" value="{{old('organisedBy',$editProgram[0]->organisedBy)}}" class="form-control {{ $errors->has('organisedBy') ? 'is-invalid' : '' }}" id="organisedBy" name="organisedBy" placeholder="Program Organiser">
                                        @if ($errors->has('organisedBy'))
                                            <span class="invalid-feedback">{{ $errors->first('organisedBy') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="venue">Location</label>
                                        <input type="text" value="{{old('venue',$editProgram[0]->venue)}}" class="form-control {{ $errors->has('venue') ? 'is-invalid' : '' }}" id="venue" name="venue" placeholder="Venue">
                                        @if ($errors->has('venue'))
                                            <span class="invalid-feedback">{{ $errors->first('venue') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-3">
                                    <div class="form-group">
                                        <label for="startDate">Start Date</label>
                                        <input type="date" value="{{old('startDate', date('Y-m-d',strtotime($editProgram[0]->startDateTime)))}}" class="form-control {{ $errors->has('startDate') ? 'is-invalid' : '' }}" id="startDate" name="startDate" placeholder="">
                                        @if ($errors->has('startDate'))
                                            <span class="invalid-feedback">{{ $errors->first('startDate') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-3">
                                    <div class="form-group">
                                        <label for="startTime">Start Time</label>
                                        <input type="time" value="{{old('startTime', date('H:i',strtotime($editProgram[0]->startDateTime)))}}" class="form-control {{ $errors->has('startTime') ? 'is-invalid' : '' }}" id="startTime" name="startTime" placeholder="">
                                        @if ($errors->has('startTime'))
                                            <span class="invalid-feedback">{{ $errors->first('startTime') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-3">
                                    <div class="form-group">
                                        <label for="endDate">End Date</label>
                                        <input type="date" value="{{old('endDate', date('Y-m-d',strtotime($editProgram[0]->endDateTime)))}}" class="form-control {{ $errors->has('endDate') ? 'is-invalid' : '' }}" id="endDate" name="endDate" placeholder="">
                                        @if ($errors->has('endDate'))
                                            <span class="invalid-feedback">{{ $errors->first('endDate') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-3">
                                    <div class="form-group">
                                        <label for="endTime">End Time</label>
                                        <input type="time" value="{{old('endTime', date('H:i',strtotime($editProgram[0]->endDateTime)))}}" class="form-control {{ $errors->has('endTime') ? 'is-invalid' : '' }}" id="startTime" name="endTime" placeholder="">
                                        @if ($errors->has('endTime'))
                                            <span class="invalid-feedback">{{ $errors->first('endTime') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="applicationClosingDate">Application Closing Date</label>
                                        <input type="date" value="{{old('applicationClosingDate', date('Y-m-d',strtotime($editProgram[0]->applicationClosingDateTime)))}}" class="form-control {{ $errors->has('applicationClosingDate') ? 'is-invalid' : '' }}" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                                        @if ($errors->has('applicationClosingDate'))
                                            <span class="invalid-feedback">{{ $errors->first('applicationClosingDate') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="applicationClosingTime">Application Closing Time</label>
                                        <input type="time" value="{{old('applicationClosingTime',  date('H:i',strtotime($editProgram[0]->applicationClosingDateTime)))}}" class="form-control {{ $errors->has('applicationClosingTime') ? 'is-invalid' : '' }}" id="applicationClosingTime" name="applicationClosingTime" placeholder="">
                                        @if ($errors->has('applicationClosingTime'))
                                            <span class="invalid-feedback">{{ $errors->first('applicationClosingTime') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-5">
                                    <div class="form-group">
                                        <label for="keyPerson">Key Person</label>
                                        <input type="text" value="{{old('keyPerson', $editProgram[0]->keyPerson)}}" class="form-control {{ $errors->has('keyPerson') ? 'is-invalid' : '' }}" id="keyPerson" name="keyPerson" placeholder="Key Person">
                                        @if ($errors->has('keyPerson'))
                                            <span class="invalid-feedback">{{ $errors->first('keyPerson') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-7">
                                    <div class="form-group">
                                        <label for="keyPersonDesignation">Key Person Designation</label>
                                        <input type="text" value="{{old('keyPersonDesignation', $editProgram[0]->keyPersonDesignation)}}" class="form-control {{ $errors->has('keyPersonDesignation') ? 'is-invalid' : '' }}" id="keyPersonDesignation" name="keyPersonDesignation" placeholder="Key Person Designation">
                                        @if ($errors->has('keyPersonDesignation'))
                                            <span class="invalid-feedback">{{ $errors->first('keyPersonDesignation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col col-md-4">
                                    <div class="form-group">
                                        <label for="registrationCost">Registration Fee (Rs)</label>
                                        <input type="number" value="{{old('registrationCost', $editProgram[0]->registrationCost)}}" class="form-control {{ $errors->has('registrationCost') ? 'is-invalid' : '' }}" id="registrationCost" name="registrationCost" placeholder="Registration">
                                        @if ($errors->has('registrationCost'))
                                            <span class="invalid-feedback">{{ $errors->first('registrationCost') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group">
                                        <label for="nonRegistrationCost">Penalty Fee (Rs)</label>
                                        <input type="number" value="{{old('nonRegistrationCost', $editProgram[0]->nonRegistrationCost)}}" class="form-control {{ $errors->has('nonRegistrationCost') ? 'is-invalid' : '' }}" id="nonRegistrationCost" name="nonRegistrationCost" placeholder="penalty">
                                        @if ($errors->has('nonRegistrationCost'))
                                            <span class="invalid-feedback">{{ $errors->first('nonRegistrationCost') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group">
                                        <label for="headCost">Head Cost (Rs)</label>
                                        <input type="number" value="{{old('headCost', $editProgram[0]->headCost)}}" class="form-control {{ $errors->has('headCost') ? 'is-invalid' : '' }}" id="headCost" name="headCost" placeholder="Const per Person">
                                        @if ($errors->has('headCost'))
                                            <span class="invalid-feedback">{{ $errors->first('headCost') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group">
                                        <label for="lecturerCost">Lecturer Cost (Per hour)</label>
                                        <input type="number" value="{{old('lecturerCost', $editProgram[0]->lecturerCost)}}" class="form-control {{ $errors->has('lecturerCost') ? 'is-invalid' : '' }}" id="lecturerCost" name="lecturerCost" placeholder="Lecturer Cost">
                                        @if ($errors->has('lecturerCost'))
                                            <span class="invalid-feedback">{{ $errors->first('lecturerCost') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group">
                                        <label for="lecturerCostHours">Hours</label>
                                        <input type="number" value="{{old('lecturerCostHours', $editProgram[0]->hours)}}" class="form-control {{ $errors->has('lecturerCostHours') ? 'is-invalid' : '' }}" id="lecturerCostHours" name="lecturerCostHours" placeholder="Lecture Hours">
                                        @if ($errors->has('lecturerCostHours'))
                                            <span class="invalid-feedback">{{ $errors->first('lecturerCostHours') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary form-submit-btn" value="Save" name="submit">
                                        <a class="btn btn-default mr-2 form-cancel-link" href="{{url('/programs/inhouse')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <script>window.location = "/programs/foreign";</script>
                    @endif
                </div>
                {{--card-body end--}}
            </div>
            {{--card end--}}
        </div>
        {{--Col-md-12 END--}}
    </div>
    {{--row end--}}
@endsection
