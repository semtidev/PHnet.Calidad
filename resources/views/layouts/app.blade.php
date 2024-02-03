<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PHnet - Calidad</title>
    <link rel="shortcut icon" href="{{ asset('dist/img/icons/favicon.ico') }}" />

    <!-- ExtJS v4.2 -->
    <link href="{{ asset('extjs42/resources/css/ext-all-neptune.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('extjs42/includes/shared/messages.css') }}" />
    <!-- Font Awesome Icons v5 -->
    <link href="{{ asset('dist/fa-563/css/all.css') }}" rel="stylesheet">
    <!-- Bootstrap v2.2.2 -->
    <link type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <!-- Theme -->
    <link type="text/css" href="{{ asset('dist/css/theme.css') }}" rel="stylesheet">
    <!-- App -->
    <link type="text/css" href="{{ asset('dist/css/phnet.css') }}" rel="stylesheet">
</head>

<body onLoad="javascript: var mask = document.getElementById('loading-mask'); mask.remove(0);">
<div id="loading-mask">
  <div class="message">
    <div class="animation"><i class="fas fa-cog fa-spin"></i></div>
    <div class="text1">PHnet Calidad</div>
    <div class="text2">Cargando Sistema...</div>
  </div>
</div>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
      <div class="container-fluid">
          <a class="brand" href="index.html" style="padding-left:90px"><img src="{{ asset('dist/img/icons/logo-home.jpg') }}" alt="" width="48" style="position:absolute; top: 10px; left:25px;">UBPH</a>
          <div>
              <ul class="nav nav-icons">
                  <li id="lnk-home">
                    <a title="Inicio"><i class="fas fa-home"></i></a>
                  </li>
                  <!--
                  <li id="lnk-notify">
                    <a title="Notificaciones"><i class="fas fa-bell"></i></a>
                  </li>
                  <li id="lnk-chart">
                    <a title="Gr&aacute;ficas"><i class="fas fa-chart-line"></i></a>
                  </li>
                  -->
                  @auth
                  @if (Auth::user()->rol == 'Administrador')
                  <li id="lnk-config">
                    <a title="Configuraci&oacute;n"><i class="fas fa-cog"></i></a>
                  </li>
                  @endif
                  @endauth
              </ul>
              <ul class="nav pull-right">
                  <li id="dropdown-quality" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                      Calidad <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Metrolog&iacute;a</li>
                        <li>
                          <a id="lnk-equipments" title="Control de Instrumentos de Medici&oacute;n">
                            <i class="fas fa-tachometer-alt"></i> Instrumentos
                          </a>
                        </li>
                        <li>
                          <a id="lnk-planning" title="Control de Instrumentos de Medici&oacute;n">
                            <i class="fas fa-calendar-alt"></i> Plan de Calibraci&oacute;n
                          </a>
                        </li>
                        @auth
                        <li>
                          <a id="lnk-metroregister" title="Plantilla de Instrumentos de Medici&oacute;n UBPH">
                            <i class="fas fa-file-pdf" style="font-size:15px"></i> Plantilla I.M. UBPH
                          </a>
                        </li>
                        <li>
                          <a id="lnk-planningubph" title="Plan de Calibración UBPH del a&ntilde;o">
                            <i class="fas fa-file-pdf" style="font-size:15px"></i> Plan Calibraci&oacute;n UBPH
                          </a>
                        </li>
                        @endauth
                        <li class="divider"></li>
                        <li class="nav-header">Satisfacci&oacute;n</li>
                        <li>
                          <a id="lnk-intcustomers" title="Control de Encuestas">
                            <i class="fas fa-user-friends"></i> Clientes Internos
                          </a>
                        </li>
                        <li>
                          <a id="lnk-extcustomers" title="Control de Encuestas">
                            <i class="fas fa-user-friends"></i> Clientes Externos
                          </a>
                        </li>
                        @auth
                        <li>
                          <a id="lnk-pdfintpoll" title="An&aacute;lisis de Encuestas Cliente Interno del mes actual">
                            <i class="fas fa-file-pdf" style="font-size:15px"></i>&nbsp; An&aacute;lisis Encuestas C.I.
                          </a>
                        </li>
                        @endauth
                        <li class="nav-header">No Conformidades</li>
                        <li>
                          <a href="http://192.168.10.98/qse/" target="_blank" title="Fichas de No Conformidad">
                            <i class="fas fa-exclamation-triangle"></i> Sistema Gestor FNC
                          </a>
                        </li>
                    </ul>
                  </li>

                  <li id="dropdown-phnet" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                      PHnet <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Sistemas</li>
                        <li>
                          <a href="http://192.168.10.219/phnet.cmi" target="_blank" title="Cuadro de Mando Integral">
                            <i class="fas fa-tachometer-alt"></i> PHnet CMI
                          </a>
                        </li>
                        <li>
                          <a href="http://localhost/phnet.compras/public" target="_blank" title="Sistema de Gesti&oacute;n Comercial">
                            <i class="fas fa-shopping-cart"></i> PHnet Compras
                          </a>
                        </li>
						<li>
                          <a href="http://localhost/phnet.trabajador/public" target="_blank" title="Sistema de Gesti&oacute;n Comercial">
                            <i class="fas fa-shopping-cart"></i> PHnet Trabajador
                          </a>
                        </li>
                        <li>
                          <a href="http://localhost/phnet.calidad/public" target="_blank" title="Control de Par&aacute;metros Productivos">
                            <i class="fas fa-hotel"></i> PHnet Producci&oacute;n
                          </a>
                        </li>
                        <li>
                          <a href="http://localhost/phnet.calidad/public" target="_blank" title="Sistema de Planificaci&oacute;n Estrat&eacute;gica">
                            <i class="fas fa-paper-plane"></i> PHnet Planificaci&oacute;n
                          </a>
                        </li>
                        <li>
                          <a href="http://localhost/phnet.calidad/public" target="_blank" title="Control de Contratos Ejecutivos">
                            <i class="fas fa-handshake"></i> PHnet Contrataci&oacute;n
                          </a>
                        </li>
                    </ul>
                  </li>

                  @auth
                  <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <img src="{{ asset('dist/img/users/' .Auth::user()->photo. '.jpg') }}" class="nav-avatar" />
                      <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a id="lnk-userprofile"><i class="fas fa-user text-primary mr-2"></i> Perfil de Usuario</a></li>
                          <li><a id="lnk-userpassword"><i class="fas fa-key text-primary mr-2"></i> Cambiar Contrase&ntilde;a</a></li>
                          <li class="divider"></li>
                          <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <i class="fas fa-sign-out-alt text-primary mr-2"></i> {{ __('Cerrar Sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                          </li>
                      </ul>
                  </li>
                  @endauth
                  @guest
                  <li>
                    <a href="login" title="Acceso como usuario del Sistema"><i class="fas fa-user-circle fa-lg text-green" style="font-size:22px; margin-top:2px"></i></a>
                  </li>
                  @endguest
              </ul>
          </div>
          <!-- /.nav-collapse -->
      </div>
  </div>
  <!-- /navbar-inner -->
</div>
<!-- /navbar -->

@yield('content')

<div class="footer">
  <div class="container-fluid">
    <div style="float:left; width:auto;">
      <b class="copyright">ECM4 - UBPH </b>Servicios Inform&aacute;ticos {{ date('Y') }}.
    </div>
    <div style="float:right; width:auto;">
      Plataforma de Gesti&oacute;n&nbsp;<b class="copyright">PHnet - Calidad</b>&nbsp;&nbsp;|&nbsp;&nbsp;Versi&oacute;n 1.0
    </div>
  </div>
</div>

<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('extjs42/ext-all.js') }}"></script>
<script src="{{ asset('extjs42/locale/ext-lang-es.js') }}"></script>
<script src="{{ asset('extjs42/ext-theme-neptune.js') }}"></script>
<script type="text/javascript" src="{{ asset('extjs42/includes/shared/messages.js') }}"></script>

<script src="{{ asset('dist/js/jquery-2.2.3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/js/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  let auth = false;
  @auth
    auth = true;
    localStorage.setItem('userid', '{{ Auth::user()->id }}');
    localStorage.setItem('username', '{{ Auth::user()->name }}');
    localStorage.setItem('userrol', '{{ Auth::user()->rol }}');
    localStorage.setItem('userphoto', '{{ Auth::user()->photo }}');
  @endauth
  @guest
    localStorage.removeItem('userid');
    localStorage.removeItem('username');
    localStorage.removeItem('userrol');
    localStorage.removeItem('userphoto');
    localStorage.removeItem('profile_metroplan_change');
  @endguest
</script>
<script src="{{ asset('dist/js/app.js') }}" type="text/javascript"></script>

</body>
</html>