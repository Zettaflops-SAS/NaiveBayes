<?php

/**
*Ruta encargada de cargar todas las rutas encargadas de manejar el sistema de login
*/
Auth::routes();

/**
*Ruta encargada de cargar la vista principal de la pagina
*/

Route::get('/', function () {
    return view('welcome');
});


//-------------------Esta sección se encarga de toda la administracion con respecto al prestamo------------------------------------
/**
*Ruta encargada de cargar la vista donde se puede ingresar la informacion para solicitar el credito
*/
Route::get('/prestamo', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Prestamo')->name('prestamo.mensaje');

/**
*Esta ruta recibe la información del formulario donde se solicita el prestamo
*/
Route::post('/prestamo/solicitud', 'CMGN_Controlador_Prestamo@Solicitar_Credito');

/**
*Ruta encargada de cargar la vista donde se puede ver los prestamos solicitados
*/
Route::get('/prestamo/prestamossolicitados', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Solicitud_Prestamos')->name('prestamossolicitados.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver los fallos de la vista de prestamos solicitados
*/
Route::get('/prestamo/prestamossolicitados/fallos', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Prestamo_Fallos')->name('prestamossolicitadosfallos.mensaje');

/**
*Ruta encargada de recibir la información del cliente para filtrar los prestamos solicitados
*/
Route::post('/prestamo/prestamossolicitados/consultaprestamossilicitados', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Solicitud_Prestamos_Filtrados');

/**
*Ruta encargada de cargar la vista donde se puede ver los prestamos aprobados
*/
Route::get('/prestamo/prestamossolicitados/aprobados', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Prestamo_Aprobado')->name('prestamosaprobados.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver los fallos de la vista de prestamos aprobados
*/
Route::get('/prestamo/prestamosaprobados/fallos', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Prestamo_Aprobados_Fallos')->name('prestamosaprobadosfallos.mensaje');

/**
*Ruta encargada de recibir la información del cliente para filtrar los prestamos aprobados
*/
Route::post('/prestamo/prestamosaprobados/consultaprestamosaprobados', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Aprobados_Prestamos_Filtrados');

/**
*Ruta encargada de cargar la vista donde se puede ver los prestamos no aprobados y los prestamos ya cancelados en su totalidad
*/
Route::get('/prestamo/prestamossolicitados/noaprobadosocancelados', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Prestamo_No_Aprobado_O_Cancelado')->name('noaprobadosocancelados.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver los fallos de la vista de prestamos no aprobados o prestamos cancelados
*/
Route::get('/prestamo/prestamosnoaprobadosocancelados/fallos', 'CMGN_Controlador_Prestamo@Mostrar_Vista_Prestamo_No_Aprobados_O_Cancelados_Fallos')->name('prestamosnoaprobadosocanceladosfallos.mensaje');

/**
*Ruta encargada de recibir la información del cliente para filtrar los prestamos no aprobados o cancelados
*/
Route::post('/prestamo/prestamosnoaprobadosocancelados/consultaprestamosnoaprobadosocancelados', 'CMGN_Controlador_Prestamo@Mostrar_Vista_No_Aprobados_O_Cancelados_Prestamos_Filtrados');

//----------------------------------------------------Fin de la seccion----------------------------------------------------------------

//-------------------Esta sección se encarga de toda la administracion con respecto a las estadisticas del algoritmo------------------------------------

/**
*Ruta encargada de cargar la vista donde se puede ver las estadisticas obtenidas de la aplicación del algoritmo Naive Bayes
*/
Route::get('/algoritmo/{IdPrestamo}', 'CMGN_Controlador_Algoritmo@Mostar_Vista_Estadistica_Algoritmo')->name('algoritmo.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver los fallos que ocurrieron cuando se aplico el algoritmo Naive Bayes
*/
Route::get('/algoritmo/fallos/algoritmo', 'CMGN_Controlador_Algoritmo@Mostrar_Vista_Algoritmo_Fallos')->name('fallos.mensaje');

//----------------------------------------------------Fin de la seccion----------------------------------------------------------------


//-------------------Esta sección se encarga de toda la administracion con respecto a la amortización------------------------------------

/**
*Ruta encargada de aprobar el prestamo y generar la amortizacion
*/
Route::get('/amortización/aprobar/{IdPrestamo}/{ValorPrestamo}/{InteresPrestamo}/{PlazoPrestamo}/{CuotaPrestamo}', 'CMGN_Controlador_Amortizacion@Calcular_Amortizacion')->name('aprobaramortizacion.mensaje');

/**
*Ruta encargada de no aprobar el prestamo
*/
Route::get('/amortización/noaprobar/{IdPrestamo}', 'CMGN_Controlador_Amortizacion@Negar_Solicitud_Credito')->name('noaprobaramortizacion.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver la amortizacón creada despues de la aprobación del prestamo
*/
Route::get('/amortización/{IdPrestamo}', 'CMGN_Controlador_Amortizacion@Mostrar_Vista_Amortización')->name('amortización.mensaje');

/**
*Ruta encargada de realizar el pago de la cuota del prestamo
*/
Route::get('/amortización/pagocuota/{IdAmortizacion}', 'CMGN_Controlador_Amortizacion@Pagar_Couta_Prestamo')->name('pagocuota.mensaje');

//----------------------------------------------------Fin de la seccion----------------------------------------------------------------

//-------------------Esta sección se encarga de toda la administracion con respecto a los reportes individuales------------------------------------

/**
*Ruta encargada cargar la vista donde se puede ver todos los prestamos aprobados para posteriormente
*realizar el descargue de la información del prestamo del clientes
*/
Route::get('/reporte/reportepdf', 'CMGN_Controlador_Reporte@Mostrar_Vista_Prestamos_Aprobados_Reporte_PDF')->name('reportepdf.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver los fallos que ocurrieron cuando se intento traer ls información
*de los prestamos aprobados pero que tambien se usan para realizar reportes
*/
Route::get('/reporte/fallos/reportepdf', 'CMGN_Controlador_Reporte@Mostrar_Vista_Prestamo_Aprobados_Reporte_Fallos')->name('reportepdffallos.mensaje');

/**
*Ruta encargada de descargar el pdf con la información del prestamo del cliente
*/
Route::get('/reporte/reportepdf/descargarpdf/{IdPrestamo}', 'CMGN_Controlador_Reporte@Descargar_Informacion_Prestamo_PDF')->name('descargarpdf.mensaje');

/**
*Ruta encargada de recibir la información del cliente para filtrar los prestamos aprobados
*para realizar el cargue de la información en el pdf
*/
Route::post('/reporte/prestamosaprobados/consultaprestamoaprobadosreporte', 'CMGN_Controlador_Reporte@Mostrar_Vista_Prestamos_Aprobados_Reporte_Filtrados');

//----------------------------------------------------Fin de la seccion----------------------------------------------------------------

//-------------------Esta sección se encarga de toda la administracion con respecto a los reportes generales------------------------------------

/**
*Ruta encargada cargar la vista donde se puede ver el reporte general
*/
Route::get('/reporte/reportegeneral', 'CMGN_Controlador_Reporte@Mostrar_Vista_Reporte_Grafico_General')->name('reportegeneral.mensaje');

/**
*Ruta encargada de cargar la vista donde se puede ver los fallos que ocurrieron cuando se intento
*gráficar el reporte general
*/
Route::get('/reporte/fallos/reportegeneral', 'CMGN_Controlador_Reporte@Mostrar_Vista_Reporte_Grafico_General_Fallos')->name('reportegeneralfallos.mensaje');

//----------------------------------------------------Fin de la seccion----------------------------------------------------------------


































































Route::get('/temporal', 'CMGN_Controlador_Algoritmo@temporal')->name('temporal.mensaje');