<?php

require '../pages/conexion.php';


    $articulo = $_POST['articulo'];

    $select = $pdo->query("SELECT top 50 ar_codigo,ar_descri FROM ivbdarti where ar_codigo like '%$articulo%' ");
    $value = $select->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($value);


?>