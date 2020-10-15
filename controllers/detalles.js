fetch('../models/select_detalles.php')
    .then(response => response.json())
    .then(function refill(data) {
        titulo.textContent += data[0].DE_FACTURA;
        var id = '';
        var ids = [];
        var contador = 0;
        var lista = [];
        for (dat of data) {
            if (dat.codigo != "" && dat.tipo == 'E') {
                ids.push('#' + dat.codigo);

                id = dat.codigo;
                Entradas.innerHTML += `
              
                    <li class='list-group-item d-flex justify-content-between align-items-center list-group-item-primary' data-toggle="collapse" href="#${dat.codigo}" id="#${dat.codigo}">
                    ${dat.DE_DESCRI}
                    <span class="badge badge-success badge-pill">${parseInt(dat.cantidad)}</span>
                    </li>
             
                `;
                lista.push(contador);
                contador = 0;
            }
            if (dat.codigo == "" && dat.tipo == 'E') {
                contador += 1;
                Entradas.innerHTML += `
                <div class="collapse show align-items-center" id="${id}" >
                    <li class="list-group-item list-group-item-action list-group-item-success ">${dat.DE_DESCRI}</li>
                </div>
                `;

            }
            if (dat.codigo != "" && dat.tipo == 'F') {
                ids.push('#' + dat.codigo);

                id = dat.codigo;
                Fuerte.innerHTML += `
              
                    <li class='list-group-item d-flex justify-content-between align-items-center list-group-item-primary' data-toggle="collapse" href="#${dat.codigo}" id="#${dat.codigo}">
                    ${dat.DE_DESCRI}
                    <span class="badge badge-success badge-pill">${parseInt(dat.cantidad)}</span>
                    </li>
             
                `;
                lista.push(contador);
                contador = 0;
            }
            if (dat.codigo == "" && dat.tipo == 'F') {
                contador += 1;
                Fuerte.innerHTML += `
                <div class="collapse show" id="${id}">
                <li  class="list-group-item list-group-item-action list-group-item-success">${dat.DE_DESCRI}
               
                </li>
                </div>
                `;

            }


        }
        lista.push(contador);




    })