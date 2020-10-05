$('.year').datepicker();
const fecha = document.getElementById('fecha1');
const fecha2 = document.getElementById('fecha2');
const fecha3 = document.getElementById('fecha3');
const fecha4 = document.getElementById('fecha4');
const grafica = document.getElementById('grafica');
const btn = document.getElementById('graph');

function getfulldate() {
    const formdata = new FormData();
    formdata.append('Fecha1', fecha.value);

    fetch('../models/getFullDate.php', {
            method: 'post',
            body: formdata
        }).then(response => response.json())
        .then(function refill(data) {
            console.log(data);
            fecha2.value = data[0];
            fecha3.value = data[1];
            fecha4.value = data[2];
        });
}