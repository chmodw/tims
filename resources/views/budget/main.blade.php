@extends('layouts.app')

@section('content-title', 'Budget')

@section('content')
<div class="row">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Budget</h4>
      </div>
      <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
        @endif



          <div class="table-responsive table-full-width">
            <table class="table table-hover">
              <thead>
                <th>#</th>
                <th class="w-50">Program Title</th>
                <th>Start Date</th>
                <th>Closing Date</th>
                <th>No.of Trainees</th>
                <th>Attending</th>
              </thead>
              <tbody>
              @for($i=0; $i<20; $i++)
                <tr>
                  <td>{{$i}}</td>
                  <td><a href="" >Dakota Rice</a></td>
                  <td>$36,738</td>
                  <td>Niger</td>
                  <td>Oud-Turnhout</td>
                  <td>Oud-Turnhout</td>
                </tr>
              @endfor
              </tbody>
            </table>
          </div>



      </div>
    </div>
  </div>
</div>
@endsection
