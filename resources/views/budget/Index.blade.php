@extends('home')


@section('main-content')
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h2 class="">Budget</h2>
            <a class="btn btn-default pull-right" href="/budget/create"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped tab" style="width: 100%;" id="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Budget ID</th>
                    <th>Section ID</th>
                    <th>Section Name</th>
                    <th>Budget Year</th>
                    <th>Allocated Amount</th>
                    <th>Actual Amount</th>
                </tr>
                </thead>

                    <tbody>
                        @foreach ($budgets as $i => $budget)

                        <tr>

                            <td scope="row">{{isset($_GET['page']) ? (16 * $_GET['page']) - (16-$i) + 1 : $i+1}}</td>
                            <td>{{$budget->id}}</td>
                            <td>{{$budget->section_Id}}</td>
                            <td>{{$budget->section_name}}</td>
                            <td>{{$budget->budget_year}}</td>
                            <td>{{$budget->budget_amount}}</td>

                        </tr>
                            @endforeach

                    </tbody>
            </table>

        </div>
        {{$budgets->links()}}
    </div>

@endsection