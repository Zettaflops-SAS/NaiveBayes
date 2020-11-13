@extends('adminlte::layouts.app')
@section('htmlheader_title')
  Prestamos NO Aprobados o Cancelados
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

<div <?php  if(session('Fallo')) { ?> class="box box-danger" <?php  }else{ ?> <?php  if(session('Alerta')) { ?> class="box box-warning" <?php  }else{ ?> class="box box-success" <?php }} ?>>
  <div class="box-header">
    <center><h3 class="box-title">Prestamos No Aprobados o Cancelados</h3></center>
  </div>
  <div class="box-body">
    <form role="form" action="/prestamo/prestamosnoaprobadosocancelados/consultaprestamosnoaprobadosocancelados" method="POST">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-2">
          <input type="text" name="CVMGN_Numero_Documento" class="form-control pull-right" placeholder="N° Identificación" required>
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
        </div>
      </div>   
    </form>
    <br>
    <div class="table-responsive">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Cedula</th>
            <th>Dinero Solicitado</th>
            <th>Interes Solicitado</th>
            <th>Plazo Solicitado</th>
            <th>Cuota</th>
            <th>Estado</th>
            <th>Consultar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($ResultadoConsultaPrestamos as $apuntador)
            <tr>
              <td class="active">{{$apuntador->CedulaCliente}}</td>
              <td class="active">$ {{number_format($apuntador->ValorPrestamo)}}</td>
              <td class="active">{{$apuntador->InteresPrestamo}}</td>
              <td class="active">{{$apuntador->PlazoPrestamo}}</td>
              <td class="active">$ {{number_format($apuntador->CuotaPrestamo)}}</td>
              <td class="active">
                  @if($apuntador->EstadoPrestamo=="RECHAZADO")
                    <span class="label label-danger">{{$apuntador->EstadoPrestamo}}</span>
                  @else 
                    @if($apuntador->EstadoPrestamo=="CANCELADO")
                      <span class="label label-success">{{$apuntador->EstadoPrestamo}}</span>
                    @endif
                  @endif
                </td>
              <td class="active">
                @if($apuntador->EstadoPrestamo=="RECHAZADO")
                  <center><span class="label label-danger">{{$apuntador->EstadoPrestamo}}</span></center>
                @else 
                  @if($apuntador->EstadoPrestamo=="CANCELADO")
                    <button type="button" class="btn btn-block btn-success btn-sm" onclick="location.href='{{ url('/amortización/'.$apuntador->PK.'/') }}'"><i class="fa fa-balance-scale"></i>&nbsp;&nbsp;&nbsp;VER</button>
                  @endif
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <?php 
    if(!empty($ResultadoConsultaPrestamos)) {
  ?>
      <center>{!! $ResultadoConsultaPrestamos->render() !!}</center>
  <?php
    }
  ?>
</div>
@endsection