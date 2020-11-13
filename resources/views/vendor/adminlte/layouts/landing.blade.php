<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }} ">
    <meta name="author" content="Julian Camilo Anzola Hincapie">

    <meta property="og:title" content="Adminlte-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="https://demo.adminlte.acacha.org" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" />

    <title>Naive Bayes</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/all-landing.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

</head>

<body data-spy="scroll" data-target="#navigation" data-offset="50">

<div id="app" v-cloak>
    <!-- Fixed navbar -->
    <div id="navigation" class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <b class="navbar-brand">Naive Bayes</b>
            </div>
            <div class="navbar-collapse collapse">
                <!--<ul class="nav navbar-nav">
                    <li class="active"><a href="#home" class="smoothScroll">{{ trans('adminlte_lang::message.home') }}</a></li>
                    <li><a href="#desc" class="smoothScroll">{{ trans('adminlte_lang::message.description') }}</a></li>
                    <li><a href="#showcase" class="smoothScroll">{{ trans('adminlte_lang::message.showcase') }}</a></li>
                    <li><a href="#contact" class="smoothScroll">{{ trans('adminlte_lang::message.contact') }}</a></li>
                </ul>-->
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                        <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    @else
                        <li><a href="/prestamo">{{ Auth::user()->name }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>


    <section id="home" name="home">
        <div id="headerwrap">
            <div class="container">
                <div class="row centered">
                    <div class="col-lg-12">
                        <h1 style="color: #000000;"><strong>Algoritmo Naive Bayes</strong></h1>
                        <h3>Naïve Bayes o el Ingenuo Bayes es uno de los algoritmos más simples y poderosos para la clasificación basado en el Teorema de Bayes con una suposición de independencia entre los predictores. Naive Bayes es fácil de construir y particularmente útil para conjuntos de datos muy grandes. </h3>
                        <h3><a href="http://scielo.sld.cu/scielo.php?script=sci_arttext&pid=S2227-18992017000400006" target="_blank" class="btn btn-lg btn-success">Mas Información</a></h3>
                    </div>
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <center><img class="img-responsive" src="{{ asset('/img/Imagen_Principal.jpg') }}" width="650"></center>
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
            </div> <!--/ .container -->
        </div><!--/ #headerwrap -->
    </section>

    <section id="desc" name="desc">
        <!-- INTRO WRAP -->
        <div id="intro">
            <div class="container">
                <div class="row centered">
                    <h1><strong>Proyecto Naive Bayes</strong></h1>
                    <br>
                    <br>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro01.png') }}" alt="">
                        <h3>Codigo</h3>
                        <p>Codigo creado y documentado donde se encuentra las funcionalidades del sistema.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro02.png') }}" alt="">
                        <h3>Articulo</h3>
                        <p>Articulo donde se puede ver toda la investigación sobre el algoritmo Naive Bayes.</p>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{ asset('/img/intro03.png') }}" alt="">
                        <h3>Diagramas</h3>
                        <p>Diagrama de clases y entidad relación de todo el sistema.</p>
                    </div>
                </div>
                <br>
                <hr>
            </div> <!--/ .container -->
        </div><!--/ #introwrap -->

        <!-- FEATURES WRAP -->
        <div id="features">
            <div class="container">
                <div class="row">
                    <h1 class="centered">¿Porque Aplicar Naive Bayes?</h1>
                    <br>
                    <br>
                    <div class="col-lg-6 centered">
                        <img class="centered" src="{{ asset('/img/mobile.png') }}" alt="">
                    </div>

                    <div class="col-lg-6">
                        <h3>Algoritmo Naive Bayes en prestamos</h3>
                        <br>
                        <!-- ACCORDION -->
                        <div class="accordion ac" id="accordion2">
                            <div class="accordion-group">
                                <div id="collapseOne" class="accordion-body collapse in">
                                    <div class="accordion-inner">
                                        <p style="text-align:justify;">Hoy en día, es muy importante predecir cuándo un cliente va a realizar un pago, predecir la probabilidad de que pague sus deudas y cuotas. Por lo tanto, es necesario que todo software que tiene como responsabilidad administrar todo el apartado financiero de una empresa de libranzas, implemente en su proceso de gestión de préstamos un algoritmo de predicción el cual le permita obtener una probabilidad, para determinar qué tan viable y rentable será prestar cierta cantidad de dinero. Vale la pena mencionar que Cada cliente tiene características únicas que lo representan, con estas características una empresa puede predecir comportamientos como el monto máximo de un préstamo o incluso qué pagos realizará y en qué fechas se retrasará.</p>
                                        <p style="text-align:justify;">Se Infiere que todos los algoritmos son tan precisos como los datos que se le den, por consiguiente se deduce que el algoritmo Naive Vaye ofrece gran rendimiento para calcular probabilidades teniendo en cuenta una serie de parámetros que cada libranza debe proporcionar, esto quiere decir que una vez un cliente solicite un préstamo a dicho cliente se le aplica el algoritmo Naive Vaye y de esta manera se predice la probabilidad que tiene el cliente de cancelar o no un préstamo de libranza.</p>
                                    </div><!-- /accordion-inner -->
                                </div><!-- /collapse -->
                            </div><!-- /accordion-group -->
                            <br>
                        </div><!-- Accordion -->
                    </div>
                </div>
            </div><!--/ .container -->
        </div><!--/ #features -->
    </section>

    <section id="showcase" name="showcase">
        <div id="showcase">
            <div class="container">
                <div class="row">
                    <h1 class="centered">Aplicación en Funcionamiento</h1>
                    <br>
                    <div class="col-lg-8 col-lg-offset-2">
                        <div id="carousel-example-generic" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" style="background-color: #000000;" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1" style="background-color: #000000;"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2" style="background-color: #000000;"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="3" style="background-color: #000000;"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="{{ asset('/img/Funcionamiento1.png') }}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('/img/Funcionamiento2.png') }}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('/img/Funcionamiento3.png') }}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{ asset('/img/Funcionamiento4.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <br>
            </div><!-- /container -->
        </div>
    </section>
    <footer>
        <div id="c">
            <div class="container">
                <p>
                    <a href="https://github.com/acacha/adminlte-laravel"></a>Proyecto desarrollado en Laravel 7 con bootstrap como complemento grafico.<br/>
                    <strong>Copyright &copy; 2020 <a href="http://www.uniminuto.edu/web/bogota-presencial" target="_blank">uniminuto.edu.co</a>.</strong> {{ trans('adminlte_lang::message.createdby') }} <a>Julian Camilo Anzola Hincapie</a>. Free Software License.
                    <br/>
                </p>

            </div>
        </div>
    </footer>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ url (mix('/js/app-landing.js')) }}"></script>
<script>
    $('.carousel').carousel({
        interval: 3500
    })
</script>
</body>
</html>
