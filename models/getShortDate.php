<?php
    $date = date('m/d/Y');
    $DateValue = $_POST['DateValue'];

    $shortdate = date("m/d/Y", strtotime($date."-".$DateValue));

    echo json_encode($shortdate);
?>