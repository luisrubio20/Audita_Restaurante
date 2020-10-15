
function detalle(hora)
{
    var fecha = $("#fecha").val();
    datos = new FormData();
    datos.append('fecha',fecha);
    datos.append('hora',hora);
    fetch('../models/select_ventas_x_horas_detalle.php',{
        method: 'post',
        body:datos
    })
    .then(response => response.json())
    .then(function refill(data) {

        var tr ='';
        for(let valor2 of data)
        {
            tr += `

            <tr>
            <td>${valor2.CODIGO}</td>
            <td>${valor2.ARTICULO}</td>
            <th>${currency(valor2.CANTIDAD,{pattern: `# `}).format()}</th>
            <th>${valor2.HORA}</th>
            </tr>
            `;
        }

        template = `
        <!--- header de modal -->
                  <div class="modal-header">
                    <h2>Detalle(s) de Venta(s) </h2>
                    <button type="button" class="close"  onclick="Close()" aria-label="Close"><i class="fas fa-arrow-left"></i> </button>
                  </div>
         <!--- header de modal -->
                  
                  <br>
                
                    <div class="table-responsive bg-w p-3">
                  <table class="table">
                                <thead class="thead-dark">
                                    <th>Codigo</th>
                                    <th>Articulos</th>
                                    <th>Cantidad</th>
                                    <th>Hora</th>
                                     </thead>
                                <tbody>
                                    ${tr}
                                </tbody>
                                </table>
                                </div>
                       
                              
                                
                                <br>
                            
        <button onclick="Close()" id="" class="btn btn-primary btn-block btn-lg">Volver</button>
    
                                `;
             $("#ModalTable").empty(); 
          $("#ModalTable").append(template);  




    })

    $("#modal1").click(); 

}

function Close()
{
  
   $("#modal1").click(); 
}

