const container = document.getElementById('contenido');
const tabla = document.getElementById('tablero');
const cam = document.getElementById('cam');

function Fact(data) {
    $("#ModalTable").empty();
    document.cookie = 's=' + data + '; path=/';
    Tabla = "../pages/ordernes_detalles.php";
    $("#ModalTable").load(Tabla);
}
var select = new FormData();
select.append('fun', 'selectgeneral');
select.append('filtro', cam.value);

fetch('../models/select_ordenes_cocina.php', {
        method: 'post',
        body: select
    })
    .then(response => response.json())
    .then(function refill(data) {
        console.log(data);
        for (var dat = 0; dat < data.length; dat++) {
            container.innerHTML += '<tr><td>' + data[dat].secuencia + '</td>' +
                '<td>' + data[dat].orden + '</td>' +
                '<td>' + data[dat].fecha + ' / ' + data[dat].hora + '</td>' +
                '<td>' + data[dat].MA_CODIGO + '</td>' +
                '<td>' + data[dat].CL_NOMBRE + '</td>' +
                '<td>' + data[dat].mo_descri + '</td>' +
                '<td>' + '<a  onclick="Fact(' + "'" + data[dat].orden + "'" + '); " data-toggle="modal" data-target="#myModal" class="btn btn-info d-print-none"  data-placement="top" title="Pendientes"><i class="far fa-eye"></i> </a>' + '</td>' +
                '</tr>';


        }

    });
var selects = new FormData();
selects.append('fun', 'selectmozo');

selects.append('filtro', cam.value);
fetch('../models/select_ordenes_cocina.php', {
        method: 'post',
        body: selects
    })
    .then(response => response.json())
    .then(function refill(data) {
        console.log(data);
        for (dat of data) {
            cam.innerHTML += '<option value="' + dat.NOM + '">' + dat.MO_DESCRI + '</option>';

        }
    });

btn.addEventListener('click', () => {
    console.log(cam.value);
    contenido.textContent = '';
    var select = new FormData();
    select.append('filtro', cam.value);
    select.append('fun', 'general');
    fetch('../models/select_ordenes_cocina.php', {
            method: 'post',
            body: select
        })
        .then(response => response.json())
        .then(function refill(data) {
            console.log(data);
            for (var dat = 0; dat < data.length; dat++) {
                container.innerHTML += '<tr><td>' + data[dat].secuencia + '</td>' +
                    '<td>' + data[dat].orden + '</td>' +
                    '<td>' + data[dat].fecha + ' / ' + data[dat].hora + '</td>' +
                    '<td>' + data[dat].MA_CODIGO + '</td>' +
                    '<td>' + data[dat].CL_NOMBRE + '</td>' +
                    '<td>' + data[dat].mo_descri + '</td>' +
                    '<td>' + '<a  onclick="Fact(' + "'" + data[dat].orden + "'" + '); " data-toggle="modal" data-target="#myModal" class="btn btn-info d-print-none"  data-placement="top" title="Pendientes"><i class="far fa-eye"></i> </a>' + '</td>' +
                    '</tr>';


            }
        });


})