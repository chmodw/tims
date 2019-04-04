@extends('layouts.main')

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
  </ul>
@endsection
