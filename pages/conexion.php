<?php  

session_start();
ini_set('display_errors',1);    


$SERVER_NAME = "DBSERVER";
$DATABASE="facfoxsql";
$DB_USER="sa";
$DB_PASSWORD='pr0i$$a';


$y1;
$y2;
$y3;




try
{
     $pdo = new PDO("sqlsrv:server=$SERVER_NAME;DATABASE=$DATABASE",$DB_USER,$DB_PASSWORD);
                $pdo->query("SET NAMES latin1");
                 $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
}
catch(PDOException $e)
{
    echo $e->getMessage();
    die();
} 



$query = $pdo->query("SELECT * FROM CONTAEMP");
$datos = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($datos as $key => $value) 
   {
    $y1 = $value['nombre'];
    $y2 =$value['direc1'];
    $y3 =$value['telef1'];
}
