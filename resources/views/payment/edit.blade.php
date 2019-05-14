@extends('home')


@section('main-content')

@section('content')


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="card-title">Update Payment Information of payment ID No : {{$editPayment[0]->id}}</h4>
                </div>
                <div class="panel-body">

                    @if(isset($editPayment))
                        <form action="{!! url('payment',$editPayment[0]->id) !!}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                {{ csrf_field() }}
                                {{method_field('PATCH')}}
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="budget_year">Allocated Year</label>
                                        <input type="date" value="{{old('payment_Date', $editPayment[0]->payment_Date)}}" class="form-control  {{ $errors->has('payment_Date') ? 'is-invalid' : '' }}" id="payment_Date" name="payment_Date" placeholder="Year">
                                        @if ($errors->has('payment_Date'))
                                            <span class="invalid-feedback">{{ $errors->first('payment_Date') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-5">
                                    <div class="form-group">
                                        <label for="">Budget Amount</label>
                                        <input type="text" value="{{old('payment_amount', $editPayment[0]->payment_amount)}}" class="form-control {{ $errors->has('payment_amount') ? 'is-invalid' : '' }}" name="payment_amount" id="payment_amount" placeholder="paymentAmount">
                                        @if ($errors->has('payment_amount'))
                                            <span class="invalid-feedback">{{ $errors->first('payment_amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary form-submit-btn" value="Save" name="submit">
                                        <a class="btn btn-default mr-2 form-cancel-link" href="{{url('/payment')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                            <script>window.location = "/programs/foreign";</script>
                    @endif
                </div>
            </div>
@endsection
