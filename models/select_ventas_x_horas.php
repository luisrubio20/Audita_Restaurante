<?php 

require '../pages/conexion.php';
$fecha =  date_create_from_format('d/m/Y',$_POST['fecha']);
$fecha = date_format($fecha, 'Ymd'); 


$select = $pdo->query("SELECT hE_FECHA as fecha, DATEPART(HH, HE_FECENT) AS hora_24,
dbo.FN_DT_H_AMPM(HE_FECENT) AS hora, 
SUM(he_neto) AS monto
from IVBDHEPE where HE_FECHA='".$fecha."'
group by HE_FECHA, DATEPART(HH, HE_FECENT),dbo.FN_DT_H_AMPM(HE_FECENT)");

$value = $select->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($value);
?>





