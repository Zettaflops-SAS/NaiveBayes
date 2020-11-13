@extends('adminlte::layouts.app')
@section('htmlheader_title')
	Solicitar Prestamo
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

	<form role="form" action="/prestamo/solicitud" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div <?php  if(session('Fallo')) { ?> class="box box-danger" <?php  }else{ ?> class="box box-success" <?php } ?>>
      <div class="box-header with-border">
        <center><h1 class="box-title"><strong>Crear Prestamo<strong></h1></center>
        <div class="box-tools pull-right">
        </div>
      </div>
     	<div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Dinero Solicitado</label>
              <input class="form-control" required type="number" name="CVMGN_Dinero_Solicitado" min="1" max="100000000">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Interes del Prestamo</label>
              <input class="form-control" required step="0.01" type="number" name="CVMGN_Interes_prestamo" min="0" max="3">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Plazo del Prestamo</label>
              <input class="form-control" required type="number" name="CVMGN_Plazo_Prestamo" min="1" max="50">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>N° Identificación</label>
              <input class="form-control" required type="number" name="CVMGN_Numero_Identificacion" min="1">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Fuerzas Militares</label>
              <select class="form-control" required name="CVMGN_Fuerza_Militar" id="CVMGN_Fuerza_Militar">
                <option value="1">Ejercito</option>
                <option value="2">Fuerza Aerea</option>
                <option value="3">Armada</option>
                <option value="4">Naval</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <center><button class="btn btn-success btn-flat" type="submit">Enviar Información</button></center>
        </div>
      </div>
    </div>
  </form>
@endsection