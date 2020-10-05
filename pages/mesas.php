<?php
require 'conexion.php';



if(isset($_GET['detalle'])){

    $factura = $_POST['factura'];

    $query = $pdo->query("SELECT de_factura,ar_codigo,de_cantid,de_descri,de_precio,de_cantid*de_precio as Total FROM ivbddete
    where de_factura= '{$factura}' ");

    $detalle = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['resp'=>'Ok','data'=>$detalle]);
    exit();
}

$query = $pdo->query("SELECT he_fecha,he_factura,he_nombre,ma_codigo,mo_codigo,he_monto,he_itbis,he_totley,he_neto,he_caja,he_turno FROM ivbdhete WHERE he_tipfac=''");

$mesas = $query->fetchAll(PDO::FETCH_ASSOC); 

require './header.php';

?>


<div class="box box-primary">
    <div class="box-body">
        <h2>Mesas abiertas</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>Factura</th>
                     
                        <th>Nombre</th>
                        <th>Mesa</th>
                        <th>Camarero</th>
                        <th>Monto</th>
                        <th>Itbis</th>
                        <th>Imp. Ley</th>
                        <th>Total Neto</th>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php  foreach($mesas as $mesa):?>
                        <tr>
                            <td><?=$mesa['he_factura']?></td>
                           
                            <td><?=$mesa['he_nombre']?></td>
                            <td><?=$mesa['ma_codigo']?></td>
                            <td><?=$mesa['mo_codigo']?></td>
                            <td><?=$mesa['he_monto']?></td>
                            <td><?=$mesa['he_itbis']?></td>
                            <td><?=$mesa['he_totley']?></td>
                            <td><?=$mesa['he_neto']?></td>
                            <td>
                                <button class="btn btn-info btn-flat detalles" data-mesa="<?=$mesa['mesa']?>" data-fac="<?=$mesa['he_factura']?>" data-mesa="<?=$mesa['ma_codigo']?>" data-camarero="<?=$mesa['mo_codigo']?>" data-cliente="<?=$mesa['he_nombre']?>" data-fecha="<?=$mesa['he_fecha']?>"><i class="far fa-eye"></i></button>
                            </td>
                        </tr>
                    <?php  endforeach;?>
                    </tbody>
                </table>
                                
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
    require './footer.php';
?>


<script>

$("#cart-btn").hide();

    $('.detalles').click(function(){
        $('.modal-body').empty();

        var cliente = $(this).attr('data-cliente');
        var orden = $(this).attr('data-orden');
        var factura = $(this).attr('data-fac');
        var mesa = $(this).attr('data-mesa');
        var camarero = $(this).attr('data-camarero');
        var hora = $(this).attr('data-hora');
        var tr = '';
        var template = ``;
    alert(factura);
        $.ajax({
            url: "mesas.php?detalle=true",
            type:'post',
            dataType: "json",
            data: "&factura="+factura,
            success: function(result){
                console.log(result);
            }
        });
      //  $('#myModal').modal('show');
    });
</script>