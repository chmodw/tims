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
                                    Birthday: {!! $trainee->birthday !!}

                                </li>

                            @endforeach

                        </ul>

                    </div>
                </div>
            </div>

        @endforeach

    </div>

@endsection



