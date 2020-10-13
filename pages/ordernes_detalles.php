<?php
    require 'conexion.php';
    $s =$_COOKIE["s"];
    
    $select = "SELECT DE_SECUENCIA AS secuencia ,DE_FACTURA as CL_NOMBRE,AR_CODIGO AS hora ,DE_DESCRI as mo_descri,de_cantid as cantidad,DE_FECIMPRESION as impr FROM PVBDDECOCINA
    WHERE DE_FACTURA = '".$s."'
    order by de_factura,de_secuencia,de_tipococ";

$query = $pdo->query($select);
$datos = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="modal-header">
       <h2> Numero de Orden: <?= $s ?></h2>
       
       <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-arrow-left"></i></button>
    </div>
    <div id="ModalTable" class="modal-body">
    <div class="table-responsive bg-w p-3">
   
    <table class="table" id="myTable">
        <thead class="thead-dark">
            <th>Sencuencia</th>
            <th>factura</th>
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Fecha</th>
        </thead>
        <tbody id="tablero">
            <tr>
            <td><?= $datos[0]['secuencia'] ?></td>
            <td><?=  $datos[0]['CL_NOMBRE'] ?></td>
            <td><?=  $datos[0]['hora'] ?></td>
            <td><?=  $datos[0]['mo_descri'] ?></td>
            <td><?=  $datos[0]['cantidad'] ?></td>
            <td><?=  $datos[0]['impr'] ?></td>
                </tr>
        </tbody>
    </table>

   
   
    </div>
     <br>                     
     <button  data-dismiss="modal" class="btn btn-primary btn-block btn-lg">Cerrar</button>
     </div>  
