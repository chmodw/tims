@extends('layouts.app')

@section('content-title', 'Programs')

@section('content')
<div class="row">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Programs</h4>
      </div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif

        You are logged in!
      </div>
    </div>
  </div>
</div>
@endsection
