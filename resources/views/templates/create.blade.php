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
                                <option value="local_program" {{ (old("program_type") == 'local_program' ? "selected":"") }}>Local Program</option>
                                <option value="foreign_program" {{ (old("program_type") == 'foreign_program' ? "selected":"") }}>Foreign Program</option>
                                <option value="inhouse_program" {{ (old("program_type") == 'inhouse_program' ? "selected":"") }}>In-House Program</option>
                                <option value="postgrad_program" {{ (old("program_type") == 'postgrad_program' ? "selected":"") }}>Post-Graduation Program</option>
                            </select>
                            @if ($errors->has('program_type'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_type') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <div class="form-group has-feedback {{$errors->has('template_name') ? 'has-error' : ''}}">
                            <label for="template_name">Template Name</label>
                            <input type="text" id="template_name" class="form-control" value="{{old('template_name')}}" name="template_name" placeholder="Name" required>
                            @if ($errors->has('template_name'))
                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('template_name') }}</span>
                            @endif
                        </div>
                    </div>

{{--                    <div class="col-md-8 col-md-offset-2">--}}
{{--                        <div class="form-group has-feedback {{$errors->has('has_table') ? 'has-error' : ''}}">--}}
{{--                            <label for="has_table">Template Has a Table</label><br>--}}

{{--                            <input type="radio" name="has_table" value="true" {{(old('has_table') == true) ? 'checked' : ''}}> Yes--}}
{{--                            <input type="radio" name="has_table" class="margin-left-md" value="false" {{(old('has_table') == true) ? 'false' : ''}}> No--}}
{{--                            @if ($errors->has('has_table'))--}}
{{--                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('has_table') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-8 col-md-offset-2">--}}
{{--                        <div class="form-group has-feedback {{$errors->has('column_count') ? 'has-error' : ''}}">--}}
{{--                            <label for="column_count">Number of Columns</label>--}}
{{--                            <input type="number" id="column_count" class="form-control" value="{{old('column_count')}}" name="column_count" placeholder="Number of Columns" disabled>--}}
{{--                            @if ($errors->has('column_count'))--}}
{{--                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('column_count') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-md-8 col-md-offset-2">--}}
{{--                        <div class="form-group has-feedback {{$errors->has('column_names') ? 'has-error' : ''}}">--}}
{{--                            <label for="column_names">Default Column Names</label>--}}
{{--                            <textarea class="form-control" name="column_names" id="column_names" disabled placeholder="Column Names" style="max-width: 100%;width: 100%;min-width: 100%"></textarea>--}}
{{--                            <small>Seperate each column name with a Comma</small>--}}
{{--                            @if ($errors->has('column_names'))--}}
{{--                                <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('column_names') }}</span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

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

{{--    <script>--}}
{{--        window.onload = function() {--}}
{{--            //--}}
{{--            // $("#column_count").on('input',function(e){--}}
{{--            //--}}
{{--            //     var numberOfFields = $('#column_count').val();--}}
{{--            //--}}
{{--            //     $('.extra-colf').remove();--}}
{{--            //--}}
{{--            //     for(var i = 0; numberOfFields > i; i++){--}}
{{--            //         $("#column-name-fields").append('' +--}}
{{--            //             '<input type="text" id="" class="form-control extra-colf margin-top-md" value="" name="column_names[]" placeholder="Name of the Column ' + (i+1) +'" required>'--}}
{{--            //         );--}}
{{--            //     }--}}
{{--            //--}}
{{--            // });--}}

{{--            $('input[type=radio][name=has_table]').change(function() {--}}
{{--                if (this.value === 'false') {--}}
{{--                    $('input[type=number][name=column_count]').prop("disabled", true);--}}
{{--                    $('input[type=number][name=column_count]').prop("required", false);--}}

{{--                    $('#column_names').prop("disabled", true);--}}
{{--                    $('#column_names').prop("required", false);--}}
{{--                }--}}
{{--                else if (this.value === 'true') {--}}
{{--                    $('input[type=number][name=column_count]').prop("disabled", false);--}}
{{--                    $('input[type=number][name=column_count]').prop("required", true);--}}

{{--                    $('#column_names').prop("disabled", false);--}}
{{--                    $('#column_names').prop("required", true);--}}
{{--                }--}}
{{--            });--}}

{{--        };--}}
{{--    </script>--}}
@endsection