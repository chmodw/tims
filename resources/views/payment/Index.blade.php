@extends('home')


@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="">Payments</h2>
            <a class="btn btn-default pull-right" href="/payment/create"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped" style="width: 100%;" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Payment ID</th>
                    <th>Program ID</th>
                    {{--<th>Program Name</th>--}}
                    <th>Trainee Name</th>
                    <th>Payment date</th>
                    <th>Payment amount</th>
                    <th>Edit</th>
                </tr>
                </thead>

                    <tbody>
                        @foreach ($payments as $i => $payment)

                        <tr>

                            <td scope="row">{{isset($_GET['page']) ? (16 * $_GET['page']) - (16-$i) + 1 : $i+1}}</td>
                            <td>{{$payment->id}}</td>
                            <td>{{$payment->program_id}}</td>

                            {{--<td>{{$payment->program_name}}</td>--}}
                            <td>{{$payment->trainee_name}}</td>
                            <td>{{$payment->payment_Date}}</td>
                            <td>{{$payment->payment_amount}}</td>
                            <td>
                                <a href="{{url('/payment/'.$payment->id.'/edit')}}">
                                    <i  class="fa fa-eye" style="color: blue" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                            @endforeach

                    </tbody>
            </table>

        </div>
        {{$payments->links()}}

    </div>

@endsection