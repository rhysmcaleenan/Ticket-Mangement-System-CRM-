@extends('layouts.main')

@push('script')
    <!---------- link to the javascript chart js file downloaded in public folder  --------------------> 
    <script src="{{ asset('public/plugins/chart.js/Chart.min.js') }}"></script>

    <script type="text/javascript">
        $(function () {
            // ChartJS
            // Here we will create a few charts for using ChartJS
            //----------------------------------------  LINE CHART FOR NUMBER OF TICKETS IN TOTAL PER WEEK -----------------------------------------
            
            var lineChartData = {
                // outputting in html on hover of each point the related ticket count number
                labels: {!! json_encode($lastTickets['date']) !!},
                datasets: [
                    {
                        // Styling for the line chart 
                        fillColor: 'rgba(0,166,90)',
                        strokeColor: 'rgba(0,166,90)',
                        pointColor: 'rgba(0,166,90)',
                        pointStrokeColor: 'rgba(0,166,90)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(0,166,90)',
                        // get the data from the controller
                        data: {!! json_encode($lastTickets['tickets']) !!},
                    }
                ]
            };

            var lineChartOptions = {
                //Boolean - If we should show the scale at all
                showScale: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - Whether the line is curved between points
                bezierCurve: true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension: 0.6,
                //Boolean - Whether to show a dot for each point
                pointDot: true,
                //Number - Radius of each point dot in pixels
                pointDotRadius: 4,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth: 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius: 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke: true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth: 2,
                //Boolean - Whether to fill the dataset with a color
                datasetFill: true,
                //String - A legend template
                //**
                legendTemplate: '{{ '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>' }}',
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true
            };
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
            var lineChart = new Chart(lineChartCanvas);
            lineChartOptions.datasetFill = false;
            lineChart.Line(lineChartData, lineChartOptions);

            //---------------------------------------------  BAR CHART  FOR TOTAL TICKETS COMPLETED PER CLIENT -----------------------------------------------

            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChart = new Chart(barChartCanvas);

            var barChartData = {
                labels: {!! json_encode($lastTicketsCompleted['date']) !!},
                datasets: [
                    {
                        // Styling for the results in the bar chart
                        fillColor: 'rgb(0, 192, 239)',
                        strokeColor: 'rgb(0, 192, 239)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: {!! json_encode($lastTicketsCompleted['tickets']) !!},
                    }
                ]
            };

            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template to loop through outputting each clients name and bar chart
                legendTemplate: '{{ '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>' }}',
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            };

            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);

        });
    </script>
@endpush


@section('content')

<!------------------------------- Start of HTML --------------------------------->

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                System Reports
            </h1>
            <!---- breadcrumb to show the user where they are on the system ----->
            <ol class="breadcrumb">
                <li><i class="fa fa-dashboard"></i> Control Panel</li>
                <li class="active">Reports</li>
            </ol>
        </section>

         <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!---------- LINE CHART TO SHOW NUMBER OF TICKETS SUBMITTED TO THE SYSTEM PER WEEK ---------------------------->
                             <div class="box box-success box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tickets Submitted per Week</h3>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <!--- Linking to the JS above through the id lineChart to tell Canvas what it should display ------>
                                        <canvas id="lineChart" style="height:15vw;"></canvas>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BAR CHART -->
                            <div class="box box-info box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Completed Tickets per Client (Monthly)</h3>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                         <!--- Linking to the JS above through the id barChart to tell Canvas what it should display ------>
                                        <canvas id="barChart" style="height:15vw;"></canvas>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>
        </section>
    
@endsection
