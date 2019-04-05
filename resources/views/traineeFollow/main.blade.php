{{--@extends('layouts.app')--}}

{{--@section('content-title', 'Trainee Follow up')--}}

{{--@section('content')--}}
{{--<div class="row">--}}
  {{--<div class="col-md-12 ">--}}
    {{--<div class="card">--}}
      {{--<div class="card-header">--}}
        {{--<h4 class="card-title">Payment Follow ups</h4>--}}
      {{--</div>--}}
      {{--<div class="card-body">--}}
        {{--@if (session('status'))--}}
        {{--<div class="alert alert-success">--}}
          {{--{{ session('status') }}--}}
        {{--</div>--}}
        {{--@endif--}}



          {{--<div class="table-responsive table-full-width">--}}
            {{--<table class="table table-hover">--}}
              {{--<thead>--}}
              {{--<th>Section Name</th>--}}
              {{--<th class="w-50">fdfd</th>--}}
              {{--<th>Employee Name</th>--}}
              {{--<th>Payed amount</th>--}}
              {{--<th>Due Amount</th>--}}
              {{--<th>Program cost</th>--}}
              {{--<th>Balance</th>--}}

              {{--</thead>--}}
              {{--<tbody>--}}
              {{--@foreach($sections as $section)--}}
                {{--<tr>--}}
                  {{--@foreach($sections ->trainees as $trainee)--}}

                {{--<td>{{$section->sectionName}}</td>--}}
                  {{--<td>{{$trainee->full_name}}</td>--}}


                    {{--@endforeach--}}

                {{--</tr>--}}
                {{--@endforeach--}}
              {{--@foreach($sections as $section )--}}

                {{--<tr>--}}
                  {{--<td>{{$section->id}}</td>--}}

                  {{--<td>{{$section->sectionName}}</td>--}}
                  {{--<td>{{$section->section_hod}}</td>--}}
                  {{--<td>{{$section->section_email}}</td>--}}
                  {{--<td>Rs. {{$section->budget->amount}}</td>--}}
                  {{--<td>Sample data</td>--}}
                  {{--<td> <button class="btn btn-primary btn-xs" href="{{route('budget.create',$section->id)}}">Create</button> </td>--}}
                  {{--<td><a href="{{route('budget.create',$section->id)}}" class="btn btn-primary btn-xs" > Create | {{$section->id}}</a></td>--}}
                  {{--<td><a href="{{route('budget.edit',$section->id)}}" class="btn btn-primary btn-xs" > Edit | {{$section->id}}</a></td>--}}
                  {{--impliment edit here--}}

                {{--</tr>--}}
              {{--@endforeach--}}

              {{--</tbody>--}}
            {{--</table>--}}
          {{--</div>--}}



      {{--</div>--}}
    {{--</div>--}}
  {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}


@extends('layouts.app')

@section('content-title', 'Sections')

@section('content')

  <div class="row">

    @foreach($sections as $section)

      <div class="col-md-12 ">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Section Name : {!! $section->sectionName !!}</h4>
          </div>
          <div class="card-body">

            <ul>
              @foreach($section->trainees as $trainee)
                <li>
                  Full name: {!! $trainee->full_name !!}
                </li>

                <li>
                  Mobile: {!! $trainee->mobile !!}
                </li>
              @endforeach
            </ul>

          </div>
        </div>
      </div>

    @endforeach

  </div>

@endsection




