@extends('home')


@section('title', 'TIMS | Create Foreign Training Program')

@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">New Foreign Training Program</p>
            <a href="{{route('foreign.index')}}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            @include('layouts._alert')
            <div class="col-md-10 col-md-offset-1">

                <form method="POST" action="{{route('foreign.store')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="ForeignProgram" name="program_type">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                                <label for="program_title" class="required">Program Title</label>
                                <input type="text" class="form-control" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title" required>
                                @if ($errors->has('program_title'))
                                    <span class="help-block">{{ $errors->first('program_title') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="program_type" class="required">Program Type</label>
                                <select name="program_type" id="program_type" class="form-control">
                                    <option value="ForeignProgram" {{ (old("program_type") == 'ForeignProgram' ? "selected":"") }}>Foreign Program</option>
                                    <option value="FieldVisit" {{ (old("program_type") == 'FieldVisit' ? "selected":"") }}>Field Visit</option>
                                    <option value="MastersDegreeProgram" {{ (old("program_type") == 'MastersDegreeProgram' ? "selected":"") }}>Masters Degree Program</option>
                                </select>
                                @if ($errors->has('program_type'))
                                    <span class="help-block">{{ $errors->first('program_type') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('organised_by_id') ? 'has-error' : ''}}">
                                <label for="organised_by_id" class="required">Organised By</label>
                                <input type="text" value="{{old('organised_by_id')}}" class="form-control" name="organised_by_id" id="organised_by_id" placeholder="Program organiser" list="orgs" required>
                                <datalist id="orgs">
                                    @foreach($orgs as $org)
                                        <option value="{{\ucwords($org->name)}}"></option>
                                    @endforeach
                                </datalist>
                                @if ($errors->has('organised_by_id'))
                                    <span class="help-block">{{ $errors->first('organised_by_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group has-feedback {{$errors->has('notified_by') ? 'has-error' : ''}}">
                                <label for="notified_by" class="required">Notified By</label>
                                <input type="text" value="{{old('notified_by')}}" name="notified_by" class="form-control {{ $errors->has('notified_by') ? 'has-error' : '' }}" id="notified_by" placeholder="Notified By" required>
                                @if ($errors->has('notified_by'))
                                    <span class="help-block">{{ $errors->first('notified_by') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('notified_on') ? 'has-error' : ''}}">
                                <label for="notified_on" class="required">Notified On</label>
                                <input type="date" value="{{old('notified_on')}}" class="form-control {{ $errors->has('notified_on') ? 'has-error' : '' }}" id="notified_on" name="notified_on" placeholder="" required>
                                @if ($errors->has('notified_on'))
                                    <span class="help-block">{{ $errors->first('notified_on') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                                <label for="target_group" class="required">Target Group</label>
                                <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control {{ $errors->has('target_group') ? 'has-error' : '' }}" id="target_group" placeholder="Target Group" required>
                                @if ($errors->has('target_group'))
                                    <span class="help-block">{{ $errors->first('target_group') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                                <label for="venue" class="required">Venue</label>
                                <input type="text" value="{{old('venue')}}" class="form-control" id="venue" name="venue" placeholder="Venue" required>
                                @if ($errors->has('venue'))
                                    <span class="help-block">{{ $errors->first('venue') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('employment_nature') ? 'has-error' : ''}}">
                                <div>
                                    <label for="nature_of_the_employment" class="required margin-bottom-sm">Nature of the Employment</label>
                                </div>
                                <div class="inline margin-right-md">
                                    <input type="checkbox" id="employment_permanent" name="employment_nature[]" class="styled-checkbox" value="permanent" name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('permanent', old('employment_nature'))) ? ' checked' : '' }}>
                                    <label for="employment_permanent">Permanent</label>
                                </div>
                                <div class="inline margin-right-md">
                                    <input type="checkbox" id="employment_permanent_and_confirm" class="styled-checkbox" value="Permanent and Confirm" name="employment_nature[]" {{ (is_array(old('employment_nature')) and in_array('Permanent and Confirm', old('employment_nature'))) ? ' checked' : '' }}>
                                    <label for="employment_permanent_and_confirm">Permanent and Confirm</label>
                                </div>
                                @if ($errors->has('employment_nature'))
                                    <span class="help-block">{{ $errors->first('employment_nature') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('employee_category') ? 'has-error' : ''}}">
                                <div>
                                    <label class="required margin-bottom-sm">Employee Category</label>
                                </div>
                                <div class="inline margin-right-md">
                                    <input type="checkbox" id="employee_category_tech" class="styled-checkbox" value="technical" name="employee_category[]" {{ (is_array(old('employee_category')) and in_array('technical', old('employee_category'))) ? ' checked' : '' }}>
                                    <label for="employee_category_tech" >Technical</label>
                                </div>
                                <div class="inline">
                                    <input type="checkbox" id="employee_category_nontech" class="styled-checkbox" value="non-technical" name="employee_category[]" {{ (is_array(old('employee_category')) and in_array('non-technical', old('employee_category'))) ? ' checked' : '' }}>
                                    <label for="employee_category_nontech" class="">Non-Technical</label>
                                </div>
                                @if ($errors->has('employee_category'))
                                    <span class="help-block">{{ $errors->first('employee_category') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                                <label for="start_date" class="required">Start Date</label>
                                <input type="date" value="{{old('start_date')}}" class="form-control {{ $errors->has('start_date') ? 'has-error' : '' }}" id="start_date" name="start_date" required>
                                @if ($errors->has('start_date'))
                                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('end_date') ? 'has-error' : ''}}">
                                <label for="end_date" class="">End Date</label>
                                <input type="date" value="{{old('end_date')}}" class="form-control {{ $errors->has('end_date') ? 'has-error' : '' }}" id="end_date" name="end_date">
                                @if ($errors->has('end_date'))
                                    <span class="help-block">{{ $errors->first('end_date') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                                <label for="application_closing_date" class="required">Application Closing Date</label>
                                <input type="date" value="{{old('application_closing_date')}}" class="form-control {{ $errors->has('application_closing_date') ? 'has-error' : '' }}" id="application_closing_date" name="application_closing_date" placeholder="" required>
                                @if ($errors->has('application_closing_date'))
                                    <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                                <label for="application_closing_time" class="required">Closing Time (24hr)</label>
                                <input type="time" value="{{old('application_closing_time')}}" class="form-control {{ $errors->has('application_closing_time') ? 'has-error' : '' }}" id="application_closing_time" name="application_closing_time" placeholder="" required>
                                @if ($errors->has('application_closing_time'))
                                    <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('currency') ? 'has-error' : ''}}">
                                <label for="currency" class="">Currency</label>
                                <select type="text" value="" class="form-control {{ $errors->has('currency') ? 'has-error' : '' }}" id="currency" name="currency">
                                    <option value="lkr" {{ (old("currency") == 'lkr' ? "selected":"") }}>LKR</option>
                                    <option value="gbp" {{ (old("currency") == 'gbp' ? "selected":"") }}>GBP</option>
                                    <option value="usd" {{ (old("currency") == 'usd' ? "selected":"") }}>USD</option>
                                    <option value="euro" {{ (old("currency") == 'euro' ? "selected":"") }}>EURO</option>
                                </select>
                                @if ($errors->has('currency'))
                                    <span class="help-block">{{ $errors->first('currency') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('program_fee') ? 'has-error' : ''}}">
                                <label for="program_fee" class="">Program Fee</label>
                                <input type="number" value="{{old('program_fee')}}" class="form-control {{ $errors->has('program_fee') ? 'has-error' : '' }}" id="program_fee" name="program_fee" placeholder="Program Fee">
                                @if ($errors->has('program_fee'))
                                    <span class="help-block">{{ $errors->first('program_fee') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group has-feedback {{$errors->has('cost1') ? 'has-error' : ''}}">
                                <label for="cost1">Cost Name</label>
                                <input type="text" class="form-control" name="cost1" value="{{old('cost1')}}" placeholder="Cost Name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('cost_value1') ? 'has-error' : ''}}">
                                <label for="cost_value1">Value (Rs)</label>
                                <input type="number" class="form-control" name="cost_value1" value="{{old('cost_value1')}}" placeholder="Value ">
                            </div>
                        </div>
                        <div id="other-cost-container-parent">
                            @if(old('cost2') != null)
                                @for($i = 2; $i <= 16; $i++)
                                    @if(old('cost'.$i) != null)
                                        <div class="col-md-8">
                                            <div class="form-group has-feedback {{$errors->has('cost'.$i) ? 'has-error' : ''}}">
                                                <input type="text" class="form-control" name="{{'cost'.$i}}" value="{{old('cost'.$i)}}" placeholder="Cost Name {{$i}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback {{$errors->has('cost_value'.$i) ? 'has-error' : ''}}">
                                                <input type="number" class="form-control" name="cost_value{{$i}}" value="{{old('cost_value'.$i)}}" placeholder="Value">
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            @endif
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-default pull-right margin-left-sm" id="remove-cost"><i class="glyphicon glyphicon-remove-circle"></i></button>
                            <button class="btn btn-primary pull-right" id="add-cost"><i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
                                <label for="program_brochure">Program Brochure</label>
                                <input type="file" class="form-control-file" name="program_brochure" id="program_brochure" name="program_brochure">
                                @if ($errors->has('program_brochure'))
                                    <span class="help-block">{{ $errors->first('program_brochure') }}</span>
                                @endif
                                <small id="programBrochureHelpBlock" class="form-text text-muted">
                                    Only JPEG are allowed. Max size 1999KB.
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        window.onload = function() {

            cCounter = 2;
            $("#add-cost").click(function (event) {
                event.preventDefault();

                if(cCounter>16){
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div')).attr("id", 'other-cost-container' + cCounter);

                newTextBoxDiv.after().html('<div class="col-md-8"><div class="form-group"><input type="text" class="form-control" name="cost'+cCounter+'" placeholder="Cost Name"></div></div><div class="col-md-4"><div class="form-group has-feedback"><input type="number" class="form-control" name="cost_value'+cCounter+'" placeholder="Value "></div></div>');

                newTextBoxDiv.appendTo("#other-cost-container-parent");

                cCounter++;

            });

            $("#remove-cost").click(function (event) {
                event.preventDefault();
                if(cCounter==2){
                    return false;
                }

                cCounter--;

                $("#other-cost-container" + cCounter).remove();

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

@endsection