$('.year').datepicker();
const date = document.getElementById('fecha1');
const DateValue = document.getElementById('Dias');
const contenido = document.getElementById('contenido');
const dept = document.getElementById('dept');
const filtro = document.getElementById('filtro');
var fecha = '';


function getfulldate() {
    const formdata = new FormData();
    formdata.append('date', date.value);
    formdata.append('DateValue', DateValue.value);

    fetch('../models/getShortDate.php', {
            method: 'post',
            body: formdata
        }).then(response => response.json())
        .then(function refill(data) {
            fecha = data;
            console.log(data);
        });
}
getfulldate();

function getDept() {
    fetch('../models/getDept.php')
        .then(response => response.json())
        .then(function refill(data) {

            for (dat of data) {
                dept.innerHTML += '<option value="' + dat.de_codigo + '">' + dat.ar_descri + '</option>';
            }

        });
}
getDept();

function getData() {
    const formdate = new FormData();
    formdate.append('date', date.value);
    formdate.append('DateValue', fecha);
    formdate.append('dept', dept.value);
    formdate.append('filtro', filtro.value);
    contenido.textContent = '';
    fetch('../models/select_ventasXcategorias.php', {
            method: 'post',
            body: formdate
        })
        .then(response => response.json())
        .then(function refill(data) {
            for (dat of data) {
                contenido.innerHTML += '<tr><td>' + dat.ar_codigo + '</td>' +
                    '<td>' + dat.ar_descri + '</td>' +
                    '<td>' + dat.CANTIDAD + '</td>' +
                    '<td>' + dat.TOTAL + '</td>' +

                    '</tr>'
            }

        });
}