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
              <th>Section ID</th>
              {{--<th class="w-50">fdfd</th>--}}
              <th>Section Name</th>
              <th>Section HOD</th>
              <th>Section Email</th>
              <th>Allocated budget</th>
              {{--<th>Existing budget</th>--}}

              </thead>
              <tbody>
              @foreach($sections as $section )

                <tr>
                  <td>{{$section->id}}</td>

                  <td>{{$section->sectionName}}</td>
                  <td>{{$section->section_hod}}</td>
                  <td>{{$section->section_email}}</td>
                  <td>Rs. {{$section->budget->amount}}</td>
                  {{--<td>Sample data</td>--}}
                  {{--<td> <button class="btn btn-primary btn-xs" href="{{route('budget.create',$section->id)}}">Create</button> </td>--}}
                  {{--<td><a href="{{route('budget.create',$section->id)}}" class="btn btn-primary btn-xs" > Create | {{$section->id}}</a></td>--}}
                  {{--<td><a href="{{route('budget.edit',$section->id)}}" class="btn btn-primary btn-xs" > Edit | {{$section->id}}</a></td>--}}
                  {{--impliment edit here--}}

                </tr>
              @endforeach

              </tbody>
            </table>
          </div>



      </div>
    </div>
  </div>
</div>
@endsection
