<?php 
require 'conexion.php';



if(isset($_GET['detalle']))
{
   
    $factura = $_POST['factura'];

    $detalle = $pdo->query("SELECT de_factura,ar_codigo,de_cantid,de_descri,de_precio,de_cantid*de_precio as Total FROM ivbddete
    where de_factura= '{$factura}'");

    $value2 = $detalle->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['data' => $value2]);
   exit();
}

$select = $pdo->query("SELECT he_fecha,he_factura,he_nombre,ma_codigo,mo_codigo,he_monto,he_itbis,he_totley,he_neto,he_caja,he_turno FROM ivbdhete WHERE he_tipfac=''");
$value = $select->fetchAll(PDO::FETCH_ASSOC);
 
$totalmonto=0; 
$totalitbis=0; 
$totaltoley=0; 
$totalneto=0; 
require './header.php';
?>




<link rel="stylesheet" href="../Css/tablaheader.css">

<br>


    <div class="box-header with-border"> 
    <h3 class="t-cuadre">Mesas Abiertas </h3>
    </div>
    
    <div class="box box-primary">
 
    <div class="box-body">
  
    <div class="contents">
      <table class="table " id="myTable">
        <thead class="thead-dark">
          <tr>
            <th>Factura</th>
            <th>Fecha/Hora</th>
            <th>Nombre</th>
            <th>Mesa</th>
            <th>Camarero</th>
            <th>Monto</th>
            <th>Itbis</th>
            <th>Im.Ley</th>
            <th>Neto</th>
            <th>Detalle</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach($value as $key => $fila):
                  
                  $totalmonto+= $fila['he_monto']; 
                  $totalitbis+=$fila['he_itbis']; 
                  $totaltoley+=$fila['he_totley']; 
                  $totalneto+=$fila['he_neto']; 
                  
                  ?>
          <tr>
            <td><?=$fila['he_factura']?></td>
            <td><?= date("d-m-Y",strtotime($fila['he_fecha']));?> / <?=  date('h',strtotime($fila['he_fecha']));?></td>
            <td><?=$fila['he_nombre']?></td>
            <td><?=$fila['ma_codigo']?></td>
            <td><?=$fila['mo_codigo']?></td>
            <td><?= number_format($fila['he_monto'],2)?></td>
            <td><?= number_format($fila['he_itbis'],2)?></td>
            <td><?= number_format($fila['he_totley'],2)?></td>
            <td><?= number_format($fila['he_neto'],2)?></td>
            <td>
              <button id="detalle" class="btn btn-info d-print-none detalle" data-fac="<?=$fila['he_factura']?>"
                data-mesa="<?=$fila['ma_codigo']?>" data-camarero="<?=$fila['mo_codigo']?>"
                data-cliente="<?=$fila['he_nombre']?>" data-fecha="<?=$fila['he_fecha']?>" data-toggle="tooltip"
                data-placement="top" title="Detalle"><i class="far fa-eye"></i></button>
            </td>

          </tr>
          <?php endforeach; ?>

        <tfoot>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

            <th>TOTALES</th>
            <th><?= number_format($totalmonto,2); ?></th>
            <th><?= number_format($totalitbis,2); ?></th>
            <th><?= number_format($totaltoley,2); ?></th>
            <th><?= number_format($totalneto,2); ?></th>
            <td></td>

          </tr>
        </tfoot>


        </tbody>
      </table>
    </div>
  </div>
</div>

<a href="#" id="modal1" style="display:none;" data-toggle="modal" data-target="#myModal">

  <?php require 'footer.php';?>


  <script type="text/javascript">
    $(document).ready(function () {

      $('.detalle').click(function () {

        var cliente = $(this).attr('data-cliente');
        var factura = $(this).attr('data-fac');
        var cantidad = 0;
        var descri = 0;
        var precio = 0;
        var total = 0;


        $.ajax({
          url: "Mesas_abiertas.php?detalle=true",
          type: 'post',
          dataType: "json",
          data: "&factura=" + factura,
          success: function (result) {

            console.log(result);
            var tr = "";
            var template = "";
            var totalfac = 0;

            $.each(result.data, function (i, item) {
              totalfac += parseFloat(item.Total);
              var cant = (item.de_cantid != '.00') ? item.de_cantid : '';
              var precio = (item.de_precio != '.00') ? item.de_precio : '';
              var total = (item.Total != '.0000') ? item.Total : '';


              tr += `

                  <tr>
                  <td>${cant}</td>
                  <td>${item.de_descri}</td>
                  <td>${currency(precio,{pattern: `# `}).format()}</td>
                  <td>${currency(total,{pattern: `# `}).format()}</td>


                  </tr>
                  `;

            }); //Termina el each


            tr += `

                <tr>
                <td></td>
                <td></td>
                <th>TOTAL</th>
                <th>${currency(totalfac,{pattern: `# `}).format()}</th>


                </tr>
                `;


            template = `
    <!--- header de modal -->
              <div class="modal-header">
                <h2>Detalle(s)  Pedido(s)</h2>
                <button type="button" class="close"  onclick="Close()" aria-label="Close"><i class="fas fa-arrow-left"></i> </button>
              </div>
     <!--- header de modal -->
              
              <br>
              <div class="table-responsive bg-w p-3">
              <table class="table">
                            <thead class="thead-dark">
                                <th>Cant.</th>
                                <th>Descrip.</th>
                                <th>Precio</th>
                                <th>Total</th>
                            </thead>
                            <tbody>
                                ${tr}
                            </tbody>
                            </table>
                            </div>
                            
                            <br>
                        
    <button onclick="Close()" id="" class="btn btn-primary btn-block btn-lg">Volver</button>

                            `;
            $("#ModalTable").empty();
            $("#ModalTable").append(template);
          }

        }); //termina ajax

        $("#modal1").click();


      }); // termina click

    }); //ready finish

    function Close() {

      $("#modal1").click();
    }
  </script>