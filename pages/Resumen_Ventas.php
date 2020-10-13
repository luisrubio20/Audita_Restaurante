<?php 
require 'conexion.php';
require './header.php';
 $ano_actual = date("Y");
 $ano2 = date("Y",strtotime($ano_actual."- 1 year"));
 $ano3 = date("Y",strtotime($ano_actual."- 2 year"));
?>
<style>
    #charge1{
        display: none;
    }
</style>
<br>

<div class="box-header with-border"> 
<h3 class="t-cuadre">Ventas Comparativo entre años</h3>
</div>
<div class="box box-primary">
    <div class="box-body">
    <div class="form-group">
        <label for="exampleInputName2">Fecha 1: </label>
        <input type="text" class="form-control year"  id="anio1" readonly="readonly" value="<?= $ano_actual?>">
        </div>
          <button type="button" id="buscar" class="btn btn-success consultar">Consultar  <span id="charge1"><i class="fa fa-circle-o-notch fa-spin"></i></span></button>
        <input type="text" id="ano2" style="display: none;" value="<?= $ano2?>">
        <input type="text" id="ano3" style="display: none;" value="<?= $ano3?>">

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
    var anio2 = $("#ano2").val();
    var anio3 = $("#ano3").val();

    var datos = "anio1=" +  anio1 + "&anio2=" + anio2 + "&anio=" + anio3; 

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
                        ykeys: ['HE_NETO1','HE_NETO2','HE_NETO3'],
                        labels: [anio1,anio2,anio3],
                     //   barColors: ['#1E8449','#105BC1','#CA6F1E'],
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










