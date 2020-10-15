<?php

require 'conexion.php';
require 'header.php';
$fecha_actual = date("m/d/Y");
?>
<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css' rel='stylesheet' type='text/css'>

<style>
    .select2-container--default .select2-selection--single {
        height: 8% !important;
    }
    #charge1{

        display: none;
    }
  table.dataTable thead tr th {background-color:#212529 !important; color: #fff !important ;}

</style>


<br>
<form class="form-inline">
    <div class="input-group date col-md-3" style="width:50%;" data-provide="datepicker date">
        <label for="" style="font-weight:normal;">Fecha</label> <input readonly="readonly" type="text" oncut="return false" id="fecha" style="font-weight: bold;" class="form-control" value="<?= date("d/m/Y") ?>">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div>

    <button type="button" id="buscar" class="btn btn-success consultar">Consultar <span id="charge1"><i class="fa fa-circle-o-notch fa-spin"></i></span>  </button>&nbsp;&nbsp;
    <div id="content"></div>
</form>



<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="header">Ventas Por Articulo / Renglones </h3>
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
        <label for="">Articulo</label>
        <select id="articulos" class="form-control">
        <option value='TODOS'>Todos</option>
        </select>
        </div>

        <br>
        <br>

                <table id="example" class="display responsive nowrap" style="width:100%; display: none; font-weight: normal !important;">
                <thead class="thead-dark">
                <tr>
                    <th style="font-size: 16px;">Descripcion</th>
                    <th style="font-size: 16px;">Codigo </th>
                    <th style="font-size: 16px;">Cantidad Restaurante</th>
                    <th style="font-size: 16px;">Cantidad Delivery</th>
                    <th style="font-size: 16px;">Total Restaurante</th>
                    <th style="font-size: 16px;">Total Delivery</th>
                    <th style="font-size: 16px;">Total General</th>

                </tr>
            </thead>
            <tbody id="ventas" style="font-weight: normal;">


            </tbody>

        </table>


    </div>
</div>


<?php require 'footer.php'; ?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js'></script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#fecha').datepicker({
            format: 'dd/mm/yyyy',
        }); //termina datapicker


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
            $("#example").hide();
            $("#buscar").prop('disabled',true);
            $('#example').DataTable().clear().destroy();
            $("#charge1").show();
            var fecha = $("#fecha").val();
            var Dias = $("#Filtro").val();
            var Articulo = $("#articulos").val();
            var contenido = document.getElementById("ventas");

            var datos = "fecha2=" + fecha  + "&dias2=" + Dias + "&articulo2=" + Articulo;
          
            $.ajax({

                type: "post",
                url: "../models/select_ventas_x_articulo.php",
                 data: datos,
                success: function(e)
                 {
                     var valor = JSON.parse(e);
                     
                        if(valor.length == 0)
                        {
                              swal("Error!!", "No hay Datos en esta Fecha", "error", {
                              buttons: false,
                               timer: 800
                            });
                        $("#charge1").hide();
                        $("#buscar").prop('disabled', false);
                        $("#example").hide();
                        }
                        else
                        {
                        var total = 0;
                        var totalgeneral =0;
                        var totalRestaurante = 0;
                        var totalDelivery = 0;
                        var articulosRestaurante =0;
                        var articulosDelivery =0;
              
                               for(let valor2 of valor)
                              {
                                    contenido.innerHTML +=`

                               <tr>
                               <td>${valor2.ar_descri}</td>
                               <td>${valor2.ar_codigo}</td>
                               <td>${currency(valor2.VALOR1,{pattern: `# `}).format()}</td>
                               <td>${currency(valor2.VALOR1DL,{pattern: `# `}).format()}</td>
                               <td>${currency(valor2.VALOR3,{pattern: `# `}).format()}</td>
                               <td>${currency( valor2.VALOR3DL,{pattern: `# `}).format()}</td>
                               <td>${currency(total,{pattern: `# `}).format()}</td>
                         
                               </tr>
                                   `
                               }

                               document.getElementById('example').style.cssText = 'width:100%; display: box;'

                        $('#example').DataTable({
                            "columnDefs": [{
                            "targets": [1,2,3],
                            "orderable": false
                           }], 

                            "destroy":true,
                            "ordering": false,
                            "info": false,
                            "searching": false
                            });
                          


                        $("#charge1").hide();
                        $("#buscar").prop('disabled', false);
                               
                }

            }
            
            
            }); //termina ajax

           
        }); //termina punto click
    });
</script>


<script type="text/javascript">
$(document).ready(function(){

$('#articulos').select2({
 ajax: { 
  url: '../models/select_combo_articulos.php',
  type: 'POST',
  dataType: 'json',
  delay: 250,
  data: function (params) {
   return {
     searchTerm: params.term // search term
   };
  },
  processResults: function (Response) {
    
    return {
        results: $.map(Response, function(obj) {
            return { id: obj.codigo, text: obj.descripcion };
        })
    };


  },
  cache: true
 }
});


$("#Enviar").on('click',function()
{
 var esto =  $("#articulos").val();
  alert(esto);
});


});   
</script>