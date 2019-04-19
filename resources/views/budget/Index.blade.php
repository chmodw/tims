@extends('home')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h2 class="">Budget</h2>
                        <a class="btn btn-default pull-right" href="/budget/create"><i class="glyphicon glyphicon-plus margin-right-md"></i>&nbsp;New</a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped tab" style="width: 100%;" id="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Budget ID</th>
                                    <th>Section ID</th>
                                    <th>Section Name</th>
                                    <th>Budget Year</th>
                                    <th>Allocated Amount</th>

                                    <th>Edit</th>
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

                                        <td>
                                            <a href="{{url('/budget/'.$budget->id.'/edit')}}">
                                                <i  class="fa fa-eye" style="color: blue" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{--{{$budgets->links()}}--}}
                </div>
            </div>
            <div class="col-md-5">
                <div id="donutchart" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

            let budgetData = {!! $budgetData !!};

            let pie = [
                ['Section', 'Amount'],
            ];

            Object.keys(budgetData).forEach(function(key) {
                pie.push([key, parseInt(budgetData[key])])
            });

            var data = google.visualization.arrayToDataTable(pie);

            var options = {
                title: 'Budget Allocated for Sections',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
@endsection