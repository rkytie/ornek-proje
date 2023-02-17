@extends('layouts.app')

@section('title') Grafikler @endsection

@section('content')
    <!-- start page title -->
    @include('includes.page-title-box',[
    'pageTitle'=>"Grafikler / Kazançlar",
    ])
    <!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card mini-stat  text-white">
            <div class="card-body">

            <div id="chart_div"></div><br><br>
            <div id="line_top_x"></div>



            </div>
          </div>
  </div>
</div>
@endsection
@section('script')
    <!-- Magnific Popup-->
    <script src="{{asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <!-- Tour init js-->
    <script src="{{asset('assets/js/pages/lightbox.init.js')}}"></script>
    <script>
    google.charts.load('current', {'packages':['line', 'corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

var button = document.getElementById('change-chart');
var chartDiv = document.getElementById('chart_div');

var data = new google.visualization.DataTable();
data.addColumn('date', 'Month');
data.addColumn('number', "Average Temperature");
data.addColumn('number', "Average Hours of Daylight");

data.addRows([
  [new Date(2014, 0),  -.5,  5.7],
  [new Date(2014, 1),   .4,  8.7],
  [new Date(2014, 2),   .5,   12],
  [new Date(2014, 3),  2.9, 15.3],
  [new Date(2014, 4),  6.3, 18.6],
  [new Date(2014, 5),    9, 20.9],
  [new Date(2014, 6), 10.6, 19.8],
  [new Date(2014, 7), 10.3, 16.6],
  [new Date(2014, 8),  7.4, 13.3],
  [new Date(2014, 9),  4.4,  9.9],
  [new Date(2014, 10), 1.1,  6.6],
  [new Date(2014, 11), -.2,  4.5]
]);

var materialOptions = {
  chart: {
    title: 'Average Temperatures and Daylight in Iceland Throughout the Year'
  },
  width: 900,
  height: 500,
  series: {
    // Gives each series an axis name that matches the Y-axis below.
    0: {axis: 'Temps'},
    1: {axis: 'Daylight'}
  },
  axes: {
    // Adds labels to each axis; they don't have to match the axis names.
    y: {
      Temps: {label: 'Temps (Celsius)'},
      Daylight: {label: 'Daylight'}
    }
  }
};

var classicOptions = {
  title: 'Average Temperatures and Daylight in Iceland Throughout the Year',
  width: 900,
  height: 500,
  // Gives each series an axis that matches the vAxes number below.
  series: {
    0: {targetAxisIndex: 0},
    1: {targetAxisIndex: 1}
  },
  vAxes: {
    // Adds titles to each axis.
    0: {title: 'Temps (Celsius)'},
    1: {title: 'Daylight'}
  },
  hAxis: {
    ticks: [new Date(2014, 0), new Date(2014, 1), new Date(2014, 2), new Date(2014, 3),
            new Date(2014, 4),  new Date(2014, 5), new Date(2014, 6), new Date(2014, 7),
            new Date(2014, 8), new Date(2014, 9), new Date(2014, 10), new Date(2014, 11)
           ]
  },
  vAxis: {
    viewWindow: {
      max: 30
    }
  }
};

function drawMaterialChart() {
  var materialChart = new google.charts.Line(chartDiv);
  materialChart.draw(data, materialOptions);
  button.innerText = 'Change to Classic';
  button.onclick = drawClassicChart;
}

function drawClassicChart() {
  var classicChart = new google.visualization.LineChart(chartDiv);
  classicChart.draw(data, classicOptions);
  button.innerText = 'Change to Material';
  button.onclick = drawMaterialChart;
}

drawMaterialChart();

}
      </script>

      <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Guardians of the Galaxy');
      data.addColumn('number', 'The Avengers');
      data.addColumn('number', 'Transformers: Age of Extinction');

      data.addRows([
        [1,  37.8, 80.8, 41.8],
        [2,  30.9, 69.5, 32.4],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 42.9, 14.8],
        [10, 12.8, 30.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);

      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
@endsection
