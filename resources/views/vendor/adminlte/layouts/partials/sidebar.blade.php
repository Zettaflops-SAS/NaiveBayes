<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('/img/sin_foto.png') }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p style="overflow: hidden;text-overflow: ellipsis;max-width: 160px;" data-toggle="tooltip" title="{{ Auth::user()->name }}">{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional)
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header"><center>OPCIONES</center></li>
            <li class="active"><a href="{{ url('/') }}"><i class='fa fa-tripadvisor'></i> <span>Inicio</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-university'></i> <span>Prestamo</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/prestamo') }}">Solicitar Prestamo</a></li>
                    <li><a href="{{ url('/prestamo/prestamossolicitados') }}">Prestamos Solicitados</a></li>
                    <li><a href="{{ url('/prestamo/prestamossolicitados/aprobados') }}">Prestamos Aprobados</a></li>
                    <li><a href="{{ url('/prestamo/prestamossolicitados/noaprobadosocancelados') }}">Prestamos Rechazados <br> o Cancelados</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-pie-chart'></i> <span>Reporte</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('/reporte/reportepdf') }}">Reporte Individual</a></li>
                    <li><a href="{{ url('/reporte/reportegeneral') }}">Reporte General</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
