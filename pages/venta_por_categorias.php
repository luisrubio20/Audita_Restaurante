<?php require 'conexion.php'; require 'header.php'; ?>
<link rel="stylesheet" href="../Css/tablaheader.css">
<div class="box-header width-border">
    <h1 class="header">Ventas por Categorias</h1>
</div>

<div class="box box-primary">
    <form class="form-inline">
        <div class="input-group date col-md-2"  style="margin-left: 30px; margin-bottom:30px;">
            <label for="">Fecha:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="text" class="form-control year" id="fecha1" value="<?= date("m/d/Y"); ?>"  readonly=»readonly" onchange="getfulldate();">
        </div>
        <div class="input-group date col-md-2" style="margin-left: 30px; margin-bottom:30px;">
            <label for="">Tiempo: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="Dias" id="Dias" class="form-control" onchange="getfulldate();">
                        <option value="0 day">Hoy</option>
                        <option value="1 day" id="ayer">Ayer</option>
                        <option value="2 day">Antesayer</option>
                        <option value="3 day">Hace 3 dias</option>
                        <option value="4 day">Hace 4 dias</option>
                        <option value="5 day">Hace 5 dias</option>
                        <option value="6 day">Hace 6 dias</option>
                        <option value="7 day">1 Semana</option>
                    </select>
            <div class="input-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
        <div class="input-group date col-md-2"  style="margin-left: 30px; margin-bottom:30px;">
            <label for="">Filtro:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select class="form-control" id='filtro'>
                <option value='dia'>dia</option>
                <option value='mes'>mes</option>
                <option value='año'>año</option>
            </select>
 </div>
        <div class="input-group date col-md-4"  style=" margin-bottom:30px;">
            <label for="">Departamento: </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="depto" id="dept" class="form-control">

            </select>
        </div>
       
        <button type="button" id="Consultar" class="btn btn-success" onclick="getData();"  style=" margin-bottom:30px;">Consultar</button>
    </form>
</div>

<div class="box-body">
    <div class="contents">
        <table class="table " id="myTable">
            <thead class="thead-dark" >
            <th>Codigo</th>
            <th>Descripcion</th>
            <th>Cantidad General</th>
            <th>Total General</th>
            </thead>
            <tbody id="contenido">

            </tbody>
        </table>
        </div>
</div>
<?php  require 'footer.php'; ?>
<script src="../controllers/VentasXCategorias.js"></script>