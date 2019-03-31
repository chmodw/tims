@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Update Local Program
                    </h4>
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
                    @if(isset($editProgram))
                            <form action="{{route('programs/local/update', $editProgram[0]->id)}}" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    {{ csrf_field() }}
                                    {{method_field('PATCH')}}
                                    <input type="hidden" name="programId" value="{{$editProgram[0]->programId}}">
                                    <div class="col col-md-12">
                                        <div class="form-group">
                                            <label for="programTitle">Program Title</label>
                                            <input type="text" class="form-control {{ $errors->has('programTitle') ? 'is-invalid' : '' }}" value="{{old('programTitle', $editProgram[0]->title)}}" id="programTitle" name="programTitle" placeholder="Title">
                                            @if ($errors->has('programTitle'))
                                                <span class="invalid-feedback">{{ $errors->first('programTitle') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="form-group">
                                            <label for="organisedBy">Organised By</label>
                                            <input type="text" value="{{old('programTitle', $editProgram[0]->organisedBy)}}" class="form-control  {{ $errors->has('organisedBy') ? 'is-invalid' : '' }}" name="organisedBy" id="organisedBy" placeholder="Program organiser">
                                            @if ($errors->has('organisedBy'))
                                                <span class="invalid-feedback">{{ $errors->first('organisedBy') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-8">
                                        <div class="form-group">
                                            <label for="targetGroup">Target Group</label>
                                            <input type="text" value="{{old('targetGroup', $editProgram[0]->targetGroup)}}" name="targetGroup" class="form-control  {{ $errors->has('targetGroup') ? 'is-invalid' : '' }}" id="targetGroup" placeholder="Target Group">
                                            @if ($errors->has('targetGroup'))
                                                <span class="invalid-feedback">{{ $errors->first('targetGroup') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="form-group">
                                            <label for="startDate">Start Date</label>
                                            <input type="date" value="{{old('startDate', date('Y-m-d',strtotime($editProgram[0]->startDate)))}}" class="form-control  {{ $errors->has('startDate') ? 'is-invalid' : '' }}" id="startDate" name="startDate">
                                            @if ($errors->has('startDate'))
                                                <span class="invalid-feedback">{{ $errors->first('startDate') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="form-group">
                                            <label for="startTime">Start Time</label>
                                            <input type="time" value="{{old('startTime', date("H:i", strtotime($editProgram[0]->startDate)))}}" class="form-control  {{ $errors->has('startTime') ? 'is-invalid' : '' }}" id="startTime" name="startTime">
                                            @if ($errors->has('startTime'))
                                                <span class="invalid-feedback">{{ $errors->first('startTime') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="form-group">
                                            <label for="endDate">End Date</label>
                                            <input type="date" value="{{old('endDate', date("Y-m-d", strtotime($editProgram[0]->endDate)))}}" class="form-control {{ $errors->has('endDate') ? 'is-invalid' : '' }}" id="endDate" name="endDate">
                                            @if ($errors->has('endDate'))
                                                <span class="invalid-feedback">{{ $errors->first('endDate') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-3">
                                        <div class="form-group">
                                            <label for="endTime">End Time</label>
                                            <input type="time" value="{{old('endTime', date("H:i", strtotime($editProgram[0]->endDate)))}}" class="form-control  {{ $errors->has('endTime') ? 'is-invalid' : '' }}" id="endTime" name="endTime">
                                            @if ($errors->has('endTime'))
                                                <span class="invalid-feedback">{{ $errors->first('endTime') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col col-md-6">
                                        <div class="form-group">
                                            <label for="applicationClosingDate">Application Closing Date</label>
                                            <input type="date" value="{{old('applicationClosingDate', date("Y-m-d", strtotime($editProgram[0]->applicationClosingDateTime)))}}" class="form-control  {{ $errors->has('applicationClosingDate') ? 'is-invalid' : '' }}" id="applicationClosingDate" name="applicationClosingDate" placeholder="">
                                            @if ($errors->has('applicationClosingDate'))
                                                <span class="invalid-feedback">{{ $errors->first('applicationClosingDate') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="form-group">
                                            <label for="applicationClosingTime">Application Closing Time</label>
                                            <input type="time" value="{{old('applicationClosingTime', date("H:i", strtotime($editProgram[0]->applicationClosingDateTime)))}}" class="form-control  {{ $errors->has('applicationClosingTime') ? 'is-invalid' : '' }}" id="applicationClosingTime" name="applicationClosingTime" placeholder="">
                                            @if ($errors->has('applicationClosingTime'))
                                                <span class="invalid-feedback">{{ $errors->first('applicationClosingTime') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col col-md-4">
                                        <div class="form-group">
                                            <label for="nonMemberFee">Non Member Fee (Rs)</label>
                                            <input type="number" value="{{old('nonMemberFee', $editProgram[0]->nonMemberFee)}}" class="form-control  {{ $errors->has('nonMemberFee') ? 'is-invalid' : '' }}" id="nonMemberFee" name="nonMemberFee" placeholder="Non-Member Fee">
                                            @if ($errors->has('nonMemberFee'))
                                                <span class="invalid-feedback">{{ $errors->first('nonMemberFee') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <div class="form-group">
                                            <label for="memberFee">Member Fee (Rs)</label>
                                            <input type="number" value="{{old('memberFee', $editProgram[0]->memberFee)}}" class="form-control  {{ $errors->has('memberFee') ? 'is-invalid' : '' }}" id="memberFee" name="memberFee" placeholder="Member Fee">
                                            @if ($errors->has('memberFee'))
                                                <span class="invalid-feedback">{{ $errors->first('memberFee') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col col-md-4">
                                        <div class="form-group">
                                            <label for="studentFee">Student Fee (Rs)</label>
                                            <input type="number" value="{{old('studentFee', $editProgram[0]->studentFee)}}" class="form-control  {{ $errors->has('studentFee') ? 'is-invalid' : '' }}" id="studentFee" name="studentFee" placeholder="Student Fee">
                                            @if ($errors->has('studentFee'))
                                                <span class="invalid-feedback">{{ $errors->first('studentFee') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col col-md-6">
                                        <div class="form-group">
                                            <label for="programBrochure">Program Brochure</label>
                                            <input type="file" class="form-control-file"  id="programBrochure" name="programBrochure" class="{{ $errors->has('programBrochure') ? 'is-invalid' : '' }}" name="programBrochure">
                                            @if ($errors->has('programBrochure'))
                                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('programBrochure') }}</span>
                                            @endif
                                            <small id="programBrochureHelpBlock" class="form-text text-muted">
                                                Only JPEG are allowed. Max size 1999KB.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col col-md-6 trainingFormBtnContainer">
                                        <a class="btn btn-default trainingFormBtn  d-flex justify-content-end mr-2" href="/programs/local">Cancel</a>
                                        <input type="submit" class="btn btn-primary  d-flex justify-content-end trainingFormBtn" value="Save" name="submitLocalTrainingForm">
                                    </div>
                                </div>
                            </form>

                    @else
                        {{redirect('programs/local')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
