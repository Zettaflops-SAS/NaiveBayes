@extends('adminlte::layouts.app')
@section('htmlheader_title')
  Reporte Gráfico General
@endsection
@section('main-content')

@if (session('Fallo'))
  <div class="alert alert-danger">
    <center>{{ session('Fallo') }}</center>
  </div>
@else
  @if (session('Exito'))
    <div class="alert alert-success">
      <center>{{ session('Exito') }}</center>
    </div>
  @else
    @if (session('Alerta'))
      <div class="alert alert-warning">
        <center>{{ session('Alerta') }}</center>
      </div>
    @endif
  @endif
@endif
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
  <div class="col-md-6">
    <div id="chart_div" style="height: 350px;"></div>
    <br>
  </div>
  <div class="col-md-6">
    <div id="curve_chart" style="height: 350px;"></div>
    <br>
  </div>
</div>
<br>
<br>
<div class="row">
  <div id="chart_div_monto" style="height: 400px;"></div>
</div>
<script type="text/javascript">
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawMultSeries);
  function drawMultSeries() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Cuotas Pagas', 'Coutas En Deuda'],
      ['Ejercito', <?php echo $TotalCuotasCanceladasEjercito; ?>, <?php echo $TotalCuotasDebeEjercito; ?>],
      ['Fuerza Aerea', <?php echo $TotalCuotasCanceladasFuerzaAerea; ?>, <?php echo $TotalCuotasDebeFuerzaAerea; ?>],
      ['Armada', <?php echo $TotalCuotasCanceladasArmada; ?>, <?php echo $TotalCuotasDebeArmada; ?>],
      ['Naval', <?php echo $TotalCuotasCanceladasNaval; ?>, <?php echo $TotalCuotasDebeNaval; ?>]
    ]);
    var options = {
      title: 'Cuotas canceladas VS cuotas en deuda para las fuerzas militares',
      hAxis: {
        title: 'Cuotas'
      },
      vAxis: {
        title: 'Escala'
      }
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Probabilidad'],
      ['Ejercito',  <?php echo $ProbabilidadEjercito; ?>],
      ['Fuerza Aerea',  <?php echo $ProbabilidadFuerzaAerea; ?>],
      ['Armada',  <?php echo $ProbabilidadArmada; ?>],
      ['Naval',  <?php echo $ProbabilidadNaval; ?>]
    ]);
    var options = {
      title: 'Probabilidad de las fuerzas militares de cancelar un Prestamo',
      legend: { position: 'bottom' }
    };
    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
    chart.draw(data, options);
  }
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {packages: ['corechart', 'bar']});
  google.charts.setOnLoadCallback(drawAnnotations);

  function drawAnnotations() {
    var data = google.visualization.arrayToDataTable([
      ['City', 'Monto máximo'],
      ['Ejercito', <?php echo $MontoTotalDineroEjercito;?>],
      ['Fuerza Aerea', <?php echo $MontoTotalDineroFuerzaAerea;?>],
      ['Armada', <?php echo $MontoTotalDineroArmada;?>],
      ['Naval', <?php echo $MontoTotalDineroNaval;?>]
    ]);
    var data = google.visualization.arrayToDataTable([
      ['City', 'Monto máximo', {type: 'string', role: 'annotation'}],
      ['Ejercito', <?php echo $MontoTotalDineroEjercito;?>, <?php echo $MontoTotalDineroEjercito;?>],
      ['Fuerza Aerea', <?php echo $MontoTotalDineroFuerzaAerea;?>, <?php echo $MontoTotalDineroFuerzaAerea;?>],
      ['Armada', <?php echo $MontoTotalDineroArmada;?>, <?php echo $MontoTotalDineroArmada;?>],
      ['Naval', <?php echo $MontoTotalDineroNaval;?>, <?php echo $MontoTotalDineroNaval;?>]
    ]);
    var options = {
      title: 'Dinero maximo que se puede prestar',
      chartArea: {width: '50%'},
      annotations: {
        alwaysOutside: true,
        textStyle: {
          fontSize: 12,
          auraColor: 'none',
          color: '#555'
        },
        boxStyle: {
          stroke: '#ccc',
          strokeWidth: 1,
          gradient: {
            color1: '#f3e5f5',
            color2: '#f3e5f5',
            x1: '0%', y1: '0%',
            x2: '100%', y2: '100%'
          }
        }
      },
      vAxis: {
        title: 'Población'
      }
    };
    var chart = new google.visualization.BarChart(document.getElementById('chart_div_monto'));
    chart.draw(data, options);
  }
</script>
@endsection