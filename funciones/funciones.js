




function buscar_datos(texto)
{

                cadena_buscar = "nombre=" + texto;
            $.ajax({
    
                type:"POST",
                url:"/PHP%207/php/sesion.php",
                data:cadena_buscar,
                success:function(e)
                {
                    $("#datos").load("/PHP%207/php/datos.php");
                }
      
            
        });
}






