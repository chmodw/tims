@extends('home')


@section('main-content')

<div class="panel panel-default">
    <div class="panel-heading">
       Payments
    </div>
    <div class="panel-body">
        <form method="POST" action="{!! url('payment') !!}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="trainee_name" name="trainee_name">
            <div class="col-md-10">
                <div class="form-group has-feedback {{$errors->has('trainee_name') ? 'has-error' : ''}}">
                    <label for="trainee_name">Employee Name</label>
                    <select class="form-control" id="trainee_name" name="trainee_name">
                        <option selected>Choose...</option>
                        @foreach($programs as $program)
                            <option value="{{$program->trainees->EmployeeId}}">{{$program->trainees->NameWithInitial}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-feedback {{$errors->has('payment_Date') ? 'has-error' : ''}}">
                    <label for="payment_Date">Payment Date</label>
                    <input type="date" value="{{old('payment_Date')}}" class="form-control" id="payment_Date" name="payment_Date" >
                    @if ($errors->has('payment_Date'))
                        <span class="help-block">{{ $errors->first('payment_Date') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group has-feedback {{$errors->has('payment_amount') ? 'has-error' : ''}}">
                    <label for="payment_amount">amount</label>
                    <input type="text" value="{{old('payment_amount')}}" class="form-control" id="payment_amount" name="payment_amount" placeholder="Rs.">
                    @if ($errors->has('payment_amount'))
                        <span class="help-block">{{ $errors->first('payment_amount') }}</span>
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