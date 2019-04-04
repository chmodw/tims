@extends('layouts.app')

@section('content-title', 'Budget')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Allocate budget for a unit </h4>
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
          <form action="{!! url('budget') !!}" method="POST" enctype="multipart/form-data">
            <div class="row">
              {{ csrf_field() }}

              <div class="col col-md-12">
                <div class="form-group">
                  <label for="sectionName">Budget amount</label>
                  <input type="text" value="{{old('amount')}}" class="form-control  {{ $errors->has('amount') ? 'is-invalid' : '' }}" id="amount" name="amount" placeholder="amount">
                  {{--@if ($errors->has('sectionName'))--}}
                    {{--<span class="invalid-feedback">{{ $errors->first('sectionName') }}</span>--}}
                  {{--@endif--}}
                </div>
              </div>

              {{--<div class="col col-md-12">--}}
                {{--<div class="form-group">--}}
                  {{--<label for="sectionName">Section Id</label>--}}
                  {{--<input type="text" value="{{old('section_id')}}" class="form-control  {{ $errors->has('section_id') ? 'is-invalid' : '' }}" id="section_id" name="section_id" placeholder="section id">--}}
                  {{--@if ($errors->has('sectionName'))--}}
                  {{--<span class="invalid-feedback">{{ $errors->first('sectionName') }}</span>--}}
                  {{--@endif--}}
                {{--</div>--}}
              {{--</div>--}}



              <div class="input-group mb-3">
                {{--<div class="input-group-prepend">--}}
                  {{--<label class="input-group-text" for="inputGroupSelect01">Select Sections</label>--}}
                {{--</div>--}}
                <select name="section_id" id="section_id" class="custom-select">
                  <option selected>Choose...</option>
                  @foreach($sections as $section)

                    <option value="{{$section->id}}">{{$section->sectionName}}</option>

                  @endforeach

                </select>
              </div>

              <div class="col col-md-6 trainingFormBtnContainer d-flex justify-content-end">
                <a class="btn btn-default trainingFormBtn mr-2" href="/budget">Cancel</a>
                <input type="submit" class="btn btn-primary trainingFormBtn" value="Save">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
