<?php 

require './conexion.php';
$fecha_actual= date("m/d/Y");
require './header.php';
?>

<br>
<form class="form-inline" >
     <div class="input-group date col-md-3" style="width:50%;" data-provide="datepicker date">
        <label for=""  style="font-weight:normal;">Fecha</label>  <input readonly="readonly" type="text" oncut="return false" id="fecha" style="font-weight: bold;" class="form-control" value="<?= date("d/m/Y") ?>">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
    </div> 
    
    <button type="button" id="buscar" class="btn btn-success consultar">Consultar</button>&nbsp;&nbsp;
    <div id="content"></div>
</form >


<div class="box box-primary">
    <div class="box-header with-border"> 
    <h3 class="t-cuadre">Ventas Por Horas</h3>
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





    <div id="" class="col-md-12">
            <div class="table-responsive bg-w p-3">
            <table id="categorias"  class="table table-striped">
                <thead>
            <tr>
            <td style="font-size: 16px;">Hora </td>
            <td style="font-size: 16px;">Monto</td>
            </tr>
            </thead>
                <tbody id="horas"> 

                <tr>
                
                    <td>0.00</td>
                    <td>0.00</td>
                </tr>

                </tbody>

            </table>
            </div>

    
    </div>
    </div>
    </div>


    <div class="box box-primary">
    <div class="box-header with-border"> 
    <h3 class="t-cuadre">Grafica</h3>
    </div>
   
    <div class="box-body">
   
    <div id="ventas_horas">

    



    
    </div>
    
    </div>
    </div>





<?php require 'footer.php'; ?>

    <script type="text/javascript">
$(document).ready(function(){
     $('#fecha').datepicker({
    format: 'dd/mm/yyyy',
  }); //termina datapicker

  $("#fecha").keypress(function(e){ 
       return false;
       });
   
       $("#fecha").keydown(function(e){
      if (e.keyCode == 8) 
           {
       e.preventDefault();
   
       }
   });
   
   $("#Dias").on('change',function()
  {
    var dias= $("#Dias").val();


 if(dias == "Hoy")
{
  fecha = "<?=date("d/m/Y");?>";

}
else if(dias == "Ayer")
{
    fecha = '<?=date("d/m/Y",strtotime($fecha_actual."- 1 days"))?>';

}
else if(dias == "Antesayer")
{
    fecha = "<?=date("d/m/Y",strtotime($fecha_actual."- 2 day"))?>";
}
else if(dias == "hace3")
{
    fecha = "<?=date("d/m/Y",strtotime($fecha_actual."- 3 days"))?>";
}
else if(dias == "hace4")
{
    fecha = "<?=date("d/m/Y",strtotime($fecha_actual."- 4 days"))?>";
}
else if(dias == "hace5")
{
    fecha = "<?=date("d/m/Y",strtotime($fecha_actual."- 5 days"))?>";
}
else if(dias == "hace6")
{
    fecha = "<?=date("d/m/Y",strtotime($fecha_actual."- 6 days"))?>";
}
else if(dias == "hace7")
{
    fecha = "<?=date("d/m/Y",strtotime($fecha_actual."- 7 days"))?>";
   
}

  $("#fecha").val(fecha);


  });//termina change


  $("#buscar").on('click',function(){


        var fecha1 =  $("#fecha").val();
        var contenido = document.getElementById("horas");

    var datos = "fecha=" + fecha1;
    $("#ventas_horas").empty();
    $.ajax({

        type:"post",
        url:"../models/select_ventas_x_horas.php",
        dataType: "json",
        data:datos,
        success:function(e)
        {
            
        valor = JSON.stringify(e);  
        valor = JSON.parse(valor);            
          if(valor.length == 0)
                {
                    swal("Error!!", "No hay Datos en esta Fecha", "error");
                } 
                else
                {
                    valores =[];
                    for(var i =0; i < valor.length; i++ ){
                        valores.push({label:valor[i]['hora'], value: currency(valor[i]['monto'],{pattern: `# `}).format() });
                    }  
                    
                     Morris.Donut({
                    element:'ventas_horas',
                    data: valores ,
                    colors:['#26B99A','#008d4c'],
                    formatter:function(y){
                                   
                                   var retorno = "$" + y;
                                   return retorno;
                    },                       
                    resize:true
                    });
       
                 // End result

                                          
            contenido.innerHTML =''; 
            var total = 0;
            for(let valor2 of valor)
             { 
                total += parseFloat(valor2.monto);
                contenido.innerHTML +=`
                <tr>
                <td>${valor2.hora}</td>
                <td style="font-weight:bold;">${currency(valor2.monto,{pattern: `# `}).format()}</td>
                </tr>
                    `
           
            }

                        contenido.innerHTML +=`
                      <tr>
                    
                       <th>Total</th>
                       <th> ${currency(total,{pattern: `# `}).format()} </th>
                        </tr>
                    `                   
                }

        }

    });//termina ajax
  });//termina punto click
});
  </script>


