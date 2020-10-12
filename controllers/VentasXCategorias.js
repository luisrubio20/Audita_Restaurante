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
            date.value = data;
            fecha = data;

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
    $("#example").hide();
    const formdate = new FormData();
    formdate.append('date', date.value);
    formdate.append('DateValue', fecha);
    formdate.append('dept', dept.value);
    formdate.append('filtro', filtro.value);
    var total = 0;
    contenido.textContent = '';
    $("#charge1").show();
    $("#Consultar").prop('disabled', true);
    $('#example').DataTable().clear().destroy();
    fetch('../models/select_ventasXcategorias.php', {
            method: 'post',
            body: formdate
        })
        .then(response => response.json())
        .then(function refill(data) {
            if (data != 0) {
                for (dat of data) {
                    total += parseFloat(dat.TOTAL);
                    contenido.innerHTML += '<tr><td>' + dat.ar_descri + '</td>' +
                        '<td>' + dat.ar_codigo + '</td>' +
                        '<td>' + currency(dat.CANTIDAD, { pattern: `# ` }).format() + '</td>' +
                        '<td>' + currency(dat.TOTAL, { pattern: `# ` }).format() + '</td>' +
                        '<td>' + currency(dat.PRECIO, { pattern: `# ` }).format() + '</td>' +
                        '</tr>'
                }
                document.getElementById('pie').innerHTML += currency(total, { pattern: `# ` }).format();
                document.getElementById('example').style.cssText = 'width:100%; display: box;'

                $('#example').DataTable({
                    "searching": false
                });

                $("#Consultar").prop('disabled', false)
                $("#charge1").hide();
            } else {
                swal("Error!!", "No hay Datos en esta Fecha", "error", {
                    buttons: false,
                    timer: 800
                });
                $("#example").hide();
                $("#charge1").hide();
                $("#Consultar").prop('disabled', false)
            }
        });
}
var on = 0;

function getDataX() {
    const formdate = new FormData();
    formdate.append('date', date.value);
    formdate.append('DateValue', fecha);
    formdate.append('dept', dept.value);
    formdate.append('filtro', filtro.value);
    contenido.textContent = '';
    $("#charge1").show();
    $("#Consultar").prop('disabled', true);
    $('#example').DataTable().clear().destroy();
    fetch('../models/select_ventasXdept.php', {
            method: 'post',
            body: formdate
        })
        .then(response => response.json())
        .then(function refill(data) {

            if (data != 0) {
                for (dat of data) {
                    contenido.innerHTML += '<tr><td>' + dat.ar_descri + '</td>' +
                        '<td>' + dat.ar_codigo + '</td>' +
                        '<td>' + dat.cantidadRest + '</td>' +
                        '<td>' + currency(dat.cantidadDel, { pattern: `# ` }).format() + '</td>' +
                        '<td>' + currency(dat.TotalRest, { pattern: `# ` }).format() + '</td>' +
                        '<td>' + currency(dat.totalDel, { pattern: `# ` }).format() + '</td>' +
                        '<td>' + currency(parseFloat(dat.TotalRest) + parseFloat(dat.totalDel)).format() + '</td>' +
                        '</tr>'

                }

                document.getElementById('example').style.cssText = 'width:100%; display: box;'

                $('#example').DataTable({
                    "destroy": true,
                    "ordering": false,
                    "info": false,
                    "searching": false
                });
                $("#charge1").hide();
                $("#Consultar").prop('disabled', false)

            } else {
                swal("Error!!", "No hay Datos en esta Fecha", "error", {
                    buttons: false,
                    timer: 800
                });
                $("#charge1").hide();
                $("#Consultar").prop('disabled', false)
            }
        });
}