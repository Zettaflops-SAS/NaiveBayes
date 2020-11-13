@extends('adminlte::layouts.app')
@section('htmlheader_title')
  Estadísticas
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
    @endif
  @endif
  <div  <?php  if(session('Fallo')) { ?> class="box box-danger" <?php  }else{ ?> class="box box-success" <?php } ?>>
    <div class="box-header">
      <h3 class="box-title">Enunciado del problema</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <center><p style="font-family: 'Homer Simpson UI';"><font size=4>InverBursatil tiene <strong>{{$totalPrestamos}} creditos APROBADOS O CANCELADOS</strong> el
          @if($FuerzaPerteneciente==1)
            <strong>{{$PCAE}}%</strong> de dichos créditos le pertenecen al <strong>ejercito</strong>, además solo el <strong>{{$PCCE}}% estan CANCELADOS</strong> y a su vez el <strong>{{$PCAECCE}}% se CANCELARON y nunca presentaron MORA.</strong>
          @else
            @if($FuerzaPerteneciente==2)
              <strong>{{$PCAF}}%</strong> de dichos créditos le pertenecen a la <strong>fuerza aerea</strong>, además solo el <strong>{{$PCCF}}% estan CANCELADOS</strong> y a su vez el <strong>{{$PCAFCCF}}% se CANCELARON y nunca presentaron MORA.</strong>
            @else
              @if($FuerzaPerteneciente==3)
                <strong>{{$PCAA}}%</strong> de dichos créditos le pertenecen a la <strong>armada</strong>, además solo el <strong>{{$PCCA}}% estan CANCELADOS</strong> y a su vez el <strong>{{$PCAACCA}}% se CANCELARON y nunca presentaron MORA.</strong>
              @else
                @if($FuerzaPerteneciente==4)
                  <strong>{{$PCAN}}%</strong> de dichos créditos le pertenecen a <label></label> <strong>naval</strong>, además solo el <strong>{{$PCCN}}% estan CANCELADOS</strong> y a su vez el <strong>{{$PCANCCN}}% se CANCELARON y nunca presentaron MORA.</strong>
                @endif
              @endif
            @endif
          @endif
        </font></p></center>
      </div>
    </div>
  </div>
  <center><button type="button" class="btn btn-danger btn-sm" onclick="location.href='{{ url('/amortización/noaprobar/'.$IdPrestamo.'/') }}'"><i class="fa fa-arrows-alt"></i>&nbsp;&nbsp;&nbsp;RECHAZAR SOLICITUD</button></center>
  <br>
  <div  <?php  if(session('Fallo')) { ?> class="box box-danger" <?php  }else{ ?> class="box box-success" <?php } ?>>
    <div class="box-header">
      <h3 class="box-title">Prestamos Solicitados</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Tipo</th>
              <th>Cedula</th>
              <th>Dinero</th>
              <th>Interes</th>
              <th>Plazo</th>
              <th>Cuota</th>
              <th>Operación</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="active">SOLICITADO</td>
              <td class="active">{{$CedulaCliente}}</td>
              <td class="active">$ {{number_format($DineroSolicitado)}}</td>
              <td class="active">{{$InteresSolicitado}}</td>
              <td class="active">{{$PlazoSolicitado}}</td>
              <td class="active">$ {{number_format($CoutaSolicitada)}}</td>
              <td class="active">
                @if ($DineroSimulado<$DineroSolicitado)
                  <center><span class="label label-danger">NO APROBADO</span></center>
                @else
                  @if ($DineroSolicitado<=$DineroSimulado)
                    <button type="button" class="btn btn-block btn-success btn-sm" onclick="location.href='{{ url('/amortización/aprobar/'.$IdPrestamo.'/'.$DineroSolicitado.'/'.$InteresSolicitado.'/'.$PlazoSolicitado.'/'.$CoutaSolicitada.'/') }}'"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;&nbsp;APROBAR</button>
                  @endif
                @endif
              </td>
            </tr>
            <tr>
              <td class="active">SIMULADO</td>
              <td class="active">{{$CedulaCliente}}</td>
              <td class="active">$ {{number_format($DineroSimulado)}}</td>
              <td class="active">{{$InteresSimulado}}</td>
              <td class="active">{{$PlazoSimulado}}</td>
              <td class="active">$ {{number_format($CuotaSimulada)}}</td>
              <td class="active">
                @if($InteresSimulado<=3)
                  <button type="button" class="btn btn-block btn-success btn-sm" onclick="location.href='{{ url('/amortización/aprobar/'.$IdPrestamo.'/'.$DineroSimulado.'/'.$InteresSimulado.'/'.$PlazoSimulado.'/'.$CuotaSimulada.'/') }}'"><i class="fa fa-cloud-upload"></i>&nbsp;&nbsp;&nbsp;APROBAR</button>
                @else
                  @if($InteresSimulado>3&&$DineroSolicitado<=$DineroSimulado)
                    <center><span class="label label-danger">NO APROBADO</span></center>
                  @else
                    @if($InteresSimulado>3)
                      <button type="button" class="btn btn-block btn-danger btn-sm" onclick="location.href='{{ url('/amortización/noaprobar/'.$IdPrestamo.'/') }}'"><i class="fa fa-archive"></i>&nbsp;&nbsp;&nbsp;NO APROBAR</button>
                    @endif
                  @endif
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <div class="table-responsive" style="border: 0px solid;">
              <h3>{{$ProbabilidadTotalEjercito}}<sup style="font-size: 20px">%</sup></h3>
              <p>Ejercito</p>
            </div>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <div id="myModalEjercito" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <html>
                    <head>
                      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                      <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ['Cuotas Canceladas', 'Cuotas en Deuda'],
                            ['Canceladas',     <?php echo $TotalCuotasCanceladasEjercito; ?>],
                            ['Deuda',      <?php echo $TotalCuotasDeudaEjercito; ?>],
                            ['Mora',  <?php echo $TotalCuotasMoraEjercito; ?>]
                          ]);
                          var options = {
                            title: 'Cuotas Canceladas VS Cuotas en Deuda VS Cuotas en Mora',
                            is3D: true,
                            width:500,
                            height:500
                          };
                          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                          chart.draw(data, options);
                        }
                      </script>
                    </head>
                    <body>
                      <div class="table-responsive" style="height: 550px;">
                        <center><div id="piechart_3d"></div></center>
                      </div>
                    </body>
                  </html>  
                </div>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#myModalEjercito" class="small-box-footer">Mas Información<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <div class="table-responsive" style="border: 0px solid;">
              <h3>{{$ProbabilidadTotalFuerzaAerea}}<sup style="font-size: 20px">%</sup></h3>
              <p>Fuerza Aerea</p>
            </div>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <div id="myModalFuerzaAerea" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <html>
                    <head>
                      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                      <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ['Cuotas Canceladas', 'Cuotas en Deuda'],
                            ['Canceladas',     <?php echo $TotalCuotasCanceladasFuerzaAerea; ?>],
                            ['Deuda',      <?php echo $TotalCuotasDeudaFuerzaAerea; ?>],
                            ['Mora',  <?php echo $TotalCuotasMoraFuerzaAerea; ?>]
                          ]);
                          var options = {
                            title: 'Cuotas Canceladas VS Cuotas en Deuda VS Cuotas en Mora',
                            is3D: true,
                            width:500,
                            height:500
                          };
                          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_FuerzaAerea'));
                          chart.draw(data, options);
                        }
                      </script>
                    </head>
                    <body>
                      <div class="table-responsive" style="height: 550px;">
                        <center><div id="piechart_3d_FuerzaAerea"></div></center>
                      </div>
                    </body>
                  </html>  
                </div>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#myModalFuerzaAerea" class="small-box-footer">Mas Información<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <div class="table-responsive" style="border: 0px solid;">
              <h3>{{$ProbabilidadTotalArmada}}<sup style="font-size: 20px">%</sup></h3>
              <p>Armada</p>
            </div>  
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <div id="myModalArmada" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <html>
                    <head>
                      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                      <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ['Cuotas Canceladas', 'Cuotas en Deuda'],
                            ['Canceladas',     <?php echo $TotalCuotasCanceladasArmada; ?>],
                            ['Deuda',      <?php echo $TotalCuotasDeudaArmada; ?>],
                            ['Mora',  <?php echo $TotalCuotasMoraArmada; ?>]
                          ]);
                          var options = {
                            title: 'Cuotas Canceladas VS Cuotas en Deuda VS Cuotas en Mora',
                            is3D: true,
                            width:500,
                            height:500
                          };
                          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_Armada'));
                          chart.draw(data, options);
                        }
                      </script>
                    </head>
                    <body>
                      <div class="table-responsive" style="height: 550px;">
                        <center><div id="piechart_3d_Armada"></div></center>
                      </div>
                    </body>
                  </html>  
                </div>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#myModalArmada" class="small-box-footer">Mas Información<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <div class="table-responsive" style="border: 0px solid;">
              <h3>{{$ProbabilidadTotalNaval}}<sup style="font-size: 20px">%</sup></h3>
              <p>Naval</p>
            </div>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <div id="myModalNaval" class="modal fade bd-example-modal-lg" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <html>
                    <head>
                      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                      <script type="text/javascript">
                        google.charts.load("current", {packages:["corechart"]});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                          var data = google.visualization.arrayToDataTable([
                            ['Cuotas Canceladas', 'Cuotas en Deuda'],
                            ['Canceladas',     <?php echo $TotalCuotasCanceladasNaval; ?>],
                            ['Deuda',      <?php echo $TotalCuotasDeudaNaval; ?>],
                            ['Mora',  <?php echo $TotalCuotasMoraNaval; ?>]
                          ]);
                          var options = {
                            title: 'Cuotas Canceladas VS Cuotas en Deuda VS Cuotas en Mora',
                            is3D: true,
                            width:500,
                            height:500
                          };
                          var chart = new google.visualization.PieChart(document.getElementById('piechart_3d_Naval'));
                          chart.draw(data, options);
                        }
                      </script>
                    </head>
                    <body>
                      <div class="table-responsive" style="height: 550px;">
                        <center><div id="piechart_3d_Naval"></div></center>
                      </div>
                    </body>
                  </html>  
                </div>
              </div>
            </div>
          </div>
          <a href="#" data-toggle="modal" data-target="#myModalNaval" class="small-box-footer">Mas Información<i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <html>
      <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load('current', {'packages':['line']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = new google.visualization.DataTable();
              data.addColumn('number', 'Probabilidades');
              data.addColumn('number', 'Fuerza Militares');
              data.addRows([
                [1,  <?php echo $ProbabilidadTotalEjercito;?>],
                [2,  <?php echo $ProbabilidadTotalNaval;?>],
                [3,  <?php echo $ProbabilidadTotalArmada;?>],
                [4,  <?php echo $ProbabilidadTotalFuerzaAerea;?>]
              ]);

            var options = {
              chart: {
                subtitle: ''
              },
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
      </head>
      <body>
        <div class="table-responsive">
          <div id="line_top_x" style="width: 100%; height: 300px;"></div>
        </div>
      </body>
    </html>
  </section>
@endsection