<?php 
require 'conexion.php';
require './header.php';
 $ano_actual = date("Y");
 $ano_anterior = date("Y",strtotime($ano_actual."- 1 year"));
?>
<style>
 
    #charge1{

        display: none;
    }
</style>
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
        <button type="button" id="buscar" class="btn btn-success consultar">Consultar  <span id="charge1"><i class="fa fa-circle-o-notch fa-spin"></i></span></button>


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

        $("#buscar").prop('disabled',true);
        $("#charge1").show();
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
                var valor = JSON.stringify(result);
                var valor = JSON.parse(valor);
                var columna1=0;
                var columna2=0;
            for(let valor2 of valor)      
              {
                columna1 += parseFloat(valor2.HE_NETO1);
                columna2 += parseFloat(valor2.HE_NETO2);
              }

              

            if(columna1 == 0 && columna2 == 0)
             {
                   
                  swal("Error!!", "No hay Datos en esta Fecha", "error", {
                              buttons: false,
                               timer: 800
                            });
                          return;
                          $("#charge1").hide();
                        $("#buscar").prop('disabled', false);
                 }
                 else
                 {
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
                      $("#charge1").hide();
                        $("#buscar").prop('disabled', false);



           
          }
    }); //termina ajax
   
    
    

  }); // termina click
  
});//ready finish
</script>










