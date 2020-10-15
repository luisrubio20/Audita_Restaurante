<?php
    require '../pages/conexion.php';
    $s =$_COOKIE["s"];
    
    $select = "SELECT DE_SECUENCIA,DE_FACTURA,RTRIM(AR_CODIGO) as codigo,DE_DESCRI,de_cantid as cantidad,DE_FECIMPRESION as impr,
    DE_TIPOCOC as tipo 
    FROM PVBDDECOCINA
    WHERE DE_FACTURA = '".$s."'
    order by de_factura,de_secuencia,de_tipococ";

$query = $pdo->query($select);
$datos = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($datos);
?>