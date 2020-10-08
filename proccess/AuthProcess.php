<?php 
require('../pages/CONEXION.PHP');

require('./Auth.php');
///require('./clases/Comando.php');

$auth = new Auth($pdo);


if(isset($_POST['config_pass'])){
    if($auth->loginConfig($_POST['config_pass'])){
        echo json_encode(['cod'=>'00','opt'=>$_POST['imp']]);
        exit();
    }
    echo json_encode(['cod'=>'01','msj'=>'Login false']);
    exit();
}


// Login 
if($auth->login($_POST['usuario'],$_POST['clave'])){
  
    if($auth->nivel == 'C'){
        header('Location: ../pages/Mesas_abiertas.php');
        $_SESSION['login'] = true;
    }else{
        header('Location: ../pages/Mesas_abiertas.php');
            $_SESSION['login'] = true;
    }


}else{
    header('Location: ../pages/login.php?auth=failed');
}


// Logout
if(isset($_GET['logout']) && $_GET['logout'] == true){
    $auth->logOut();
    header('Location: ../pages/login.php');
}

