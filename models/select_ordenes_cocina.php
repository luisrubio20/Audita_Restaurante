<?php
    require '../pages/conexion.php';
    
    $select = "SELECT TOP 50 RIGHT('0000000000'+RTRIM(LTRIM(HE_SECUENCIA)),10) AS secuencia
    ,RTRIM(LTRIM(a.HE_FACTURA)) AS orden
    ,RTRIM(CONVERT(CHAR,a.HE_HORA,0)) AS hora
    ,CONVERT(DATE,a.HE_FECHA) as fecha     
    ,a.MA_CODIGO
    ,isnull(b.mo_descri,'')mo_descri
    ,
            'SEC.: '++'   '+
            'ORDEN: '+RTRIM(LTRIM(a.HE_FACTURA))+'   '+
            'HORA: '++'  '+CL_NOMBRE CAMPO,
    
    RIGHT('0000000000'+RTRIM(LTRIM(HE_SECUENCIA)),10)+RTRIM(LTRIM(a.HE_FACTURA)) AS SECORD
    ,CASE WHEN a.MA_CODIGO='DL' THEN 1 ELSE 0 END DELY
    ,ISNULL(b.mo_descri,'')mo_descri,ISNULL(b2.mo_descri,'')mo_descri2,isnull(HE_DIRE1,'')HE_DIRE1,isnull(HE_DIRE2,'')HE_DIRE2
    ,a.CL_NOMBRE
    FROM pvbdhecocina as a 
        left join pvbdmozo as b on a.mo_codigo=b.mo_codigo
        left join pvbdmozo as b2 on a.mo_codigo2=b2.mo_codigo
        left join ivbdhedely as h on a.HE_FACTURA=h.HE_FACTURA
    WHERE a.HE_MODO='' ORDER BY HE_SECUENCIA";

$query = $pdo->query($select);
$datos = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($datos);
?>