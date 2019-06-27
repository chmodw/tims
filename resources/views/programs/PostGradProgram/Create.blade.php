@extends('home')

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
        <div class="panel-heading clearfix">
            <p class="" style="">New Post Graduation Program</p>
            <a href="{{route('postgrad.index')}}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-arrow-left margin-right-sm"></i>Back</a>
        </div>
        <div class="panel-body">
            @include('layouts._alert')
            <div class="col-md-10 col-md-offset-1">
                <form method="POST" action="{{ route('postgrad.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="PostGradProgram" name="program_type">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('program_title') ? 'has-error' : ''}}">
                                <label for="program_title" class="required">Program Title</label>
                                <input type="text" class="form-control" value="{{old('program_title')}}" id="program_title" name="program_title" placeholder="Title">
                                @if ($errors->has('program_title'))
                                    <span class="help-block">{{ $errors->first('program_title') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('organised_by_id') ? 'has-error' : ''}}">
                                <label for="organised_by_id" class="required">Institute</label>
                                <input type="text" value="{{old('organised_by_id')}}" class="form-control" name="organised_by_id" id="organised_by_id" placeholder="Institute" list="orgs">
                                <datalist id="orgs">
                                    @foreach($orgs as $org)
                                        <option value="{{$org->name}}"></option>
                                    @endforeach
                                </datalist>
                                @if ($errors->has('organised_by_id'))
                                    <span class="help-block">{{ $errors->first('organised_by_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('department') ? 'has-error' : ''}}">
                                <label for="department" class="required">Department</label>
                                <input type="text" value="{{old('department')}}" name="department" class="form-control" id="department" placeholder="Department">
                                @if ($errors->has('department'))
                                    <span class="help-block">{{ $errors->first('department') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="">
                            <div class="form-group has-feedback {{$errors->has('target_group') ? 'has-error' : ''}}">
                                <label for="target_group" class="required">Target Group</label>
                                <input type="text" value="{{old('target_group')}}" name="target_group" class="form-control" id="target_group" placeholder="Target Group">
                                @if ($errors->has('target_group'))
                                    <span class="help-block">{{ $errors->first('target_group') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group has-feedback {{$errors->has('requirement1') ? 'has-error' : ''}}">
                                    <label for="requirement1" class="required">Eligibility</label>
                                    <input type="text" class="form-control" name="requirement1" id="requirement1" placeholder="Eligibility" value="{{old('requirement1')}}">
                                    @if ($errors->has('requirement1'))
                                        <span class="help-block">{{ $errors->first('requirement1') }}</span>
                                    @endif
                                </div>
                                <div class="requirement-container">
                                    @if(old('requirement2') != null)
                                        @for($i = 2; $i <= 16; $i++)
                                            @if(old('requirement'.$i) != null)
                                                <div class="form-group has-feedback {{$errors->has('requirement'.$i) ? 'has-error' : ''}}">
                                                    <input type="text" class="form-control" name="requirement{{$i}}" id="requirement{{$i}}" placeholder="Eligibility" value="{{old('requirement'.$i)}}">
                                                    @if ($errors->has('requirement'.$i))
                                                        <span class="help-block">{{ $errors->first('requirement'.$i) }}</span>
                                                    @endif
                                                </div>
                                            @endif
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        <div class="col-md-12">
                            <button class="btn btn-default pull-right margin-left-sm" id="remove-req"><i class="glyphicon glyphicon-remove-circle"></i></button>
                            <button class="btn btn-primary pull-right" id="add-req"><i class="glyphicon glyphicon-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_date') ? 'has-error' : ''}}">
                                <label for="application_closing_date" class="required">Application Closing Date</label>
                                <input type="date" value="{{old('application_closing_date')}}" class="form-control" id="application_closing_date" name="application_closing_date" placeholder="">
                                @if ($errors->has('application_closing_date'))
                                    <span class="help-block">{{ $errors->first('application_closing_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('application_closing_time') ? 'has-error' : ''}}">
                                <label for="application_closing_time" class="required">Closing Time</label>
                                <input type="time" value="{{old('application_closing_time')}}" class="form-control" id="application_closing_time" name="application_closing_time" placeholder="">
                                @if ($errors->has('application_closing_time'))
                                    <span class="help-block">{{ $errors->first('application_closing_time') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('start_date') ? 'has-error' : ''}}">
                                <label for="start_date" class="required">Start Date</label>
                                <input type="date" value="{{old('start_date')}}" class="form-control" id="start_date" name="start_date">
                                @if ($errors->has('start_date'))
                                    <span class="help-block">{{ $errors->first('start_date') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback {{$errors->has('duration') ? 'has-error' : ''}}">
                                <label for="duration" class="required inline">Duration</label>
                                <input type="number" value="{{old('duration')}}" class="form-control inline" id="duration" placeholder="Number of Months" id="duration" name="duration">
                                <small id="durationHelpBlock" class="form-text text-muted">
                                    Months
                                </small>
                                @if ($errors->has('duration'))
                                    <span class="help-block">{{ $errors->first('duration') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group has-feedback {{$errors->has('registration_fees') ? 'has-error' : ''}}">
                                <label for="registration_fees" class="required">Registration Fees (Rs)</label>
                                <input type="number" value="{{old('registration_fees')}}" class="form-control" id="registration_fees" name="registration_fees" placeholder="Registration Fees">
                                @if ($errors->has('registration_fees'))
                                    <span class="help-block">{{ $errors->first('registration_fees') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
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
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
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
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('program_brochure') ? 'has-error' : ''}}">
                                <label for="program_brochure">Program Brochure</label>
                                <input type="file" class="form-control-file"  id="program_brochure" name="program_brochure" class="form-control" name="program_brochure" saccept=".DOC,.PDF,.DOCX,.JPG,.JPEG, .PNG " >
                                @if ($errors->has('program_brochure'))
                                    <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('program_brochure') }}</span>
                                @endif
                                <small id="program_brochureHelpBlock" class="form-text text-muted">
                                    Only DOC,PDF,DOCX,JPG,JPEG and PNG are allowed. Max size 4999KB.
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

            $("#add-req").click(function(event){
                event.preventDefault();

                if(counter>16){
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div')).attr("id", 'req-child-container' + counter);

                newTextBoxDiv.after().html('<div class="form-group has-feedback"><input type="text" class="form-control" name="requirement'+counter+'" id="requirement'+counter+'" placeholder="Eligibility">');

                newTextBoxDiv.appendTo(".requirement-container");

                counter++;
            });

            $("#remove-req").click(function (event) {
                event.preventDefault();
                if(counter==2){
                    return false;
                }

                counter--;

                $("#req-child-container" + counter).remove();

            });

            cCounter = 2;
            $("#add-cost").click(function (event) {
                event.preventDefault();

                if(cCounter>16){
                    return false;
                }
                var newTextBoxDiv = $(document.createElement('div')).attr("id", 'other-cost-container' + cCounter);

                newTextBoxDiv.after().html('<div class="col-md-4"></div><div class="col-md-4"><div class="form-group"><input type="text" class="form-control" name="cost'+cCounter+'" placeholder="Cost Name"></div></div><div class="col-md-4"><div class="form-group has-feedback"><input type="number" class="form-control" name="cost_value'+cCounter+'" placeholder="Value "></div></div>');

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