@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            New Payment
        </div>
        <div class="panel-body">

            <table class="table table-bordered">
                <colgroup>
                    <col class="bg-gray-light">
                    <col span="2" class="">
                    <col span="2" class="bg-gray-light">
                    <col span="2" class="">
                    <col class="bg-gray-light">
                    <col span="2" class="bg-success">
                </colgroup>
                <thead>
                    <tr>
                        <th>Section/Unit</th>
                        <th>Member Count</th>
                        <th>Total Member Fee (Rs)</th>
                        <th>Non-Member Count</th>
                        <th>Non-member Fee (Rs)</th>
                        <th>Student Count</th>
                        <th>Total Student Fee (Rs)</th>
                        <th>Program Fee (Rs)</th>
                        <th>Employee Count</th>
                        <th>Total Payment<th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>{{$payment['section']}}</b></td>
                        <td>{{$payment['data']['member_count']}}</td>
                        <td>Rs. {{$payment['data']['member_total_cost']}}/=</td>
                        <td>{{$payment['data']['nonmember_count']}}</td>
                        <td>Rs. {{$payment['data']['nonmember_total_cost']}}/=</td>
                        <td>{{$payment['data']['student_count']}}</td>
                        <td>Rs. {{$payment['data']['student_total_cost']}}/=</td>
                        <td>Rs. {{$payment['data']['program_fee']}}/=</td>
                        <td>{{$payment['data']['total_count']}}</td>
                        <td>Rs. {{$payment['data']['total_cost']}}/=</td>
                    </tr>
                </tbody>
            </table>
{{--            {{print_r($program)}}--}}
{{--            {{print_r($payments)}}--}}


            <div class="col-md-6 col-md-offset-3">
                <form action="{{route('payment.store')}}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="payment_data" value="{{serialize($payment)}}">
                    <input type="hidden" name="program_id" value="{{$program['program_id']}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('invoice_number') ? 'has-error' : ''}}">
                                <label for="invoice_number" class="required">Invoice/Cheque Number</label>
                                <input type="text" value="{{old('invoice_number')}}" class="form-control" name="invoice_number" id="invoice_number" placeholder="Invoice/Cheque Number" required>
                                @if ($errors->has('invoice_number'))
                                    <span class="help-block">{{ $errors->first('invoice_number') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback {{$errors->has('invoice_file') ? 'has-error' : ''}}">
                                <label for="invoice_file">Invoice/Cheque</label>
                                <input type="file" class="form-control-file"  id="invoice_file" name="invoice_file">
                                @if ($errors->has('invoice_file'))
                                    <span class="help-block" style="display: block;width: 100%;margin-top: 0.25rem;font-size: 80%;color: #dc3545;">{{ $errors->first('invoice_file') }}</span>
                                @endif
                                <small id="invoice_fileHelpBlock" class="form-text text-muted">
                                    Only DOC,PDF,DOCX,JPG,JPEG and PNG are allowed. Max size 4999KB.
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

    </script>
@endsection