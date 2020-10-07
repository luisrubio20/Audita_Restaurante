<?php 
require 'conexion.php';
require './header.php';
 $ano_actual = date("Y");
 $ano_anterior = date("Y",strtotime($ano_actual."- 1 year"));
?>

<br>
<br>
 

<div class="box box-primary">
    <form class="form-inline" >
    <div class="box-header with-border"> 
    <h3 class="t-cuadre">Resumen De Ventas</h3>
    </div>
    <div id="VentasA"></div>
    </form>
    <div class="box-body">
    <div class="form-group">

        <label for="exampleInputName2">Fecha 1: </label>
        <input type="text" class="form-control year"  id="anio1" readonly="readonly" value="<?= $ano_actual?>">
        </div>
        <div class="form-group">
        <label for="exampleInputEmail2">Fecha 2: </label>
        <input type="text" class="form-control year" id="anio2" readonly="readonly"  value="<?= $ano_anterior?>">
        </div>
        <button type="button" id="buscar" class="btn btn-success consultar">Consultar</button>


<br>
<br>
 
        <div  id="grafica"> </div>

     
</div>
</div>





<?php require 'footer.php';?>


<script type="text/javascript">
$(document).ready(function(){
    $('#anio1').datepicker({
        format: 'yyyy',
        viewMode: "years", 
    minViewMode: "years",
    orientation: 'bottom auto'
  });  //termina datapicker
  
  $('#anio2').datepicker({
        format: 'yyyy',
        viewMode: "years", 
    minViewMode: "years",
    orientation: 'bottom auto'
  }); 
    


   $('#buscar').click(function(){
       $("#grafica").empty();
    var anio1 = $("#anio1").val();
    var anio2 = $("#anio2").val();
    var  datos = "anio1=" +  anio1 + "&anio2=" + anio2; 

    
    $.ajax({
            type:'post',
            url: "../models/select_comparativo_x_ano.php",
            dataType: "json",
            data: datos,
            success: function(result)
            {
                console.log(result);

                Morris.Bar({
                        element: 'grafica',
                        data: result,
                        xkey: 'MESL',
                        ykeys: ['HE_NETO1','HE_NETO2'],
                        labels: [anio1,anio2],
                        barColors: ['#006d19','blue'],
                        }).on('click', function(i, row){
                        console.log(i, row);
                        });



            }
       
    }); //termina ajax
   
    
    

  }); // termina click
  
});//ready finish
</script>










