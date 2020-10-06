<?php
session_start();

$fecha =  $_POST['fecha'];
$articulo = $_POST['articulo'];
$dias = $_POST['dias'];

$_SESSION['dias2'] = $dias;
$_SESSION['articulo2'] = $articulo;
$_SESSION['fecha2'] = $fecha;




?>
