@extends('layouts.app')

@section('content-title', 'Trainees')

@section('content')
    <div class="row">
        <div class="col-md-12 filters">
            <div class="card">
                <div class="card-header">
{{--                    <h4 class="card-title">Filters</h4>--}}
                </div>
                <div class="card-body  p-4">
                    @include('_alert')
                    <form>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 search-results">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Results</h4>
                </div>
                <div class="card-body  p-4">
                    @include('_alert')
                    <form>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body  p-4">
                    @include('_alert')

                </div>
            </div>
        </div>
    </div>
@endsection
