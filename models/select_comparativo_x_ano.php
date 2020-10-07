<?php

require '../pages/conexion.php';

$ano1 = $_POST['anio1'];
$ano2 = $_POST['anio2'];

$select = $pdo->query("SELECT *,
CASE WHEN MES = 1 THEN 'Enero'
    WHEN MES = 2 THEN 'Febrero'
    WHEN MES = 3 THEN 'Marzo'
    WHEN MES = 4 THEN 'Abril'
    WHEN MES = 5 THEN 'Mayo'
    WHEN MES = 6 THEN 'Junio'
    WHEN MES = 7 THEN 'Julio'
    WHEN MES = 8 THEN 'Agosto'
    WHEN MES = 9 THEN 'Setiempbre'
    WHEN MES =10 THEN 'Octubre'
    WHEN MES =11 THEN 'Noviembre'
    WHEN MES =12 THEN 'Diciembre' END AS MESL
FROM (
SELECT 
MONTH(HE_FECHA) AS MES,
SUM(CASE WHEN YEAR(HE_FECHA)='".$ano1."' THEN HE_NETO ELSE 0000000000.00 END) AS HE_NETO1,
SUM(CASE WHEN YEAR(HE_FECHA)='".$ano2."' THEN HE_NETO ELSE 0000000000.00 END) AS HE_NETO2,
SUM(HE_NETO) AS HE_NETO
FROM IVBDHEPE 
WHERE COD_EMPR=1 
GROUP BY MONTH(HE_FECHA)
) X
ORDER BY 1");

$value = $select->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($value);

?>