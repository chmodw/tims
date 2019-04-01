@extends('layouts.app')

@section('content-title', 'Section')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Create new section</h4>
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
          <form action="{!! url('section') !!}" method="POST" enctype="multipart/form-data">
            <div class="row">
              {{ csrf_field() }}
              <input type="hidden" name="sections" id="sections" value="sections" />

              <div class="col col-md-12">
                <div class="form-group">
                  <label for="sectionName">Section Name</label>
                  <input type="text" value="{{old('sectionName')}}" class="form-control  {{ $errors->has('sectionName') ? 'is-invalid' : '' }}" id="sectionName" name="sectionName" placeholder="Name">
                  @if ($errors->has('sectionName'))
                    <span class="invalid-feedback">{{ $errors->first('sectionName') }}</span>
                  @endif
                </div>
              </div>

              <div class="col col-md-5">
                <div class="form-group">
                  <label for="organisedBy">Created By</label>
                  <input type="text" value="{{old('createdBy')}}" class="form-control {{ $errors->has('createdBy') ? 'is-invalid' : '' }}" name="createdBy" id="createdBy" placeholder="Created by">
                  @if ($errors->has('createdBy'))
                    <span class="invalid-feedback">{{ $errors->first('createdBy') }}</span>
                  @endif
                </div>
              </div>

              <div class="col col-md-7">
                <div class="form-group">
                  <label for="notifiedBy">HOD</label>
                  <input type="text" value="{{old('section_hod')}}" name="section_hod" class="form-control {{ $errors->has('section_hod') ? 'is-invalid' : '' }}" id="section_hod" placeholder="Section Head ">
                  @if ($errors->has('section_hod'))
                    <span class="invalid-feedback">{{ $errors->first('section_hod') }}</span>
                  @endif
                </div>
              </div>

              <div class="col col-md-12">
                <div class="form-group">
                  <label for="targetGroup">Email</label>
                  <input type="text" value="{{old('section_email')}}" name="section_email" class="form-control {{ $errors->has('section_email') ? 'is-invalid' : '' }}" id="section_email" placeholder="Section email">
                  @if ($errors->has('section_email'))
                    <span class="invalid-feedback">{{ $errors->first('section_email') }}</span>
                  @endif
                </div>
              </div>

              <div class="col col-md-3">
                <div class="form-group">
                  <label for="startDate">Contact Number</label>
                  <input type="number" value="{{old('section_contact')}}" class="form-control {{ $errors->has('section_contact') ? 'is-invalid' : '' }}" id="section_contact" name="section_contact">
                  @if ($errors->has('section_contact'))
                    <span class="invalid-feedback">{{ $errors->first('section_contact') }}</span>
                  @endif
                </div>
              </div>


              <div class="col col-md-6 trainingFormBtnContainer d-flex justify-content-end">
                <a class="btn btn-default trainingFormBtn mr-2" href="/section">Cancel</a>
                <input type="submit" class="btn btn-primary trainingFormBtn" value="Save" name="sectionForm">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
