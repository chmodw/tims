@extends('light-bootstrap-dashboard::layouts.main')

@section('sidebar-menu')
  <ul class="nav">

    @if(\Request::is('programs') || \Request::is('programs/*'))
      <li class="{{ \Request::is('programs/local') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('programs/local') }}">
          <i class="fa fa-location-arrow"></i>
          <p>Local</p>
        </a>
      </li>
      <li class="{{ \Request::is('programs/foreign') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('programs/foreign') }}">
          <i class="fa fa-globe"></i>
          <p>Foreign</p>
        </a>
      </li>
      <li class="{{ \Request::is('programs/inhouse') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('programs/inhouse') }}">
          <i class="pe-7s-home"></i>
          <p>In-house</p>
        </a>
      </li>
      <li class="{{ \Request::is('programs/postgrad') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('programs/postgrad') }}">
          <i class="fa fa-graduation-cap"></i>
          <p>post-grad</p>
        </a>
      </li>
    @endif

      {{--Budget SideBar--}}

      @if(\Request::is('budget') || \Request::is('budget/*'))

        <li><a class="nav-link" href="{!! url('budget/create') !!}"><i class="fa fa-location-arrow"></i> Allocate Budget </a></li>
        <li><a class="nav-link" href="{!! url('budget/edit') !!}"><i class="fa fa-location-arrow"></i> Edit Budget </a></li>




      @endif

    {{--Section--}}

      @if(\Request::is('section') || \Request::is('section/*'))
        <li><a class="nav-link" href="{!! url('section/create') !!}"><i class="fa fa-location-arrow"></i> Create a new section </a></li>
        {{--<li><a class="nav-link" href="{!! url('section/edit') !!}"><i class="fa fa-location-arrow"></i> Edit section information </a></li>--}}



      @endif
{{--Trainee--}}


      @if(\Request::is('trainee') || \Request::is('trainees/*'))

        <li><a class="nav-link" href="{!! url('trainee/create') !!}"><i class="fa fa-location-arrow"></i> Add trainee </a></li>
        <li><a class="nav-link" href="{!! url('trainee/edit') !!}"><i class="fa fa-location-arrow"></i> Edit trainee </a></li>
        <li><a class="nav-link" href="{!! url('#') !!}"><i class="fa fa-location-arrow"></i> Allocate to unit </a></li>
        <li><a class="nav-link" href="{!! url('#') !!}"><i class="fa fa-location-arrow"></i> Edit allocation </a></li>

      @endif



  </ul>
@endsection
