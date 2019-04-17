@extends('home')

@section('content_header')
    <h1 class="inline">New Post Graduation Program</h1>
    <a href="{{url('programs/LocalPrograms')}}" class="btn btn-default pull-right">Back</a>
@stop

@section('title', 'TIMS | Create Post Graduation Program')

@section('main-content')

    <style>
        label.required::after{
            content:"*";
            color:red;
            margin-left: 3px;
        }
    </style>

    <div class="panel panel-default">
        @include('layouts._alert')
        <div class="panel-body">
            <form method="POST" action="{{ route('programs.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="PostGradProgram" name="program_type">
                <div class="col-md-12">
                    <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                        <label for="program_title" class="required">Program Title</label>
                        <input type="text" class="form-control" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title">
                        @if ($errors->has('program_title'))
                            <span class="help-block">{{ $errors->first('program_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('organised_by') ? 'has-error' : ''}}">
                        <label for="organised_by" class="required">Institute</label>
                        <input type="text" value="{{old('organised_by')}}" class="form-control" name="organised_by_id" id="organised_by" placeholder="Institute">
                        @if ($errors->has('organised_by'))
                            <span class="help-block">{{ $errors->first('organised_by') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('department') ? 'has-error' : ''}}">
                        <label for="department" class="required">Department</label>
                        <input type="text" value="{{old('department')}}" name="department" class="form-control" id="department" placeholder="Department">
                        @if ($errors->has('department'))
                            <span class="help-block">{{ $errors->first('department') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('programs') ? 'has-error' : ''}}">
                        <label for="content" class="required">Programs</label>
                        <textarea class="form-control" style="height: 175px; min-height: 175px; max-height: 175px; max-width: 498.5px" name="content" id="programs" placeholder="Available Programs">{{old('programs')}}</textarea>
                        @if ($errors->has('programs'))
                            <span class="help-block">{{ $errors->first('programs') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('requirements') ? 'has-error' : ''}}">
                        <label for="content" class="required">Requirements</label>
                        <textarea class="form-control" style="height: 175px; min-height: 175px; max-height: 175px; max-width: 498.5px" name="content" id="requirements" placeholder="Requirements">{{old('requirements')}}</textarea>
                        @if ($errors->has('requirements'))
                            <span class="help-block">{{ $errors->first('requirements') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                        <label for="application_closing_date" class="required">Application Closing Date</label>
                        <input type="date" value="{{old('application_closing_date')}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="">
                        @if ($errors->has('application_closing_date'))
                            <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                        <label for="application_closing_time" class="required">Closing Time</label>
                        <input type="time" value="{{old('application_closing_time')}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="">
                        @if ($errors->has('application_closing_time'))
                            <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group has-feedback {{$errors->has('registration_fees') ? 'has-error' : ''}}">
                        <label for="registration_fees" class="required">Registration Fees (Rs)</label>
                        <input type="number" value="{{old('registration_fees')}}" class="form-control" id="registration_fees" name="registration_fees" placeholder="Registration Fees">
                        @if ($errors->has('registration_fees'))
                            <span class="help-block">{{ $errors->first('registration_fees') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('year_one') ? 'has-error' : ''}}">
                        <label for="year_one" class="required">1st Year</label>
                        <input type="number" value="{{old('year_one')}}" class="form-control" id="year_one" name="year_one" placeholder="First Year">
                        @if ($errors->has('year_one'))
                            <span class="help-block">{{ $errors->first('year_one') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('year_two') ? 'has-error' : ''}}">
                        <label for="year_two" class="required">2nd Year</label>
                        <input type="number" value="{{old('year_two')}}" class="form-control" id="year_two" name="year_two" placeholder="Second Year">
                        @if ($errors->has('year_two'))
                            <span class="help-block">{{ $errors->first('year_two') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('year_three') ? 'has-error' : ''}}">
                        <label for="year_three">3rd Year</label>
                        <input type="number" value="{{old('year_three')}}" class="form-control" id="year_three" name="year_three" placeholder="Third Year">
                        @if ($errors->has('year_three'))
                            <span class="help-block">{{ $errors->first('year_three') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('year_four') ? 'has-error' : ''}}">
                        <label for="year_four">4th Year</label>
                        <input type="number" value="{{old('year_four')}}" class="form-control" id="year_four" name="year_four" placeholder="Fourth Year">
                        @if ($errors->has('year_four'))
                            <span class="help-block">{{ $errors->first('year_four') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
                        <label for="program_brochure">Program Brochure</label>
                        <input type="file" class="form-control-file"  id="program_brochure" name="program_brochure" class="form-control" name="program_brochure">
                        @if ($errors->has('program_brochure'))
                            <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_brochure') }}</span>
                        @endif
                        <small id="program_brochureHelpBlock" class="form-text text-muted">
                            Only DOC,PDF,DOCX,JPG,JPEG and PNG are allowed. Max size 4999KB.
                        </small>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
{{--                    <button type="submit" name="_submit" class="btn btn-primary mb-2 pull-right" style="margin-right: 15px;" value="redirect">Save &amp; Go Back</button>--}}
                    <button type="reset" name="reset" class="btn btn-default mb-2 mr-2 pull-right" value="" style="margin-right: 15px;">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {

            $(function() {
                $('#is_long_term').click(function() {
                    if ($("#is_long_term").prop('checked') == true) {
                        $('#durationHelpBlock').text('Months');
                        $('#duration').attr("placeholder", "Number of Months");
                    } else if ($("#is_long_term").prop('checked') == false) {
                        $('#durationHelpBlock').text('Days');
                        $('#duration').attr("placeholder", "Number of Days");
                    }
                });
            });

            $(function(){
                $("input").focus(function() {
                    if($(this).parent().hasClass('has-error') || $(this).parent().parent().hasClass('has-error')){
                        $(this).parent().removeClass('has-error');
                        $(this).parent().parent().removeClass('has-error');
                        $(this).parent().find('span.help-block').detach();
                        $(this).parent().parent().find('span.help-block').detach();
                    }
                });
            });
        }
    </script>
@stop