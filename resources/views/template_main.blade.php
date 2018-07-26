<html style="height: auto;">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forlogic | Teste</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset("/bower_components/adminLTE/bootstrap/css/bootstrap.min.css") }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset("/bower_components/adminLTE/dist/css/AdminLTE.min.css") }}">
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

  <script src="{{ asset("bower_components/adminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>

  <link rel="stylesheet" href="{{ asset("/bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css") }}">

  <link rel="stylesheet" href="{{ asset("/bower_components/adminLTE/dist/css/skins/_all-skins.min.css") }}">

  <link rel="stylesheet" href="{{ asset("/bower_components/adminLTE/plugins/select2/select2.min.css") }}">

  <script src="https://pagead2.googlesyndication.com/pub-config/r20160913/ca-pub-4495360934352473.js"></script>

</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="skin-blue fixed sidebar-mini" style="height: auto;">
<!-- Site wrapper -->
<div class="wrapper" style="height: auto;">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>4gic</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>FOR</b>LOGIC</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 244px;"><section class="sidebar" style="height: 244px; overflow: hidden; width: auto;">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <span class="glyphicon glyphicon-user text-center" style="color: white; margin-left: 8px; margin-top: 5px;"></span>
        </div>
        <div class="pull-left info">
          <p>Kendy Hayashi</p>
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="/form_cadastro_clientes">
            <i class="fa fa-plus-square"></i> <span>Cadastrar Clientes</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/form_cadastro_avaliacao">
            <i class="fa fa-plus-square"></i> <span>Cadastrar Avaliacao</span>
          </a>
        </li>
        <li class="treeview">
          <a href="/lista_avaliacoes">
            <i class="fa fa-search"></i> <span>Resultados das Pesquisas</span>
          </a>
        </li>
      </ul>
    </section>
    <div class="slimScrollBar" style="background-color: rgba(0, 0, 0, 0.2); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; z-index: 99; right: 1px; height: 60.38133874239351px; background-position: initial initial; background-repeat: initial initial;">
    </div>
    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; background-color: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px; background-position: initial initial; background-repeat: initial initial;">
    </div>
  </div>
    <!-- /.sidebar -->
  </aside>
  </section>

  @yield('conteudo')
  <!-- =============================================== -->

</div>
<!-- /.content -->
</div>
<!-- ./wrapper -->


<!-- jQuery 2.2.3 -->
<script async="" src="//www.google-analytics.com/analytics.js"></script>

<script src="{{ asset("bower_components/adminLTE/plugins/jQuery/jquery-2.2.3.min.js") }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset("bower_components/adminLTE/bootstrap/js/bootstrap.min.js") }}"></script>
<!-- SlimScroll -->
<script src="{{ asset("bower_components/adminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
<!-- FastClick -->
<script src="{{ asset("bower_components/adminLTE/plugins/fastclick/fastclick.js") }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset("bower_components/adminLTE/dist/js/app.min.js") }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset("bower_components/adminLTE/dist/js/demo.js") }}"></script>

<script src="{{ asset("bower_components/adminLTE/plugins/select2/select2.full.min.js") }}"></script>

<script src="{{ asset("bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js") }}" ></script>

<script src="{{ asset("bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js") }}" ></script>

</body>
</html>
