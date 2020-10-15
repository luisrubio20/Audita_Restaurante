<?php 
require '../pages/conexion.php';


if(!isset($_POST['searchTerm']))
{
   $select=$pdo->query("SELECT TOP 10 ar_codigo,ar_descri FROM ivbdarti");
}
else
{
    $articulo = $_POST['searchTerm'];
    $select=$pdo->query("SELECT TOP 10 ar_codigo,ar_descri FROM ivbdarti WHERE ar_descri LIKE '%$articulo%'"); 
}
$value = $select->fetchAll();

$Response = array();
foreach ($value as $fila)
{
 
    $Response[] = array(
        "codigo" => $fila['ar_codigo'],
        "descripcion" => $fila['ar_descri']
    );
}
       
        echo json_encode($Response);


?>
              
              
           