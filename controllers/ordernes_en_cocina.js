const container = document.getElementById('contenido');
const tabla = document.getElementById('tablero');

function Fact(data) {
    $("#ModalTable").empty();
    document.cookie = 's=' + data + '; path=/';
    Tabla = "../pages/ordernes_detalles.php";
    $("#ModalTable").load(Tabla);
}

fetch('../models/select_ordenes_cocina.php')
    .then(response => response.json())
    .then(function refill(data) {
        for (var dat = 0; dat < data.length; dat++) {
            container.innerHTML += '<tr><td>' + data[dat].secuencia + '</td>' +
                '<td>' + data[dat].orden + '</td>' +
                '<td>' + data[dat].fecha + ' / ' + data[dat].hora + '</td>' +
                '<td>' + data[dat].MA_CODIGO + '</td>' +
                '<td>' + data[dat].CL_NOMBRE + '</td>' +
                '<td>' + data[dat].mo_descri + '</td>' +
                '<td>' + '<a  onclick="Fact(' + "'" + data[dat].secuencia + "'" + '); " data-toggle="modal" data-target="#myModal" class="btn btn-info d-print-none"  data-placement="top" title="Pendientes"><i class="far fa-eye"></i> </a>' + '</td>' +
                '</tr>';
        }
    });