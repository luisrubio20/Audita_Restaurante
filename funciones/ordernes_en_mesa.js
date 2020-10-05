const container = document.getElementById('contenido');

fetch('select_ordenes_cocina.php')
    .then(response => response.json())
    .then(function refill(data) {
        console.log(data);
        for (var dat of data) {
            container.innerHTML += '<tr><td>' + dat.secuencia + '</td>' +
                '<td>' + dat.orden + '</td>' +
                '<td>' + dat.HE_FECHA + ' / ' + dat.hora + '</td>' +
                '<td>' + dat.MA_CODIGO + '</td>' +
                '<td>' + dat.CL_NOMBRE + '</td>' +
                '<td>' + dat.mo_descri + '</td>' +
                '<td>' + '<a  data-toggle="modal" data-target="#myModal" class="btn btn-info d-print-none"  data-placement="top" title="Pendientes"><i class="far fa-eye"></i> </a>' + '</td>' +
                '</tr>'
        }
    });