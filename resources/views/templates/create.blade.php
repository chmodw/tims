@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Upload Template</p>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('templatemanager')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Back</a>
        </div>
        <div class="panel-body">

            <form method="POST" class="" action="{{route('templatemanager.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('program_type') ? 'has-error' : ''}}">
                            <label for="program_type">Program Type</label>
                            <select id="program_type" name="program_type" class="form-control">
                                <option value="local_program">Local Program</option>
                                <option value="foreign_program">Foreign Program</option>
                                <option value="inhouse_program">In-House Program</option>
                                <option value="postgrad_program">Post-Graduation Program</option>
                            </select>
                            @if ($errors->has('program_type'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('template_name') ? 'has-error' : ''}}">
                            <label for="template_name">Template Name</label>
                            <input type="text" id="template_name" class="form-control" name="template_name" placeholder="Name" required>
                            @if ($errors->has('template_name'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('template_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('template') ? 'has-error' : ''}}">
                            <label for="template">Template</label>
                            <input type="file" name="template" id="template" class="" value="Browse" accept=".docx" required>
                            <small id="program_brochureHelpBlock" class="form-text text-muted">
                                Only DOCX are allowed.
                            </small>
                            @if ($errors->has('template'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('template') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group pull-right" style="min-height: 74px;">
                            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection