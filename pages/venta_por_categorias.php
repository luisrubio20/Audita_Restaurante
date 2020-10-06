<?php require 'conexion.php'; require 'header.php'; ?>
<link rel="stylesheet" href="../Css/tablaheader.css">
<br><br><br>
<form class="form-inline">   <label for="">Fecha:</label>
    <div class="input-group date col-md-3" style="width: 50%;">
     
        <input type="text" class="form-control year" id="fecha1" value="<?= date("m/d/Y"); ?>"  readonly=»readonly>
    </div>
        <button type="button" id="Consultar" class="btn btn-success" onclick="getData();"   margin-bottom:30px;">Consultar</button>
</form>
<div class="box-header width-border">
    <center><h1 class="header">Ventas por Categorias</h1></center>
</div>
<div class="box box-primary">
    <form class="form-box">
      
        <div class="form-group " >
            <label for="">Tiempo: </label><br>
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
            <div class="form-group-addon">
                <span class="glyphicon glyphicon-th"></span>
            </div>
        </div>
        <div class="form-group">
            <label for="">Filtro:</label><br>
            <select class="form-control" id='filtro'>
                <option value='dia'>dia</option>
                <option value='mes'>mes</option>
                <option value='año'>año</option>
            </select>
 </div>
        <div class="form-group"   >
            <label for="">Departamento: </label><br>
            <select name="depto" id="dept" class="form-control">

            </select>
        </div>
       
      
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