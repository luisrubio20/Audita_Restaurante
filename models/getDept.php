<?php
    require '../pages/conexion.php';
    $select = 'SELECT de_codigo,ar_descri FROM ivbddept';
    
    $query = $pdo->query($select);
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);


?>