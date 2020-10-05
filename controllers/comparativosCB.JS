const btn = document.getElementById('comparar');
const fecha = document.getElementById('fecha1');
const grafica = document.getElementById('grafica');

btn.addEventListener('click', () => {
    document.cookie = 'fecha=' + fecha.value + '; path=/';
    fetch('../models/select_comparativosCB.PHP')
        .then(response => response.json())
        .then(function refill(data) {
            if (fecha.value.length != 0) {
                grafica.textContent = '';
                Morris.Bar({
                    element: 'grafica',
                    data: data,
                    xkey: 'mes',
                    ykeys: ['total', 'costo', 'beneficio'],
                    labels: ['total', 'costo', 'beneficio'],
                    barColors: ['#006d19', 'blue'],
                }).on('click', function(i, row) {
                    console.log(i, row);
                });
            } else {
                swal("Error!!", "No hay Datos en esta Fecha", "error", {
                    buttons: false,
                    timer: 800
                });
                $("#content").fadeIn(1000).html('<div class="" style="color:#008d4c;"> <img  style="background: #00a65a;border-radius: 20px;" src="../img/Untitled.png"/>  </div>');
                $("#detalle").hide();

            }
        });

});

$('.year').datepicker({
    format: 'yyyy',
    viewMode: "years",
    minViewMode: "years"
});