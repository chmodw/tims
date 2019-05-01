@extends('home')


@section('main-content')

@section('content')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="card-title">Update Budget Allocation</h4>
                </div>
                <div class="panel-body">

                    @if(isset($editBudget))
                        <form action="{!! url('budget',$editBudget[0]->id) !!}" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                {{ csrf_field() }}
                                {{method_field('PATCH')}}
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="budget_year">Allocated Year</label>
                                        <input type="date" value="{{old('budget_year', $editBudget[0]->budget_year)}}" class="form-control  {{ $errors->has('budget_year') ? 'is-invalid' : '' }}" id="budget_year" name="budget_year" placeholder="Year">
                                        @if ($errors->has('budget_year'))
                                            <span class="invalid-feedback">{{ $errors->first('budget_year') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-5">
                                    <div class="form-group">
                                        <label for="">Budget Amount</label>
                                        <input type="text" value="{{old('budget_amount', $editBudget[0]->budget_amount)}}" class="form-control {{ $errors->has('budget_amount') ? 'is-invalid' : '' }}" name="budget_amount" id="budget_amount" placeholder="budgetAmount">
                                        @if ($errors->has('budget_amount'))
                                            <span class="invalid-feedback">{{ $errors->first('budget_amount') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary form-submit-btn" value="Save" name="submit">
                                        <a class="btn btn-default mr-2 form-cancel-link" href="{{url('/budget')}}">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="{!! url('budget',$editBudget[0]->id ) !!}" method="DELETE" enctype="multipart/form-data">

                            <div class="col col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-danger" value="Delete" >

                                </div>
                            </div>

                        </form>

                    @else
                            <script>window.location = "/programs/foreign";</script>
                    @endif

                </div>
            </div>
@endsection
