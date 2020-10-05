<?php
    $date = $_POST['date'];
    $DateValue = $_POST['DateValue'];

    $shortdate = date("m/d/Y", strtotime($date."-".$DateValue));

    echo json_encode($shortdate);
?>