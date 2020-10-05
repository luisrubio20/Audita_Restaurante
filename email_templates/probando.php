
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://10.0.10.16:8080/PHP%207/Css/bootstrap.min.css">

</head>
<body>
    

<style>


.info{

   font-family: 'Times New Roman', Times, serif;

}
.table{
   width: 400px;
   height: 5%; 


   border-radius: 100px 80px;

   border-collapse: collapse;
    border-radius: 30px;
    border-style: hidden; /* hide standard table (collapsed) border */
    box-shadow: 0 0 0 1px #666; /* this draws the table border  */ 
  
}
.img{

   height: 40%; 

}

</style>
    





<div class="container">





  <img class="img" src="http://10.0.10.16:8080/PHP%207/img/contapro.png"   with="50"  alt=""><!--Refernciar la direcion ip del servidor local que trae la imaegn  -->


         <h1 class="info">Estimado cliente {{cliente}}</h1>
            <p class="info"> {{cuerpo}}</p>
            <p class="info">Su Balance Pendiente es de : <label style="font-weight: bold;">{{balance}}</label> </p>

     
            <hr style="color:blue;">




</div>











</body>
</html>