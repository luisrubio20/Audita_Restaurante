function getReport() {
    const formdate = new FormData();
    formdate.append('fecha1', fecha.value);
    formdate.append('fecha2', fecha2.value);
    formdate.append('fecha3', fecha3.value);
    formdate.append('fecha4', fecha4.value);

    function dateString(date) {
        var event = new Date(date);
        var options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        return (event.toLocaleDateString('es-ES', options));
    }

    fetch('../models/select_report.php', {
            method: 'post',
            body: formdate

        })
        .then(response => response.json())
        .then(function graph(data) {

            if (fecha2.value.length != 0 && data[0].HE_NETO_I != ".00" || data[0].HE_NETO_F != ".00" || data[0].HE_NETO_FS != ".00" || data[0].HE_NETO_F4 != ".00") {
                var dataChar = [

                    {
                        fecha: fecha.value,
                        monto: data[0].HE_NETO_I
                    },
                    {
                        fecha: fecha2.value,
                        monto: data[0].HE_NETO_F
                    },
                    {
                        fecha: fecha3.value,
                        monto: data[0].HE_NETO_FS
                    },
                    {
                        fecha: fecha4.value,
                        monto: data[0].HE_NETO_F4
                    }
                ]
                grafica.textContent = '';

                Morris.Bar({
                    element: 'grafica',
                    data: dataChar,
                    xkey: 'fecha',
                    ykeys: ['monto'],
                    labels: ['monto'],
                    barColors: ['#03c4a1', 'blue'],
                    hidehover: 'always',
                    horizontal: true,
                    stacked: true
                })


                var diff = data[0].HE_NETO_F - data[0].HE_NETO_I;
                var diff2 = data[0].HE_NETO_FS - data[0].HE_NETO_I;
                var diff3 = data[0].HE_NETO_F4 - data[0].HE_NETO_I;


                monto1.innerHTML = '<strong> <h4 style="font-weight: bold;">' + 'Actual' + '</h4> </strong> <h5>' + currency(data[0].HE_NETO_I).format(); + ' </h5><br>'
                monto2.innerHTML = '<strong> <h4 style="font-weight: bold;">' + 'Ayer' + '</h4></strong> <h5>' + currency(data[0].HE_NETO_F).format(); + ' </h5><br>'
                monto3.innerHTML = '<strong> <h4 style="font-weight: bold;">' + 'Hace una semana' + '</h4></strong> <h5>' + currency(data[0].HE_NETO_FS).format(); + ' </h5><br>'
                monto4.innerHTML = '<strong> <h4 style="font-weight: bold;">' + 'hace un año' + '</h4> </strong><h5>' + currency(data[0].HE_NETO_F4).format(); + '</h5><br>'
                difff1.innerHTML = '<strong> <h4 style="font-weight: bold;">Diferencia del Dia anterior: </h4> </strong><h5>' + currency(diff).format(); + '</h5> <br>';
                difff2.innerHTML = '<strong> <h4 style="font-weight: bold;">Diferencia del semana anterior: </h4> </strong><h5>' + currency(diff2).format(); + '</h5><br>';
                difff3.innerHTML = '<strong> <h4 style="font-weight: bold;">Diferencia del año anterior: </h4></strong><h5>' + currency(diff3).format(); + '</h5>';
            } else {
                swal("Error!!", "No hay Datos en esta Fecha", "error", {
                    buttons: false,
                    timer: 800
                });
                $("#content").fadeIn(1000).html('<div class="" style="color:#008d4c;"> <img  style="background: #00a65a;border-radius: 20px;" src="../img/Untitled.png"/>  </div>');
                $("#detalle").hide();

            }

        });
}