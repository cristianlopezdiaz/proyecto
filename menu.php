<?php 
	require_once("conexion_bd.php");
 ?>
<html lang="en">
<head> 
  <meta charset="utf-8">
  <title>jQuery UI Menu - Icons</title>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>
  var $j=jQuery.noConflict();
  $j(function() {
    $j( "#menu" ).menu();
  });

   /**$(document).ready(function() {
		$("#inicio").click(function(event) {
        $("#contenido").load('ejemplo.php');
        });
    });*/
    
    function abrir_pagina(pagina){
	
		$j('#contenido').html('<div class="div_cargando"><img class="img_cargando" src="imagenes/cargando.gif"><br/>Cargando...</div>');
		$j("#contenido").load(pagina);
	} 
  </script>
  <style>
  .ui-menu { width: 250px; margin-left:10px }
  </style>
</head>
<body>
 
<ul id="menu">
  <li id='inicio' name='inicio' onClick='abrir_pagina("inicio.php");'><span class="ui-icon ui-icon-home"></span>Inicio</li>
   <?php if(perm(8)){?><li><span class="ui-icon ui-icon-zoomin"></span>Ventas</li><?php } ?>
 <?php if(perm(1) OR perm(2) OR perm(6) OR perm(7)){?> <li>
    Administraci&oacute;n
    <ul>
      <?php if(perm(1)){ ?><li onClick='abrir_pagina("usuarios/inicio.php");'><span class="ui-icon ui-icon-seek-start"></span>Usuarios</li><?php } ?>
      <?php if(perm(2)){ ?><li onClick='abrir_pagina("inicio.php");'><span class="ui-icon ui-icon-stop"></span>Sucursales</li><?php } ?>
      <?php if(perm(6)){ ?><li><span class="ui-icon ui-icon-play"></span>Proveedores</li><?php } ?>
      <?php if(perm(7)){ ?><li onClick='abrir_pagina("producto/inicio.php");'><span class="ui-icon ui-icon-seek-end"></span>Productos</li><?php } ?>
    </ul>
  </li>
  <?php } ?><!--FIN PERMISOS ADMINISTRACION-->
  <li onClick='window.open("login.php", "_self", false);'>Salir</li>
</ul>
 
 
</body>
</html>
