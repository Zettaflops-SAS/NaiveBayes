@extends('adminlte::layouts.app')
@section('htmlheader_title')
  Amortización
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
      <center><h3 class="box-title">Informacón del Prestamo</h3></center>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Abono a Capital</th>
              <th>Abono a Interes</th>
              <th>Interes de Mora</th>
              <th>Saldo</th>
              <th>Mes</th>
              <th>Estado</th>
              <th>Fecha de Pago</th>
              <th>Realizar Pago</th>
            </tr>
          </thead>
          <tbody>
            <?php $Bandera=0; ?>
            @foreach ($ResultadoConsultaAmortizacion as $apuntador)
              <tr>
                <td class="active">$ {{number_format($apuntador->AbonoCapital)}}</td>
                <td class="active">$ {{number_format($apuntador->AbonoInteres)}}</td>
                <td class="active">$ {{number_format($apuntador->InteresMora)}}</td>
                <td class="active">$ {{number_format($apuntador->Saldo)}}</td>
                <td class="active">{{$apuntador->Mes}}</td>
                <td class="active">
                  @if($apuntador->Estado=="DEBE")
                    <span class="label label-danger">{{$apuntador->Estado}}</span>
                  @else 
                    @if($apuntador->Estado=="CANCELADO")
                      <span class="label label-success">{{$apuntador->Estado}}</span>
                    @else 
                      <span class="label label-warning">{{$apuntador->Estado}}</span>
                    @endif
                  @endif
                </td>
                <td class="active">{{$apuntador->FechaPago}}</td>
                <td class="active">
                  @if($apuntador->Estado!="CANCELADO")
                    @if($Bandera==0)
                      <?php $Bandera=1; ?>
                      <button type="button" class="btn btn-block btn-success btn-sm" onclick="location.href='{{ url('/amortización/pagocuota/'.$apuntador->PK.'/') }}'"><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;PAGAR CUOTA</button>
                    @else
                      <center><span class="label label-default">CUOTA FALTANTE POR PAGAR</span></center>
                    @endif
                  @else
                    <center><span class="label label-default">CANCELADA</span></center>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection