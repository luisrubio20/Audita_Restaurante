<?php
    require 'conexion.php';
    require 'header.php';
?>
<br>
<form class="form-inline">
    &nbsp;&nbsp;&nbsp;&nbsp;<label for="">Fecha: </label>
    <div class="input-group date col-md-3" style="width: 50%;">
        <input type="text" class="form-control year" id="fecha1" value="<?= date("m/d/Y"); ?>" readonly=»readonly
            onchange="getfulldate();">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div>
    <button type="button" id="comparar" class="btn btn-success consultar" onclick="getReport()">Consultar <span
            id="charge2"></i></span></button>
</form>


<div class="box box-primary">

    <div class="box-header with-border">
        <h1 class="" style="text-align:center; color:black;">Comparativo entre Periodos</h1>
    </div>

    <form class="form-inline" style="display: none;">
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputName2">Dia Anterior: </label>
                <input type="text" class="form-control date" value="" id="fecha2" readonly=»readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputName2">Semana Anterior: </label>
                <input type="text" class="form-control date" value="" id="fecha3" readonly=»readonly>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="exampleInputName2">Año Anterior: </label>
                <input type="text" class="form-control date" value="" id="fecha4" readonly=»readonlys>
            </div>
        </div>

        <br><br> <br><br>

    </form>

    <div class="form-inline">
        <div id="monto1" class="col-md-4">
        </div>

        <div id="monto2" class="col-md-4">
        </div>

        <div id="monto3" class="col-md-4">
        </div>

        <div id="monto4" class="col-md-4">
        </div>

        <div id="difff1" class="col-md-4">
        </div>

        <div id="difff2" class="col-md-4">
        </div>

        <div id="difff3" class="col-md-4">

        </div>
    </div>

</div>


<div class="col-md-12">
    <div class="table-responsive bg-w p-3">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h1 class="" style="color:black;">Grafico</h1>
                <div id="grafica"></div>
            </div>
        </div>


    </div>
    <div class="row" id="detalle" style="display: none;">
        <!--empieza row-->

        <?php require 'footer.php'; ?>
        <script src="../funciones/datepicker.min.js"></script>
        <script src="../controllers/Reporte.js"></script>
        <script src="../controllers/graph.js"></script>