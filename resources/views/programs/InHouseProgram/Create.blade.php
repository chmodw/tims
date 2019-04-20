@extends('home')

@section('content_header')
    <h1 class="inline">New In House Program</h1>
    <a href="{{url('programs/InHousePrograms')}}" class="btn btn-default pull-right">Back</a>
@stop

@section('title', 'TIMS | Create In-House Program')

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
            <form method="POST" action="{{ route('inhouse.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="LocalProgram" name="program_type">





                <div class="col-md-12">
                    <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                        <label for="program_title" class="required">Program Title</label>
                        <input type="text" class="form-control" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title">
                        @if ($errors->has('program_title'))
                            <span class="help-block">{{ $errors->first('program_title') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                        <label for="target_group" class="required">Target Group</label>
                        <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group">
                        @if ($errors->has('target_group'))
                            <span class="help-block">{{ $errors->first('target_group') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group has-feedback {{$errors->has('employment_nature') ? 'has-error' : ''}}">
                        <div>
                            <label for="nature_of_the_employment" class="required">Employment</label>
                        </div>
                        <div class="inline margin-right-md">
                            <input type="checkbox" id="employment_permanent" class="styled-checkbox" value="permanent" name="employment_nature[]">
                            <label for="employment_permanent">Permanent</label>
                        </div>
                        <div class="inline margin-right-md">
                            <input type="checkbox" id="employment_fixed_contract" class="styled-checkbox" value="fixed contract" name="employment_nature[]">
                            <label for="employment_fixed_contract">Fixed Contract</label>
                        </div>
                        <div class="inline margin-right-md">
                            <input type="checkbox" id="employment_job_contract" class="styled-checkbox" value="job contract" name="employment_nature[]">
                            <label for="employment_job_contract">Job Contract</label>
                        </div>
                        @if ($errors->has('employment_nature'))
                            <span class="help-block">{{ $errors->first('employment_nature') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('employee_category') ? 'has-error' : ''}}">
                        <div>
                            <label class="required">Employee Category</label>
                        </div>
                        <div class="inline margin-right-md">
                            <input type="checkbox" id="employee_category_tech" class="styled-checkbox" value="technical" name="employee_category[]">
                            <label for="employee_category_tech" >Technical</label>
                        </div>
                        <div class="inline">
                            <input type="checkbox" id="employee_category_nontech" class="styled-checkbox" value="non-technical" name="employee_category[]">
                            <label for="employee_category_nontech" class="">Non-Technical</label>
                        </div>
                        @if ($errors->has('employee_category'))
                            <span class="help-block">{{ $errors->first('employee_category') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('organised_by') ? 'has-error' : ''}}">
                        <label for="organised_by" class="required">Organised By</label>
                        <input type="text" value="{{old('organised_by')}}" class="form-control" name="organised_by_id" id="organised_by" placeholder="Program organiser" list="orgs">
                        <datalist id="orgs">
                            @foreach($orgs as $org)
                                <option value="{{$org->organisation_id}}">{{$org->name}}</option>
                            @endforeach
                        </datalist>
                        @if ($errors->has('organised_by'))
                            <span class="help-block">{{ $errors->first('organised_by') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                        <label for="venue" class="required">Venue</label>
                        <input type="text" value="{{old('venue')}}" class="form-control" id="venue" name="venue">
                        @if ($errors->has('venue'))
                            <span class="help-block">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>
                </div>

                <div class="col-md-4">
                    <div  id="resource-person-name" class="form-group has-feedback {{$errors->has('resource_person') ? 'has-error' : ''}}">
                        <label for="resource_person" class="required">Resource Person</label>
                        <input type="text" name="resource_person_1[]" value="{{old('resource_person_1')[0]}}" placeholder="Resource Person Name" class="form-control" required/>
                    </div>
                </div>

                <div class="col-md-5">
                    <div id="resource-person-designation" class="form-group has-feedback {{$errors->has('resource_person') ? 'has-error' : ''}}">
                        <label for="resource_person" class="required">Resource Person</label>
                        <input type="text" name="resource_person_1[]" value="{{old('resource_person_1')[1]}}" placeholder="Resource Person Designation" class="form-control" required/>
                    </div>
                </div>

                <div class="col-md-2" id="resource-person-cost">
                    <div class="form-group has-feedback {{$errors->has('resource_person') ? 'has-error' : ''}}">
                        <label for="resource_person" class="">Fee (Rs)</label>
                        <input type="number" name="resource_person_1[]" value="{{old('resource_person_1')[1]}}" placeholder="Cost" class="form-control"/>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group has-feedback {{$errors->has('resource_person') ? 'has-error' : ''}}">
                        <div class="margin-top-lg padding-top-sm">
                            <button type="button" name="add" id="add" class="btn btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                        <label for="start_date" class="required">Start Date</label>
                        <input type="date" value="{{old('start_date')}}" class="form-control" id="start_date" name="start_date">
                        @if ($errors->has('start_date'))
                            <span class="help-block">{{ $errors->first('start_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group has-feedback {{$errors->has('start_time') ? 'has-error' : ''}}">
                        <label for="start_time">Start Time</label>
                        <input type="time" value="{{old('start_time')}}" class="form-control" id="start_time" name="start_time">
                        @if ($errors->has('start_time'))
                            <span class="help-block">{{ $errors->first('start_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group has-feedback {{$errors->has('end_time') ? 'has-error' : ''}}">
                        <label for="end_time">End Time</label>
                        <input type="time" value="{{old('end_time')}}" class="form-control" id="end_time" name="end_time">
                        @if ($errors->has('end_time'))
                            <span class="help-block">{{ $errors->first('end_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                        <label for="application_closing_date" class="required">Application Closing Date</label>
                        <input type="date" value="{{old('application_closing_date')}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="">
                        @if ($errors->has('application_closing_date'))
                            <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                        <label for="application_closing_time" class="required">Closing Time</label>
                        <input type="time" value="{{old('application_closing_time')}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="">
                        @if ($errors->has('application_closing_time'))
                            <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('per_person_cost') ? 'has-error' : ''}}">
                        <label for="per_person_cost">Per Person Fee (Rs)</label>
                        <input type="number" value="{{old('per_person_cost')}}" class="form-control" id="per_person_cost" name="per_person_cost">
                        @if ($errors->has('per_person_cost'))
                            <span class="help-block">{{ $errors->first('per_person_cost') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group has-feedback {{$errors->has('no_show_cost') ? 'has-error' : ''}}">
                        <label for="no_show_cost">No-Show Fee (Rs)</label>
                        <input type="number" value="{{old('no_show_cost')}}" class="form-control" id="no_show_cost" name="registration_cost">
                        @if ($errors->has('no_show_cost'))
                            <span class="help-block">{{ $errors->first('no_show_cost') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-7">
                        <div class="form-group has-feedback {{$errors->has('other_costs') ? 'has-error' : ''}}" id="other_costs_name">
                            <label for="other_costs">Other Costs</label>
                            <input type="text" value="{{old('other_costs')}}" class="form-control" id="other_costs" name="other_costs_1[]">
                            @if ($errors->has('other_costs'))
                                <span class="help-block">{{ $errors->first('other_costs') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group has-feedback {{$errors->has('other_costs') ? 'has-error' : ''}}" id="other_costs_value">
                            <label for="other_costs">Cost (Rs)</label>
                            <input type="number" value="{{old('other_costs')}}" class="form-control" id="other_costs" name="other_costs_1[]">
                            @if ($errors->has('other_costs'))
                                <span class="help-block">{{ $errors->first('other_costs') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group has-feedback {{$errors->has('other_costs') ? 'has-error' : ''}}">
                            <div class="margin-top-lg padding-top-sm">
                                <button type="button" name="" id="more_other_cost" class="btn btn-success btn-xs">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
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
                    <button type="reset" name="reset" class="btn btn-default mb-2 mr-2 pull-right" value="" style="margin-right: 15px;">Clear</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = function() {

            var i=1;
            var i2=1;

            $('#add').click(function(){
                i++;
                $('#resource-person-name').append('<input type="text" name="resource_person_'+i+'[]" placeholder="Resource Person Name"  class="form-control margin-top-sm" required value=""/>');
                $('#resource-person-designation').append('<input type="text" name="resource_person_'+i+'[]" placeholder="Resource Person Designation"  class="form-control margin-top-sm" required value=""/>');
                $('#resource-person-cost').append('<input type="number" name="resource_person_'+i+'[]" placeholder="Cost"  class="form-control margin-top-sm" required value=""/>');
            });

            $('#more_other_cost').click(function(){
                $('#other_costs_name').append('<input type="text" name="other_costs_'+i2+'[]" placeholder="Other Cost Name"  class="form-control margin-top-sm" required value=""/>');
                $('#other_costs_value').append('<input type="text" name="other_costs_'+i2+'[]" placeholder="Other Cost Value"  class="form-control margin-top-sm" required value=""/>');
            });

            $(document).on('click', '.btn_remove', function(){
                var button_id = $(this).attr("id");
                $('#row'+button_id+'').remove();
            });

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