<?php
    require 'conexion.php';
    require 'header.php';
?>
<style>
    #charge1 {

        display: none;
    }
</style>
<br>

<form class="form-inline">
    <label for="">Fecha</label>
    <div class="input-group date col-md-2" style=" width:30%;">
        <input type="text" class="form-control year" id="fecha1" value="<?= date("Y"); ?>" readonly=»readonly>
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div>
    <button type="button" id="comparar" class="btn btn-success consultar">Consultar <span id="charge1"><i
                class="fa fa-circle-o-notch fa-spin"></i></span></button>&nbsp;&nbsp;
    &nbsp;
</form>



<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="" style="text-align:center; color:black;">Comparativos Costo Beneficio</h1>
    </div>

</div>
<br>
<div class="col-md-12">
    <div class="table-responsive bg-w p-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h1 class="" style="color:black;">Grafico</h1>
                <div id="grafica"></div>
            </div>




            <div class="row" id="detalle" style="display: none;">
                <!--empieza row-->

                <?php require 'footer.php'; ?>
                <script src="../funciones/datepicker.min.js"></script>
                <script src="../controllers/comparativosCB.JS"></script>