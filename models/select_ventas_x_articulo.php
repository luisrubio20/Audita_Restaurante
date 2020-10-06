<?php
ini_set('max_execution_time', 300); 
require '../pages/conexion.php';


isset($_SESSION['fecha2']) ? $fecha= date_create_from_format('d/m/Y', $_SESSION['fecha2']) : $fecha = "";  
isset($_SESSION['articulo2']) ? $articulo = $_SESSION['articulo2'] : $articulo = $_SESSION['articulo2'] = "";
isset($_SESSION['dias2']) ? $dia = $_SESSION['dias2'] : $dia = $_SESSION['dias2'] = "";
$fecha = date_format($fecha, 'Ymd');
$ano = date('Y', strtotime($fecha));
$mes = date('m', strtotime($fecha));


switch($dia)
{

case $dia == "dias":
  
    if($articulo == "TODOS")
    {
        $CONDICION ="WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0  and a.DE_FECHA='".$fecha."'";
    }
    else
    {
        $CONDICION ="WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0  and a.DE_FECHA='".$fecha."' AND b.ar_codigo='".$articulo."'";
    }
break;

    case $dia == "mes":
  
        if($articulo == "TODOS")
        {
            $CONDICION ="WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0  and year(a.DE_FECHA)='".$ano."' and month(a.DE_FECHA)='".$mes."'";
        }
        else
        {
            $CONDICION ="WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0  and year(a.DE_FECHA)='".$ano."' AND month(a.DE_FECHA)='".$mes."' and b.ar_codigo='".$articulo."'";
        }
    break;

    case $dia == "ano":
  
        if($articulo == "TODOS")
        {
            $CONDICION ="WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0  and year(a.DE_FECHA)='".$ano."'";
        }
        else
        {
            $CONDICION ="WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0  and year(a.DE_FECHA)='".$ano."' and b.ar_codigo='".$articulo."'";
        }

    break;

}

//echo $CONDICION;

$select = $pdo->query("SELECT  a.ar_codigo
,SUM(CASE WHEN A.MA_CODIGO<>'DL' THEN A.DE_CANTID ELSE 0 END)VALOR1
,SUM(CASE WHEN A.MA_CODIGO ='DL' THEN A.DE_CANTID ELSE 0 END)VALOR1DL
,SUM(A.DE_COSTO*(A.DE_CANTID))VALOR2
,SUM(CASE WHEN A.MA_CODIGO<>'DL' THEN A.DE_PRECIO*(A.DE_CANTID) ELSE 0 END)VALOR3
,SUM(CASE WHEN A.MA_CODIGO ='DL' THEN A.DE_PRECIO*(A.DE_CANTID) ELSE 0 END)VALOR3DL
,ISNULL(b.ar_descri,'')ar_descri
FROM ivbddepe as a
left join ivbdarti as b on a.ar_codigo=b.ar_codigo $CONDICION
GROUP BY a.ar_codigo,b.de_codigo,b.ar_descri
order by b.de_codigo,SUM(a.DE_CANTID)");
$cuenta = $select->rowCount();



$value = $select->fetchAll(PDO::FETCH_ASSOC);

$totalvalor1=0;
$totalvalor1DL=0;
$totalvalor3=0;
$totalvalor3dl=0;
$totalgeneral=0;
foreach($value as $key => $fila):

    $totalvalor1 += $fila['VALOR1'];
    $totalvalor1DL += $fila['VALOR1DL'];
    $totalvalor3 += $fila['VALOR3'];
    $totalvalor3dl+= $fila['VALOR3DL'];
    $totalgeneral += $fila['VALOR3'] +  $fila['VALOR3DL'];
     //$total =  $fila['VALOR3'] +  $fila['VALOR3DL'];
    ?>

    <tr>
    <td><?= $fila['ar_codigo']; ?></td>
    <td><?= $fila['ar_descri']; ?></td>
    <td><?= number_format($fila['VALOR1'],2); ?></td>
    <td><?= number_format($fila['VALOR1DL'],2); ?></td>
    <td><?=  number_format($fila['VALOR3'],2); ?></td>
    <td><?= number_format($fila['VALOR3DL'],2); ?></td>
    <td><?=number_format($fila['VALOR3']+$fila['VALOR3DL'],2)?></td>
    </tr>


<?php endforeach ?>

<?php if($cuenta == 0)
{
    return;
}
else
{

?>

<tr>
    <td></td>
    <th>TOTALES</th>
    <th><?= number_format($totalvalor1,2); ?></th>
    <th><?= number_format($totalvalor1DL,2); ?></th>
    <th><?= number_format($totalvalor3,2); ?></th>
    <th><?= number_format($totalvalor3dl,2); ?></th>
    <th><?= number_format($totalgeneral ,2); ?></th>
</tr>

<?php } ?>