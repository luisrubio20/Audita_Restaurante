<?php
if(!isset($_SESSION['login']) && $_SESSION['login'] == false){
    header('Location: login.php');
  } 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>
        <?= $titulo = isset($titulo) ? $titulo : 'Titulo' ?>
  </title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../Css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Theme style -->
  <link rel="stylesheet" href="../Css/AdminLTE.min.css"> 
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../Css/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="../Css/style.css">
  <link rel="stylesheet" href="../Css/Menu.css">
  <link rel="stylesheet" href="../Css/animacion.css">
  <link rel="stylesheet" href="../Css/botones.css">
  <link rel="stylesheet" href="../Dependencias/alertify/css/alertify.min.css">
  <link rel="stylesheet" href="../Css/btnfijo.css">
  <link rel="stylesheet" href="../Css/triangulo.css">
  <link rel="stylesheet" type="text/css" href="../Css/datatables.min.css"/> 
  <link rel="stylesheet" href="../Css/bootstrap-datepicker.min.css"> 
  <link rel="stylesheet" href="../Dependencias/multiselect.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Dependencias/FontAwesome/Css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.jqueryui.min.css">


  <style>

   #ModalTable { 
     background: #222d32;
   }

   #ModalTable h2,p{ 
     color: white;
   }

   .modal-header h2{
    color: white;
   }

   .close{
    color: #f00;
    text-shadow: 0 1px 0 #fff;
  }
  </style>
  

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
   
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>PROISA</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PROISA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
    
      <a href="#" id="MenuAbrir" class="sidebar-toggle" data-toggle="push-menu" role="button">
      
        <span class="sr-only">Toggle navigation</span>
        
      </a>
      <img src="" alt="">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../img/user.png" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
            </a>

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../img/user.png" class="img-circle" alt="User Image">
                <p>
                  Nombe Cliente
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../proccess/AuthProcess.php?logout=true" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
            
        </ul>
      </div>
    </nav>
  </header>
 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar sidebar-set">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../img/user.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Nombre</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
   
    
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Inicio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>

          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="Mesas_abiertas.php"><i class="fa fa-circle-o"></i>Mesas Abiertas</a></li>
            <li class="active"><a href="ordenes_en_cocina.php"><i class="fa fa-cutlery"></i>Ordenes en Cocina</a></li>
            <li class="active"><a href="comparativos_Costo_beneficio.php"><i class="fa fa-circle-o"></i>Comparativa Costo Beneficio</a></li>
            <li class="active"><a href="Reporte.php"><i class="fa fa-circle-o"></i>Reporte de Ventas</a></li>
            <li class="active"><a href="venta_por_categorias.php"><i class="fa fa-circle-o"></i>Ventas por Categorias</a></li>
            <li class="active"><a href="Ventas_Articulos.php"><i class="fa fa-circle-o"></i>Ventas por Articulos</a></li>
            <li class="active"><a href="ventas_horas.php"><i class="fa fa-circle-o"></i>Ventas por Horas</a></li>
            <li class="active"><a href="Ventas_por_Departamentos.php"><i class="fa fa-circle-o"></i>Ventas por Departamento</a></li>
            <li class="active"><a href="Resumen_Ventas.php"><i class="fa fa-circle-o"></i>Resumen Ventas</a></li>
            
          

          </ul>
        </li>
      <!-- divsion de header  <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Reportes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          </ul>
        </li> -->
      </ul>

    </section>

    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

     <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog  modal-lg" role="document">
    <div id="ModalTable" class="modal-content">
 
    </div>
  </div>
</div>   
   <!-- Modal -->