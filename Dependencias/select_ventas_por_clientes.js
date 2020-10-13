$(document).ready(function() {

    $("#cliente").select2({});
    $("#fecha_inicio").datepicker({ format: 'dd/mm/yyyy', });
    $("#fecha_inicio").keypress(function(e) { return false; });
    $("#fecha_inicio").keydown(function(e) { if (e.keyCode == 8) { e.preventDefault(); } });


    $("#Dias").on('change', function() {
        var dias = $("#Dias").val();

        if (dias == "Hoy") { fecha = "<?=date("
            d / m / Y ");?>"; } else if (dias == "Ayer") { fecha = '<?=date("d/m/Y",strtotime($fecha_actual."- 1 days"))?>'; } else if (dias == "Antesayer") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 2 day "))?>"; } else if (dias == "hace3") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 3 days "))?>"; } else if (dias == "hace4") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 4 days "))?>"; } else if (dias == "hace5") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 5 days "))?>"; } else if (dias == "hace6") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 6 days "))?>"; } else if (dias == "hace7") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 7 days "))?>"; } else if (dias == "hace8") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 8 days "))?>"; } else if (dias == "hace9") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 9 days "))?>"; } else if (dias == "hace10") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 10 days "))?>"; } else if (dias == "hace11") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 11 days "))?>"; } else if (dias == "hace12") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 12 days "))?>"; } else if (dias == "hace13") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 13 days "))?>"; } else if (dias == "hace14") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 14 days "))?>"; } else if (dias == "hace3semanas") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 21 days "))?>"; } else if (dias == "hace4semanas") { fecha = "<?=date("
            d / m / Y ",strtotime($fecha_actual." - 28 days "))?>"; }

        $("#fecha_inicio").val(fecha);


    });


    $("#buscar").on('click', function() {

        $('#VentasA').html('<div class="loading" style="color:#3c8dbc;"><img src="../img/ac1.gif"/>Un momento, por favor...</div>');
        $("#Ventas").empty();

        var cliente = $("#cliente").val();
        var Rango = $("#Rango").val();
        var Facturas = $("#Facturas").val();
        var fecha_inicio = $("#fecha_inicio").val();

        document.cookie = 'cliente=' + cliente + '; path=/';
        document.cookie = 'Rango=' + Rango + '; path=/';
        document.cookie = 'fecha_inicio=' + fecha_inicio + '; path=/';

        if (fecha_inicio.length > 10 || fecha_inicio.length < 10 || fecha_inicio == " ") {
            swal("Error!!", "La fecha no esta bien definida", "error");
            $("#VentasA").fadeIn(1000).html('<div class="" style="color:#008d4c;"> <img  style="background: #00a65a;border-radius: 20px;" src="../img/Untitled.png"/>  </div>');


            return;
        } else {


            $.ajax({

                type: "post",
                url: "selectventasclientes.php",
                success: function(Ventas) {

                    if (Ventas == 0) {

                        swal("Error!!", "No hay Datos en esta Fecha", "error");
                        $("#VentasA").fadeIn(1000).html('<div class="" style="color:#008d4c;"> <img  style="background: #00a65a;border-radius: 20px;" src="../img/Untitled.png"/>  </div>');

                    } else {
                        $('#Ventas').fadeIn(1000).html(Ventas);
                        $("#VentasA").fadeIn(1000).html('<div class="" style="color:#008d4c;"> <img  style="background: #00a65a;border-radius: 20px;" src="../img/Untitled.png"/>  </div>');
                    }

                }

            }); // click finish
        }
    });

}); //ready finish