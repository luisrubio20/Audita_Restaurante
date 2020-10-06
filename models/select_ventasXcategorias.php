<?php
    require '../pages/conexion.php';
    $fec1 = $_POST['date'];
    $fec2 = $_POST['DateValue'];
    $departamento = $_POST['dept'];
    $filtro = $_POST['filtro'];
    
$ano = date('Y',strtotime($fec2));
$mes = date('m',strtotime($fec2));

    $CONDICION='';


        switch ($filtro) 
        {
            case $filtro == 'mes':
                $CONDICION= " WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0 and b.de_codigo = '{$departamento}' and YEAR(a.de_fecha)='".$ano."' AND MONTH(a.de_fecha)='".$mes."'";         
        break;
            case $filtro == "dia":
                $CONDICION =" WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0 and b.de_codigo = '{$departamento}' and a.de_fecha='".$fec2."'";

            break;

            case $filtro == "año":
                $CONDICION = " WHERE LEN(a.dE_TIPO)>0 and a.dE_cantid>=0 and b.de_codigo = '{$departamento}' and YEAR(a.de_fecha)='".$ano."'";

            break;  
          }


    $select = "SELECT  a.ar_codigo   
            ,SUM(A.DE_CANTID)CANTIDAD
            ,SUM(A.DE_PRECIO*(A.DE_CANTID))TOTAL
            ,ISNULL(b.de_codigo,'')de_codigo,ISNULL(b.ar_descri,'')ar_descri,ISNULL(c.ar_descri,'')departa
            ,ISNULL(b.ma_codigo,'')ma_codigo,ISNULL(d.ar_descri,'')categoria
        FROM ivbddepe as a 
            left join ivbdarti as b on a.ar_codigo=b.ar_codigo
            left join ivbddept as c on b.De_codigo=c.de_codigo
            left join ivbdmarc as d on b.ma_codigo=d.ma_codigo
        $CONDICION
        GROUP BY a.ar_codigo,b.de_codigo,b.ar_descri,c.ar_descri,b.ma_codigo,d.ar_descri
        order by b.ma_codigo,b.de_codigo,SUM(a.DE_CANTID)";
         
    $query = $pdo->query($select);
    $datos = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datos);

?>