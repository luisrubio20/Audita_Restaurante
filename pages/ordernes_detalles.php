<?php
    require 'conexion.php';
    $s =$_COOKIE["s"];
    
    $select = "SELECT TOP 50 RIGHT('0000000000'+RTRIM(LTRIM(HE_SECUENCIA)),10) AS secuencia
    ,RTRIM(LTRIM(a.HE_FACTURA)) AS orden
    ,RTRIM(CONVERT(CHAR,a.HE_HORA,0)) AS hora
    ,a.MA_CODIGO
    ,isnull(b.mo_descri,'')mo_descri
    ,
            'SEC.: '++'   '+
            'ORDEN: '+RTRIM(LTRIM(a.HE_FACTURA))+'   '+
            'HORA: '++'  '+CL_NOMBRE CAMPO,
    
    RIGHT('0000000000'+RTRIM(LTRIM(HE_SECUENCIA)),10)+RTRIM(LTRIM(a.HE_FACTURA)) AS SECORD
    ,CASE WHEN a.MA_CODIGO='DL' THEN 1 ELSE 0 END DELY
    ,a.*,ISNULL(b.mo_descri,'')mo_descri,ISNULL(b2.mo_descri,'')mo_descri2,isnull(HE_DIRE1,'')HE_DIRE1,isnull(HE_DIRE2,'')HE_DIRE2
    FROM pvbdhecocina as a 
        left join pvbdmozo as b on a.mo_codigo=b.mo_codigo
        left join pvbdmozo as b2 on a.mo_codigo2=b2.mo_codigo
        left join ivbdhedely as h on a.HE_FACTURA=h.HE_FACTURA
    WHERE a.HE_MODO='' and HE_SECUENCIA= '".$s."'  ORDER BY HE_SECUENCIA";

$query = $pdo->query($select);
$datos = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="modal-header">
       <h2>Detalle(s) De Factura</h2>
       
       <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-arrow-left"></i></button>
    </div>
    <div id="ModalTable" class="modal-body">
    <div class="table-responsive bg-w p-3">
   
    <table class="table" id="myTable">
        <thead class="thead-dark">
            <th>Sencuencia</th>
            <th>Nombre</th>
            <th>Hora</th>
            <th>Camarero</th>
        </thead>
        <tbody id="tablero">
            <tr>
            <td><?= $datos[0]['secuencia'] ?></td>
            <td><?=  $datos[0]['CL_NOMBRE'] ?></td>
            <td><?=  $datos[0]['hora'] ?></td>
            <td><?=  $datos[0]['mo_descri'] ?></td>
                </tr>
        </tbody>
        <tfoot> 
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tfoot> 
    </table>

   
   
    </div>
     <br>                     
     <button  data-dismiss="modal" class="btn btn-primary btn-block btn-lg">Cerrar</button>
     </div>  
