<?php
    require '../pages/conexion.php';
    $fecha1 = $_POST['fecha1'];
    $fecha2 = $_POST['fecha2'];
    $fecha3 = $_POST['fecha3'];
    $fecha4 = $_POST['fecha4'];

    $select = "SELECT
        ISNULL(SUM(CASE WHEN HE_FECHA = '{$fecha1}' THEN HE_NETO ELSE 0000000000.00 END), 0.00) AS HE_NETO_I,
        ISNULL(SUM(CASE WHEN HE_FECHA ='{$fecha2}' THEN HE_NETO ELSE 0000000000.00 END), 0.00) AS HE_NETO_F,
        ISNULL(SUM(CASE WHEN HE_FECHA ='{$fecha3}' THEN HE_NETO ELSE 0000000000.00 END), 0.00) AS HE_NETO_FS,
        ISNULL(SUM(CASE WHEN HE_FECHA ='{$fecha4}' THEN HE_NETO ELSE 0000000000.00 END), 0.00) AS  HE_NETO_F4
        FROM IVBDHEPE WHERE COD_EMPR=1 AND (HE_FECHA ='{$fecha1}' OR HE_FECHA = '{$fecha2}' OR HE_FECHA = '{$fecha3}' OR HE_FECHA = '{$fecha4}')";

         
    $query = $pdo->query($select);
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);



?>