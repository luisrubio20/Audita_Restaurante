const btn = document.getElementById('comparar');
const fecha = document.getElementById('fecha1');
const grafica = document.getElementById('grafica');

btn.addEventListener('click', () => {
    $("#comparar").prop('disabled',true);
     $("#charge1").show();
    document.cookie = 'fecha=' + fecha.value + '; path=/';
    fetch('../models/select_comparativosCB.PHP')
        .then(response => response.json())
        .then(function refill(data) {
            console.log(data);
            if (data != 0) {
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
                $("#grafica").empty();
             $("#detalle").hide();
            $("#comparar").prop('disabled',false);
            $("#charge1").hide();

            }
            $("#detalle").hide();
            $("#comparar").prop('disabled',false);
            $("#charge1").hide();
        });

});

$('.year').datepicker({
    format: 'yyyy',
    viewMode: "years",
    minViewMode: "years"
});