<?php
ini_set('max_execution_time', 300); 

    require '../pages/conexion.php';
    $anio = $_COOKIE['fecha'];

    $select = "SELECT month(de_fecha) as mes ,SUM(de_cantid*de_precio) as total,SUM(de_cantid*de_costo) as costo,
    (SUM(de_cantid*de_precio)-SUM(de_cantid*de_costo)) AS beneficio
     from ivbddepe 
    where year(DE_FECHA)='{$anio}'
    and de_cantid > 0
    group by month(de_fecha) "; 

    
    $query = $pdo->query($select);
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);
?>