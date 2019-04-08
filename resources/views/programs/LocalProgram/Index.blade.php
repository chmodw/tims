@extends('lap::layouts.auth')

@section('title', 'Local Programs')
@section('child-content')
    <div class="row mb-3">
        <div class="col-md">
            <h2 class="mb-0">@yield('title')</h2>
        </div>
        <div class="col-md-auto mt-2 mt-md-0">
{{--            CHANGE TO CREATE PROGRAMS--}}
            @can('Create Users')
                <a href="{{ route('programs.create', 'LocalProgram') }}" class="btn btn-primary">New Program</a>
            @endcan
        </div>
    </div>

@endsection

@push('scripts')

@endpush