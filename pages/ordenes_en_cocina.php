<?php
    require 'conexion.php';
    require 'header.php'
?>
<style>
td {
    border-bottom: 1px solid #000 !important;
 }  
</style>

<link rel="stylesheet" href="../Css/tablaheader.css">
<br>
<div class="box box-primary">
<div class="box-header with-border">
        <h3 class="t-cuadre">Ordenes En Cocina</h3>
            </div>

<div>
   <label for="">Camarero</label>
<select  class="form-control"  id="cam">
<option value="todos">Todos</option>
</select>
</div>
<br>
<div>
    <button id="btn" class="btn btn-success">Buscar</button>
</div>
    <div class="box-body">
        <div class="contents">
            <table class="table " id="myTable">
                <thead class="thead-dark" >                  
                        <th>Secuencia</th>
                        <th>Orden</th>
                        <th>Fecha / Hora</th>
                        <th>Mesa</th>
                        <th>Cliente</th>
                        <th>Camarero</th>
                        <th></th>
                    </thead>
                    <tbody id="contenido">
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>
<script src="../controllers/ordernes_en_cocina.js"></script>
