@extends('layouts.app')

@section('content-title', 'Sections')

@section('content')



<div class="row">
  <div class="col-md-12 ">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Sections</h4>
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
                <th>Created by</th>
                {{--<th class="w-50">fdfd</th>--}}
                <th>Section Name</th>
                <th>Section HOD</th>
                <th>Section Email</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>ID | Edit</th>
              </thead>
              <tbody>
              @foreach($sections as $section)

                <tr>
                  <td>{{$section->createdBy}}</td>

                  <td>{{$section->sectionName}}</td>
                  <td>{{$section->section_hod}}</td>
                  <td>{{$section->section_email}}</td>
                  <td>{{$section->created_at}}</td>
                  <td>{{$section->updated_at}}</td>
                  {{--impliment edit here--}}
                  <td><a href="{{route('section.edit',$section->id)}}" >{{$section->id}}</a></td>
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
