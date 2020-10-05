
 function detalle(Tipo)
 {
    var fecha1 = $("#fecha").val();
     if(Tipo == 'sobrantes')
     {
      document.cookie='fecha=' + fecha1 + '; path=/';

        $("#carrito").empty();
        document.getElementById("carrito").classList.remove('control-sidebar-open');
        $("#carrito").load("detalle_de_sobrante.php");
        $("#btn_t").click();  

     }
     else if(Tipo == 'faltantes')
     {
      document.cookie='fecha=' + fecha1 + '; path=/';

         $("#carrito").empty();
         document.getElementById("carrito").classList.remove('control-sidebar-open');
         $("#carrito").load("detalle_de_faltantes.php");
         $("#btn_t").click();  
     }
    }