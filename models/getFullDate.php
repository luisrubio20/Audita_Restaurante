<?php
    $Fecha1 = $_POST['Fecha1'];

    $fecha2 = date("m/d/Y", strtotime($Fecha1."- 1 day"));
    $fecha3 = date("m/d/Y", strtotime($Fecha1."- 1 week"));
    $fecha4 = date("m/d/Y", strtotime($Fecha1."- 1 year"));
    $fulltime = [$fecha2,$fecha3,$fecha4];
    $date = json_encode($fulltime);
    echo $date;
?>