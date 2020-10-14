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
    var totalPrecio = 0;
    var totalCantidad = 0;
    var totalGeneral = 0;
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
                        totalPrecio += parseFloat(dat.PRECIO);
                        totalCantidad += parseFloat(dat.CANTIDAD);
                        totalGeneral += parseFloat(dat.TOTAL);

                        contenido.innerHTML += '<tr><td>' + dat.ar_descri + '</td>' +
                            '<td>' + dat.ar_codigo + '</td>' +
                            '<td>' + currency(dat.PRECIO, {
                                pattern: `# `
                            }).format() + '</td>' +
                            '<td>' + currency(dat.CANTIDAD, {
                                pattern: `# `
                            }).format() + '</td>' +
                            '<td>' + currency(dat.TOTAL, {
                                pattern: `# `
                            }).format() + '</td>' +
                            '</tr>'
                    }

                    document.getElementById('example').style.cssText = 'width:100%; display: box;'

                    contenido.innerHTML += `
                    <tr>
                    <th>TOTALES</th>
                    <td></td>
                    <td>${currency(totalPrecio, { pattern: `# ` }).format()}</td>
                    <td>${currency(totalCantidad, { pattern: `# ` }).format()}</td>
                    <td>${currency(totalGeneral, { pattern: `# ` }).format()}</td>
                    </tr>
                    `;


                $('#example').DataTable({
                    "searching": false,
                    "responsive": true,
                    "order": [
                        [2, "desc"]
                    ]

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
    var totalPrecio = 0;
    var totalCantidad = 0;
    var totalGeneral = 0;
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
                    totalPrecio += parseFloat(dat.TotalRest);
                    totalCantidad += parseFloat(dat.totalDel);
                    totalGeneral += (parseFloat(dat.TotalRest) + parseFloat(dat.totalDel));
                    contenido.innerHTML += '<tr><td>' + dat.ar_descri + '</td>' +
                        '<td>' + dat.ar_codigo + '</td>' +
                        '<td>' + dat.cantidadRest + '</td>' +
                        '<td>' + currency(dat.cantidadDel, {
                            pattern: `# `
                        }).format() + '</td>' +
                        '<td>' + currency(dat.TotalRest, {
                            pattern: `# `
                        }).format() + '</td>' +
                        '<td>' + currency(dat.totalDel, {
                            pattern: `# `
                        }).format() + '</td>' +
                        '<td>' + currency(parseFloat(dat.TotalRest) + parseFloat(dat.totalDel)).format() + '</td>' +
                        '</tr>'

                }

                document.getElementById('example').style.cssText = 'width:100%; display: box;'

                contenido.innerHTML += `
                <tr>
                <th>TOTALES</th>
                <td></td>
                <td></td>
                <td></td>
                <td>${currency(totalPrecio, { pattern: `# ` }).format()}</td>
                <td>${currency(totalCantidad, { pattern: `# ` }).format()}</td>
                <td>${currency(totalGeneral, { pattern: `# ` }).format()}</td>
                </tr>
                `;

                $('#example').DataTable({
                    "searching": false,
                    "responsive": true,
                    "order": [
                        [6, "desc"]
                    ]
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