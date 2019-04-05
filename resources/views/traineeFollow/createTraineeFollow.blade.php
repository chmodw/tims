@extends('layouts.app')

@section('content-title', 'Trainee Follow up')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">New Payment </h4>
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
          <form action="{!! url('traineeFollowUp') !!}" method="POST" enctype="multipart/form-data">
            <div class="row">
              {{ csrf_field() }}

              <div class="col col-md-12">
              <select name="trainees_id" id="trainees_id" class="custom-select">
                <option selected>Select Trainee</option>
                @foreach($trainees as $trainee)

                  <option value="{{$trainee->id}}">{{$trainee->full_name}}</option>

                @endforeach

              </select>
              </div>

              <div class="col col-md-12">
                <select name="programs_id" id="programs_id" class="custom-select">
                  <option selected>Program Name</option>
                  {{--@foreach($programs as $program)--}}

                    <option value="1">Sliit</option>
                   <option value="2">ACBT</option>
                   <option value="3">ICBT</option>
                   <option value="4">NSBM</option>

                  {{--@endforeach--}}

                </select>
              </div>

              <div class="col col-md-12">
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" value="{{old('amount')}}" class="form-control  {{ $errors->has('amount') ? 'is-invalid' : '' }}" id="amount" name="amount" placeholder="amount">

                </div>
              </div>


              <div class="input-group mb-3">



              <div class="col col-md-6 trainingFormBtnContainer d-flex justify-content-end">
                <a class="btn btn-default trainingFormBtn mr-2" href="/traineeFollowUp">Cancel</a>
                <input type="submit" class="btn btn-primary trainingFormBtn" value="Save">
              </div>
            </div>
            </div> </form>
        </div>
      </div>
    </div>
  </div>
@endsection
