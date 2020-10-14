<?php

require '../pages/conexion.php';

$fecha =  date_create_from_format('d/m/Y',$_POST['fecha']);
$fecha = date_format($fecha, 'Ymd'); 
$hora = $_POST['hora']; 


/*$fecha = '20190621';
$hora = '15'; */

$select = $pdo->query("SET NOCOUNT ON SELECT D.COD_EMPR, D.DE_FECHA, DATEPART(HH, H.HE_FECENT) AS HORA, D.AR_CODIGO, SUM(D.DE_CANTID - D.DE_CANDEV) AS DE_CANTID
INTO #TMP
FROM       IVBDDEPE D
INNER JOIN IVBDHEPE H ON H.COD_EMPR=D.COD_EMPR AND H.COD_SUCU=D.COD_SUCU AND H.HE_FACTURA=D.DE_FACTURA
WHERE LTRIM(RTRIM(D.AR_CODIGO))<>'' AND D.DE_CANTID>0 AND D.COD_EMPR=1 AND D.DE_FECHA= '".$fecha."' AND D.DE_FECHA= '".$fecha."' AND DATEPART(HH, H.HE_FECENT)='".$hora."' 
GROUP BY D.COD_EMPR, D.DE_FECHA, DATEPART(HH, H.HE_FECENT), D.AR_CODIGO
--SELECT * FROM #TMP

-- PASARLOS A COMPONENTES
SELECT A.COD_EMPR, A.DE_FECHA, A.HORA, B.OF_CODIGO AS AR_CODIGO,
       ROUND( (A.DE_CANTID * CASE WHEN B.OF_CANTID=0.0000 THEN 1.0000 ELSE B.OF_CANTID END), 4) AS DE_CANTID
INTO #TMP2
FROM #TMP A
INNER JOIN IVBDARTI C ON A.COD_EMPR=C.COD_EMPR AND A.AR_CODIGO=C.AR_CODIGO
INNER JOIN IVBDOFER B ON A.COD_EMPR=B.COD_EMPR AND A.AR_CODIGO=B.AR_CODIGO
WHERE C.AR_BULTO = 'S' AND C.AR_NOCOSTO = 1

-- UNIR LOS NO COMPONENTES
UNION ALL

SELECT A.COD_EMPR, A.DE_FECHA, A.HORA, A.AR_CODIGO, A.DE_CANTID * 1.0000
FROM #TMP A
INNER JOIN IVBDARTI C ON A.COD_EMPR=C.COD_EMPR AND A.AR_CODIGO=C.AR_CODIGO
LEFT  JOIN IVBDOFER B ON A.COD_EMPR=B.COD_EMPR AND A.AR_CODIGO=B.AR_CODIGO
WHERE C.AR_BULTO <> 'S' AND C.AR_NOCOSTO <> 1 AND B.AR_CODIGO IS NULL
--SELECT * FROM #TMP2

-- UNION DE LAS DOS CONSULTA ANTERIORES --
SELECT A.AR_CODIGO AS CODIGO, C.AR_DESCRI AS ARTICULO, A.DE_FECHA AS FECHA, A.HORA, SUM(A.DE_CANTID) AS CANTIDAD
Into #TMP3 FROM #TMP2 A
INNER JOIN IVBDARTI C ON A.COD_EMPR=C.COD_EMPR AND A.AR_CODIGO=C.AR_CODIGO
--WHERE 1=1
GROUP BY A.AR_CODIGO, C.AR_DESCRI, A.DE_FECHA, A.HORA

SELECT X.* FROM (
Select 1 CASO, * From #Tmp3

UNION ALL

Select 
   2 CASO,
   '' CODIGO,
   dbo.FN_DiaMes_L('S','E',FECHA) + ' ' + DATENAME(day,  FECHA) + ' ' +
   dbo.FN_DiaMes_L('M','E',FECHA) + ' ' + DATENAME(year, FECHA) + ' ' ARTICULO,
   FECHA,
   HORA,
   SUM(CANTIDAD) AS CANTIDAD
From #Tmp3 GROUP BY FECHA, HORA

UNION ALL

Select 
   3 CASO,
   '' CODIGO,
   dbo.FN_DiaMes_L('S','E',FECHA) + ' ' + DATENAME(day,  FECHA) + ' ' +
   dbo.FN_DiaMes_L('M','E',FECHA) + ' ' + DATENAME(year, FECHA) + ' ',
   FECHA,
   99 HORA,
   SUM(CANTIDAD) AS CANTIDAD
From #Tmp3 GROUP BY FECHA

UNION ALL

Select 
   4 CASO,
   '' CODIGO,
   'TOTAL GENERAL ' ARTICULO,
   '".$fecha."' FECHA,
   0 HORA,
   SUM(CANTIDAD) AS CANTIDAD
From #Tmp3 --GROUP BY FECHA


) X
ORDER BY X.FECHA, X.HORA, X.CASO");

$value = $select->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($value);



?>