<?php

require 'conexion.php';
require 'header.php';
$fecha_actual = date("m/d/Y")
?>
<link href="../Dependencias/multiselect4_1_0.css" rel="stylesheet" />

<style>
    .select2-container--default .select2-selection--single {
        height: 8% !important;
    }
</style>


<br>
<form class="form-inline">
    <div class="input-group date col-md-3" style="width:50%;" data-provide="datepicker date">
        <label for="" style="font-weight:normal;">Fecha</label> <input readonly="readonly" type="text" oncut="return false" id="fecha" style="font-weight: bold;" class="form-control" value="<?= date("d/m/Y") ?>">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div>

    <button type="button" id="buscar" class="btn btn-success consultar">Consultar</button>&nbsp;&nbsp;
    <div id="content"></div>
</form>


<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="t-cuadre">Ventas Por Articulo / Renglones </h3>
     <!--   <div id="ArticulosA"></div> -->
    </div>

    <div class="box-body">


        <div class="form-group">
            <label for="">Tiempo</label>
            <select name="Dias" id="Dias" class="form-control">

                <option value="Hoy">Hoy</option>
                <option value="Ayer" id="ayer">Ayer</option>
                <option value="Antesayer">Antesayer</option>
                <option value="hace3">Hace 3 dias</option>
                <option value="hace4">Hace 4 dias</option>
                <option value="hace5">Hace 5 dias</option>
                <option value="hace6">Hace 6 dias</option>
                <option value="hace7">1 Semana</option>
            </select>
        </div>



        <div class="form-group">
        <label for="">Filtro</label>
        <select name="Filtro" id="Filtro" class="form-control">
            <option selected value="dias">Dias</option>
            <option value="mes">Mes</option>
            <option value="ano">Año</option>
        </select>
        </div>

        <div class="form-group">
        <label for="">Nombre Articulo</label>
        <select name="articulos" id="articulos" class="form-control AGRANDAR ">
            <?php
            $select = $pdo->query("SELECT top 20 ar_codigo,ar_descri FROM ivbdarti");
            $value = $select->fetchAll(PDO::FETCH_ASSOC);
            foreach ($value as $key => $fila) : ?>
                <option selected value="<?= trim($fila['ar_codigo']); ?>"><?= $fila['ar_descri']; ?></option>
            <?php endforeach ?>
            <option selected="selected" value="TODOS">Todos</option>
        </select>
        </div>





        <br>
        <br>



        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th style="font-size: 16px;">Codigo </th>
                    <th style="font-size: 16px;">Descripcion</th>
                    <th style="font-size: 16px;">Cant.Restaurante</th>
                    <th style="font-size: 16px;">Cant.Delivery</th>
                    <th style="font-size: 16px;">Total Restaurante</th>
                    <th style="font-size: 16px;">Total Delivery</th>
                    <th style="font-size: 16px;">Total General</th>

                
                </tr>
            </thead>
            <tbody id="ventas">


            </tbody>

        </table>


    </div>
</div>






<?php require 'footer.php'; ?>
<script src="../Dependencias/multiselect4_1_0.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#fecha').datepicker({
            format: 'dd/mm/yyyy',
        }); //termina datapicker

        $("#articulos").select2({});

        $("#Dias").on('change', function() {
            var dias = $("#Dias").val();
            if (dias == "Hoy") {
                fecha = "<?= date("d/m/Y"); ?>";
            } else if (dias == "Ayer") {
                fecha = '<?= date("d/m/Y", strtotime($fecha_actual . "- 1 days")) ?>';
            } else if (dias == "Antesayer") {
                fecha = "<?= date("d/m/Y", strtotime($fecha_actual . "- 2 day")) ?>";
            } else if (dias == "hace3") {
                fecha = "<?= date("d/m/Y", strtotime($fecha_actual . "- 3 days")) ?>";
            } else if (dias == "hace4") {
                fecha = "<?= date("d/m/Y", strtotime($fecha_actual . "- 4 days")) ?>";
            } else if (dias == "hace5") {
                fecha = "<?= date("d/m/Y", strtotime($fecha_actual . "- 5 days")) ?>";
            } else if (dias == "hace6") {
                fecha = "<?= date("d/m/Y", strtotime($fecha_actual . "- 6 days")) ?>";
            } else if (dias == "hace7") {
                fecha = "<?= date("d/m/Y", strtotime($fecha_actual . "- 7 days")) ?>";
            }
            $("#fecha").val(fecha);
        }); //termina change


        $("#buscar").on('click', function() {
         //   $('#ArticulosA').html('<div class="loading" style="color:#3c8dbc;"><img src="../img/ac1.gif"/>Un momento, por favor...</div>');

            var fecha = $("#fecha").val();
            var Dias = $("#Filtro").val();
            var Articulo = $("#articulos").val();

            var datos = "fecha=" + fecha  + "&dias=" + Dias + "&articulo=" + Articulo;
             alert(datos);

            $.ajax({

                type: "post",
                url: "../models/sesion_ventas_articulo.php",
                data: datos,
                success: function(e) {

                   
                    $("#ventas").load("../models/select_ventas_x_articulo.php");
                  //  $("#auditoriaA").fadeIn(1000).html('<div class="" style="color:#008d4c;"> <img  style="background: #00a65a;border-radius: 20px;" src="../img/Untitled.png"/>  </div>');




                }



            }); //termina ajax


        }); //termina punto click
    });
</script>