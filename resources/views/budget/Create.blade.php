@extends('home')


@section('main-content')

<div class="panel panel-default">
    <div class="panel-heading">
       Budget Allocation
    </div>
    <div class="panel-body">
        <form method="POST" action="{!! url('budget') !!}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="section_Id" name="section_Id">

            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('section_Id') ? 'has-error' : ''}}">
                    <label for="section_Id">Section ID</label>
                    <select class="form-control" id="section_Id" name="section_Id">
                        <option selected>Choose...</option>
                        @foreach($workSpaces as $workspace)
                            <option value="{{$workspace->WorkSpaceTypeId}}">{{$workspace->WorkSpaceTypeId}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('section_name') ? 'has-error' : ''}}">
                    <label for="section_name">Section name</label>
                    <select class="form-control" id="section_name" name="section_name">
                        <option selected>Choose...</option>
                        @foreach($workSpaces as $workspace)
                        <option value="{{$workspace->WorkSpaceTypeName}}">{{$workspace->WorkSpaceTypeName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('budget_year') ? 'has-error' : ''}}">
                    <label for="budget_year">Year</label>
                    <input type="date" value="{{old('budget_year')}}" class="form-control" id="budget_year" name="budget_year">
                    @if ($errors->has('budget_year'))
                        <span class="help-block">{{ $errors->first('budget_year') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group has-feedback {{$errors->has('budget_amount') ? 'has-error' : ''}}">
                    <label for="budget_amount">amount</label>
                    <input type="text" value="{{old('budget_amount')}}" class="form-control" id="budget_amount" name="budget_amount">
                    @if ($errors->has('budget_amount'))
                        <span class="help-block">{{ $errors->first('budget_amount') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" name="_submit" class="btn btn-primary mb-2 mr-2 pull-right" value="reload_page">Save</button>
                <button type="submit" name="_submit" class="btn btn-primary mb-2 pull-right" style="margin-right: 15px;" value="redirect">Save &amp; Go Back</button>
            </div>
        </form>
    </div>
</div>

@endsection