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
                <th>ID </th>
                {{--<th>Created by</th>--}}
                {{--<th class="w-50">fdfd</th>--}}
                <th>Section Name</th>

                <th>Created at</th>
                <th>Updated at</th>

                {{--<th>Edit </th>--}}
                <th>Allocated budget</th>
                {{--<th>Existing budget</th>--}}
              </thead>
              <tbody>
              @foreach($sections as $section)

                <tr>
                  <td>{{$section->id}}</td>
                  {{--<td>{{$section->createdBy}}</td>--}}

                  <td>{{$section->sectionName}}</td>
                  <td>{{$section->created_at}}</td>
                  <td>{{$section->updated_at}}</td>

                  <td>Rs.{{$section->budget->amount}}</td>
                  {{--<td><a href="{{route('section.edit',$section->id)}}" class="btn btn-primary btn-xs" > Edit | {{$section->id}}</a></td>--}}
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
