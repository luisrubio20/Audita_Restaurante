function Open()
{
   document.getElementById("carrito").classList.add('control-sidebar-open');
}

function Close()
{
  document.getElementById("carrito").classList.remove('control-sidebar-open');
  $("#carrito").empty(); 
  $(window).scrollTop(0);
}