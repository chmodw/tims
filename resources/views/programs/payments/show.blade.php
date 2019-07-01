@extends('home')

@section('main-content')

    @include('layouts._alert')

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <p class="" style="">Payment</p>
            <div class="btn-container pull-right">
                <form class="pull-right" method="POST" action="{{ route('payment.destroy',$program_data['id']) }}">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button  class="btn btn-danger" style="margin-right:8px;" onclick="return confirm('Are you sure? this will delete the current payment form the system')"><i class="glyphicon glyphicon-trash margin-right-sm"></i>&nbspMark as Unpaid</button>
                </form>
                <a class="btn btn-warning pull-right" style="margin-right:8px;" href="{{route('payment.edit', $details->id)}}"><i class="glyphicon glyphicon-pencil margin-right-sm"></i>&nbsp;Edit</a>
            </div>
        </div>
        <div class="panel-body">

            <h3><b>Program Name:</b> {{$program_data['program_title']}}</h3>
            <h3><b>Section:</b> {{$program_data['section_name']}}</h3>
            <hr>
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


            <div class="col-md-6 col-md-offset-3">

                <table class="table table-bordered">

                    <tr>
                        <td style="width:20%"></td>
                        <td style="width:20%"></td>
                        <td style="width:20%"></td>
                        <td style="width:20%"></td>
                        <td style="width:20%"></td>
                    </tr>
                    <tr>
                        <th colspan="2">Cheque/Invoice Number</th>
                        <td colspan="3">{{$details['invoice_number']}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Cheque/Invoice</th>
                        <td colspan="3">{{$details['invoice_number']}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Created By</th>
                        <td colspan="3">{{$details['created_by']}}</td>
                    </tr>
                    <tr>
                        <th colspan="2">Updated By</th>
                        <td colspan="3"><a href="/storage/payment_invoices/{{$details['invoice_file']}}" target="_blank"><img src="/storage/payment_invoices/{{$details['invoice_file']}}" style="max-width: 100%"></a></td>
                    </tr>
                    <tr>
                        <th colspan="1">Created On</th>
                        <td colspan="1">{{$details['created_at']}}</td>
                        <th colspan="2">Updated On</th>
                        <td colspan="1">{{$details['updated_at']}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>

    </script>
@endsection