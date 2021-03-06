<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php 

   require 'conexion.php';
   include '../proccess/config.php';

    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
        header('Location: Mesas_abiertas.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Proisa | Inicio de sesion</title>
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Proisa">
  <link rel="apple-touch-startup-image" href="img/icon/apple-touch-icon-180x180.png">

  <link rel="shortcut icon" href="<?=url_base()?>/img/icon/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="<?=url_base()?>../img/apple-touch-icon-180x180.png" />
  <link rel="apple-touch-icon" sizes="57x57" href="<?=url_base()?>../im/gapple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="<?=url_base()?>../img/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?=url_base()?>../img/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="<?=url_base()?>../img/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="<?=url_base()?>../img/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="<?=url_base()?>../img/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="<?=url_base()?>../img/apple-touch-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?=url_base()?>../img/apple-touch-icon-180x180.png" />

  <link rel="apple-touch-icon-precomposed" sizes="128x128" href="niceicon.png">

  <link rel="manifest" href="manifest.json">
  <link rel="icon" sizes="192x192" href="<?=url_base()?>../img/apple-touch-icon-180x180.png">
  <link rel="icon" sizes="128x128" href="<?=url_base()?>../img/apple-touch-icon-120x120.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../Css/Bootstrap3/bootstrap.min.css">
  <!-- Font Awesome -->
 <!-- <link rel="stylesheet" href="font-awesome.min.css"> -->  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <!-- Ionicons -->
  <link rel="stylesheet" href="../Css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../Css/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
      #config_form {
        display:none;
      }
    </style>
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?=getData()['name']?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div id="login_form">
    <p class="login-box-msg">Inicio de sesion</p>
    <form action="../proccess/AuthProcess.php" method="post" enctype="multipart/form-data" target="_blank">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name='usuario' placeholder="Usuario">
        <span class=" form-control-feedback"><i class="fas fa-envelope"></i> </span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="clave" placeholder="Clave">
        <span class="form-control-feedback"><i class="fas fa-lock"></i>  </span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" id="init" class="btn btn-primary btn-block btn-flat">Entrar <i class="fa  fa-arrow-right"></i> </button><br>
      <!--    <a href="config_form.php" id="config" class="btn btn-default btn-block">Configuracion <i class="fa fa-gear"></i></a> -->
          <?php if(isset($_GET['auth']) && $_GET['auth'] == 'failed'): ?> 
          <hr>
          <div class="alert alert-danger">
              <h4>
                  <i class="fa fa-ban"></i> Error de acceso
              </h4>
              Usuario o clave incorrecto
          </div>
            <?php endif;?>
        </div>
        <!-- /.col -->
      </div>
    </form>
    </div>

    <hr>
    <img src="../img/logo.jpg" width="100%">
  </div>
  <!-- /.login-box-body -->

</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="../Funciones/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../Funciones/bootstrap.min.js"></script>
<script>
btn = document.getElementById('init');

btn.addEventListener('click', ()=>{
    window.close();
})
</script>
</body>
</html>





</body>
</html>