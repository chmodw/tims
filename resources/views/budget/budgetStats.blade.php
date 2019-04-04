@extends('layouts.app')

@section('content-title', 'Statistics')

@section('content')

<head>
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
                pie.push([key, budgetData[key]])
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
</head>
<body>
<div id="donutchart" style="width: 900px; height: 500px;"></div>
</body>

@endsection