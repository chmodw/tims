@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Upload Template</p>
            <a class="btn btn-default pull-right" style="margin-right:8px;" href="{{url('templatemanager')}}"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>&nbsp;Back</a>
        </div>
        <div class="panel-body">

            <form method="POST" class="" action="{{route('templatemanager.update', $template_edit->id)}}" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('program_type') ? 'has-error' : ''}}">
                            <label for="program_type" class="required">Program Type</label>
                            <select id="program_type" name="program_type" class="form-control">
                                <option value="local_program" {{ (old("program_type", $template_edit->program_type) == 'local_program' ? "Local Program":"") }}>Local Program</option>
                                <option value="foreign_program" {{ (old("program_type", $template_edit->program_type) == 'Foreign Program' ? "selected":"") }}>Foreign Program</option>
                                <option value="inhouse_program" {{ (old("program_type", $template_edit->program_type) == 'In-House Program' ? "selected":"") }}>In-House Program</option>
                                <option value="postgrad_program" {{ (old("program_type", $template_edit->program_type) == 'Post-Graduation Program' ? "selected":"") }}>Post-Graduation Program</option>
                            </select>
                            @if ($errors->has('program_type'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('template_name') ? 'has-error' : ''}}">
                            <label for="template_name" class="required">Template Name</label>
                            <input type="text" id="template_name" class="form-control" value="{{old('template_name', $template_edit->name)}}" name="template_name" placeholder="Name" required>
                            @if ($errors->has('template_name'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('template_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('template') ? 'has-error' : ''}}">
                            <label for="template">Template</label>
                            <input type="file" name="template" id="template" class="" value="Browse" accept=".docx">
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
                            <input type="submit" name="submit" value="Save" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection