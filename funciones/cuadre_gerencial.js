
//Llenar carrito
    function detalle(Tipo)
    {

        if(Tipo == 'totalingreso')
        {
            $("#carrito").empty();
            document.getElementById("carrito").classList.remove('control-sidebar-open');
            document.cookie='fecha=' + fecha + '; path=/'; 
            $("#carrito").load("relacion_de_ingreso.php");
            $("#btn_t").click();  

        }
        else if(Tipo == 'totalpagados')
        {
            $("#carrito").empty();
            document.getElementById("carrito").classList.remove('control-sidebar-open');
            document.cookie='fecha=' + fecha + '; path=/'; 
            $("#carrito").load("relacion_de_pagados.php");
            $("#btn_t").click();  
        }
        else if(Tipo == 'totalcheques')
        {
            $("#carrito").empty();
            document.getElementById("carrito").classList.remove('control-sidebar-open');        
            document.cookie='fecha=' + fecha + '; path=/'; 
            $("#carrito").load("relacion_de_cheques_emitidos.php");
            $("#btn_t").click();  
        }
        else if(Tipo == 'depositosdeldia')
        {
            $("#carrito").empty();
            document.getElementById("carrito").classList.remove('control-sidebar-open');
            document.cookie='fecha=' + fecha + '; path=/'; 
            $("#carrito").load("relacion_depositos_del_dia.php");
            $("#btn_t").click();  
        }
        else if(Tipo == 'balanceclientes')
        {
            $("#carrito").empty();
            document.getElementById("carrito").classList.remove('control-sidebar-open');
            document.cookie='fecha=' + fecha + '; path=/'; 
            $("#carrito").load("relacion_balance_clientes.php");
            $("#btn_t").click();  
        }

    }







