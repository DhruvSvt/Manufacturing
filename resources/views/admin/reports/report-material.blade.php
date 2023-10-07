@extends('admin.layouts.app', ['title' => 'Material - Report'])
@section('content')
    <!-- ===== Graph Area Start ===== -->
    <div id="chart_div" style="height: 900px"></div>
    <!-- ===== Graph Area End ===== -->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawMultSeries);

        function drawMultSeries() {
            var data = new google.visualization.DataTable();
            data.addColumn('timeofday', 'Time of Day');
            data.addColumn('number', 'Total Revenue');
            data.addColumn('number', 'Total Expenses');

            data.addRows([
                [{
                    v: [8, 0, 0],
                    f: '8 am'
                }, 1, .25],
                [{
                    v: [9, 0, 0],
                    f: '9 am'
                }, 2, .5],
                [{
                    v: [10, 0, 0],
                    f: '10 am'
                }, 3, 1],
                [{
                    v: [11, 0, 0],
                    f: '11 am'
                }, 4, 2.25],
                [{
                    v: [12, 0, 0],
                    f: '12 pm'
                }, 5, 2.25],
                [{
                    v: [13, 0, 0],
                    f: '1 pm'
                }, 6, 3],
                [{
                    v: [14, 0, 0],
                    f: '2 pm'
                }, 7, 4],
                [{
                    v: [15, 0, 0],
                    f: '3 pm'
                }, 8, 5.25],
                [{
                    v: [16, 0, 0],
                    f: '4 pm'
                }, 9, 7.5],
                [{
                    v: [17, 0, 0],
                    f: '5 pm'
                }, 10, 10],
            ]);

            var options = {
                title: 'Total Revenue and Total Expenses',
                hAxis: {
                    title: 'Selected Dates',
                    format: 'h:mm a',
                    viewWindow: {
                        min: [7, 30, 0],
                        max: [17, 30, 0]
                    }
                },
                vAxis: {
                    title: 'Amount'
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
@endsection
