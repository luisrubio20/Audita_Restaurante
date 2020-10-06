<?php
    require 'conexion.php';
    require 'header.php';
?>
<link rel="stylesheet" href="../Css/tablaheader.css">
<br>
<div class="box box-primary">
<div class="box-header with-border">
        <h3 class="t-cuadre">Ordenes En Cocina</h3>
            </div>
<form class="form-inline" >
    
            <div id="cuadreA"></div>
</form>
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
