@extends('home')
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
        <div class="panel-heading clearfix">
            <p class="" style="">Edit In House Program</p>
            <a href="{{route('inhouse.show', $program->program_id)}}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            @include('layouts._alert')
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="{{ route('inhouse.update', $program->program_id) }}" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <input type="hidden" value="InHouseProgram" name="program_type">

                    <div class="row">
                        <div class="agenda-container">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="topic" class="required">Program Agenda</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="topic" class="required">From</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="topic" class="required">To</label>
                                </div>
                            </div>

                            @foreach($program->agenda as $key => $agenda)
{{--                                {{$agenda['topic'].($key+1)}}--}}
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" placeholder="Topic" class="form-control" value="{{old('agenda'.($key+1), $agenda['topic'])}}" name="{{'agenda'.($key+1)}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="time" class="form-control" name="{{'agenda_from'.($key+1)}}" value="{{old('agenda_from'.($key+1), $agenda['from'])}}">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="time" class="form-control" name="{{'agenda_to'.($key+1)}}" value="{{old('agenda_to'.($key+1), $agenda['to'])}}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-default pull-right margin-left-sm" id="remove-agenda"><i class="glyphicon glyphicon-remove-circle"></i></button>
                            <button class="btn btn-primary pull-right" id="add-agenda"><i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                                <label for="target_group" class="required">Target Group</label>
                                <input type="text" value="{{old('target_group', $program->target_group)}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group" required>
                                @if ($errors->has('target_group'))
                                    <span class="help-block">{{ $errors->first('target_group') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @include('programs.partials.employeementselectsedit')
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('organised_by_id') ? 'has-error' : ''}}">
                                <label for="organised_by_id" class="required">Organised By</label>
                                <input type="text" value="{{old('organised_by_id', $program->organisation->name)}}" class="form-control" name="organised_by_id" id="organised_by_id" placeholder="Program organiser" list="orgs" required>
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
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('venue') ? 'has-error' : ''}}">
                                <label for="venue" class="required">Venue</label>
                                <input type="text" value="{{old('venue', $program->venue)}}" class="form-control" id="venue" placeholder="venue" name="venue" required>
                                @if ($errors->has('venue'))
                                    <span class="help-block">{{ $errors->first('venue') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @foreach($program->resource_person as $key=>$person)

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="resource_person_name{{$key+1}}" class="required">Resource Person {{$key+1}} Name</label>
                                    <input type="text" placeholder="Name" id="resource_person_name{{$key+1}}" class="form-control" value="{{old('resource_person_name'.($key+1), $person['name'])}}" name="resource_person_name1" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="resource_person_designation{{$key+1}}" class="required">Resource Person {{$key+1}} Designation</label>
                                    <input type="text" class="form-control" name="resource_person_designation1" value="{{old('resource_person_designation'.($key+1), $person['designation'])}}" placeholder="Designation" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="resource_person_cost{{$key+1}}" class="required">Resource Person {{$key+1}} Cost</label>
                                    <input type="number" class="form-control" name="resource_person_cost{{$key+1}}" value="{{old('resource_person_cost'.($key+1), $person['cost'])}}" placeholder="cost" required>
                                </div>
                            </div>

                        @endforeach


                    </div>
                    <div class="row">
                        <div id="resource-person-container">
                        </div>
                        @for($i = 2; $i <= 16; $i++)
                            @if(old('resource_person_name'.$i) != null)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="resource_person_name{{$i}}" class="required">Resource Person {{$i+1}} Name</label>
                                        <input type="text" id="resource_person_name{{$i}}" placeholder="Name" class="form-control" value="{{old('resource_person_name'.$i)}}" name="resource_person_name{{$i}}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="resource_person_designation{{$i}}" class="required">Resource Person {{$i+1}} Designation</label>
                                        <input type="text" class="form-control" id="resource_person_designation{{$i}}" name="resource_person_designation{{$i}}" value="{{old('resource_person_designation'.$i)}}" placeholder="Designation">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="resource_person_cost{{$i}}" class="required">Resource Person {{$i+1}} Cost</label>
                                        <input type="number" class="form-control" id="resource_person_cost{{$i}}" name="resource_person_cost{{$i}}" value="{{old('resource_person_cost'.$i)}}" placeholder="cost">
                                    </div>
                                </div>
                            @endif
                        @endfor
                        <div class="col-md-12">
                            <button class="btn btn-default pull-right margin-left-sm" id="remove-resource-person"><i class="glyphicon glyphicon-remove-circle"></i></button>
                            <button class="btn btn-primary pull-right" id="add-resource-person"><i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                                <label for="start_date" class="required">Start Date</label>
                                <input type="date" value="{{old('start_date', date('Y-m-d',strtotime($program->start_date)))}}" class="form-control" id="start_date" name="start_date" required>
                                @if ($errors->has('start_date'))
                                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('start_time') ? 'has-error' : ''}}">
                                <label for="start_time">Start Time</label>
                                <input type="time" value="{{old('start_time',date('H:i',strtotime($program->start_time)))}}" class="form-control" id="start_time" name="start_time">
                                @if ($errors->has('start_time'))
                                    <span class="help-block">{{ $errors->first('start_time') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('end_time') ? 'has-error' : ''}}">
                                <label for="end_time">End Time</label>
                                <input type="time" value="{{old('end_time', date('H:i',strtotime($program->end_time)))}}" class="form-control" id="end_time" name="end_time">
                                @if ($errors->has('end_time'))
                                    <span class="help-block">{{ $errors->first('end_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                                <label for="application_closing_date" class="required">Application Closing Date</label>
                                <input type="date" value="{{old('application_closing_date', date('Y-m-d',strtotime($program->application_closing_date_time)))}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="" required>
                                @if ($errors->has('application_closing_date'))
                                    <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                                <label for="application_closing_time" class="required">Closing Time</label>
                                <input type="time" value="{{old('application_closing_time', date('H:i',strtotime($program->application_closing_date_time)))}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="" required>
                                @if ($errors->has('application_closing_time'))
                                    <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('per_person_cost') ? 'has-error' : ''}}">
                                <label for="per_person_cost">Per Person Fee (Rs)</label>
                                <input type="number" value="{{old('per_person_cost', $program->per_person_fee)}}" class="form-control" id="per_person_cost" name="per_person_cost">
                                @if ($errors->has('per_person_cost'))
                                    <span class="help-block">{{ $errors->first('per_person_cost') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('no_show_cost') ? 'has-error' : ''}}">
                                <label for="no_show_cost">No-Show Fee (Rs)</label>
                                <input type="number" value="{{old('no_show_cost', $program->no_show_fee)}}" class="form-control" id="no_show_cost" name="no_show_cost">
                                @if ($errors->has('no_show_cost'))
                                    <span class="help-block">{{ $errors->first('no_show_cost') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-10">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="cost1">Cost Name</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="cost_value1">Value (Rs)</label>
                                    </div>
                                </div>
                            </div>
                            @foreach($program->other_costs as $key=>$cost)
                                <div class="col-md-10">
                                    <div class="col-md-5">
                                        <div class="form-group has-feedback {{$errors->has('cost'.($key+1)) ? 'has-error' : ''}}">
                                            <input type="text" class="form-control" name="cost{{$key+1}}" value="{{old('cost'.($key+1),$cost['name'])}}" placeholder="Cost Name">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group has-feedback {{$errors->has('cost_value'.($key+1)) ? 'has-error' : ''}}">
                                            <input type="number" class="form-control" name="cost_value{{$key+1}}" value="{{old('cost_value'.($key+1),$cost['value'])}}" placeholder="Value Per Person">
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            <div class="col-md-2">
                                <button class="btn btn-primary" id="add-cost"><i class="glyphicon glyphicon-plus"></i></button>
                                <button class="btn btn-default margin-left-sm" id="remove-cost"><i class="glyphicon glyphicon-remove-circle"></i></button>
                            </div>
                            <div id="other-cost-container-parent">

                            </div>
                            @if(old('cost2') != null)
                                @for($i = 2; $i <= 16; $i++)
                                    <div class="col-md-10">
                                        <div class="col-md-5">
                                            <div class="form-group has-feedback {{$errors->has('cost'.$i) ? 'has-error' : ''}}">
                                                <input type="text" class="form-control" name="{{'cost'.$i}}" value="{{old('cost'.$i)}}" placeholder="Cost Name {{$i}}">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group has-feedback {{$errors->has('cost_value'.$i) ? 'has-error' : ''}}">
                                                <input type="number" class="form-control" name="cost_value{{$i}}" value="{{old('cost_value'.$i)}}" placeholder="Value Per Person">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Current Program Brochure</label>
                            <img src="/storage/brochures/{{$program->brochure_url}}" class="img-thumbnail" alt="program brochure">
                        </div>
                        <div class="col-md-4">
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
                            <button type="reset" name="reset" class="btn btn-default mb-2 mr-2 pull-right" value="" style="margin-right: 15px;">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {

            var counter = 2;

            $("#add-agenda").click(function(event){
                event.preventDefault();

                if(counter>16){
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div')).attr("id", 'agenda-child-container' + counter);

                newTextBoxDiv.after().html(
                    '<div class="col-md-8"><div class="form-group"><input type="text" placeholder="Topic" class="form-control" value="{{old('agenda')}}" name="agenda'+counter+'" required></div></div><div class="col-md-2"><div class="form-group"><input type="time" class="form-control" name="agenda_from'+counter+'" value="{{old('agenda_from')}}" required></div></div><div class="col-md-2"><div class="form-group"><input type="time" class="form-control" name="agenda_to'+counter+'" value="{{old('agenda_to')}}" required></div></div>');

                newTextBoxDiv.appendTo(".agenda-container");

                counter++;
            });

            $("#remove-agenda").click(function (event) {
                event.preventDefault();
                if(counter==2){
                    return false;
                }

                counter--;

                $("#agenda-child-container" + counter).remove();

            });

            var rCounter = 2;

            $("#add-resource-person").click(function(event){
                event.preventDefault();

                if(rCounter>16){
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div')).attr("id", 'resource-person-child-container' + rCounter);

                newTextBoxDiv.after().html('<div class="col-md-12"><div class="form-group"><label for="resource_person'+rCounter+'" class="required">Resource Person Name '+(rCounter)+'</label><input type="text" placeholder="Name" class="form-control" name="resource_person_name'+rCounter+'"></div></div><div class="col-md-8"><div class="form-group"><label for="resource_person_designation'+rCounter+'" class="required">Resource Person '+(rCounter)+' Designation</label><input type="text" class="form-control" name="resource_person_designation'+rCounter+'" placeholder="Designation"></div></div><div class="col-md-4"><div class="form-group"><label for="resource_person_cost'+rCounter+'" class="required">Resource Person '+(rCounter)+' Cost</label><input type="number" class="form-control" name="resource_person_cost'+rCounter+'"placeholder="cost"></div></div>');


                newTextBoxDiv.appendTo("#resource-person-container");

                rCounter++;
            });

            $("#remove-resource-person").click(function (event) {
                event.preventDefault();
                if(rCounter==2){
                    return false;
                }

                rCounter--;

                $("#resource-person-child-container" + rCounter).remove();

            });

            cCounter = 2;
            $("#add-cost").click(function (event) {
                event.preventDefault();

                if(cCounter>16){
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div')).attr("id", 'other-cost-container' + cCounter);

                newTextBoxDiv.after().html('<div class="col-md-10"><div class="col-md-5"><div class="form-group"><input type="text" class="form-control" name="cost'+cCounter+'" placeholder="Cost Name"></div></div><div class="col-md-5"><div class="form-group has-feedback"><input type="number" class="form-control" name="cost_value'+cCounter+'" placeholder="Value Per Person"></div></div></div>');

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
@stop