<?php

	require_once('../conexion_bd.php');
	
	$us_id = $_GET['us_id']*1;
	
	$us_q=crear_resultado("SELECT * FROM usuario WHERE us_id=$us_id;");
	
	//////////SE CARGAN LOS GRUPOS DE PERMISOS/////////////////////////////////
	//////////FIN CARGA DE GRUPOS//////////////////////////////////////////////////////
?>
<html>
<head>
	<meta http-equiv=content-type content="text/html; charset=windows-1250" />
	<script src="../js/prototype.js" type="text/javascript" />
	<script> var $j=jQuery.noConflict();</script>
	<link rel="stylesheet" href="../css/jquery-ui.css">
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/jquery-ui.js"></script>
	
	<link href="../css/sistema.css" type="text/css" rel="stylesheet"/>

</head>

<body>
<div class='contenido-interno3'>
	<table width='100%'>
		<tr>
			<td style='text-align:left;font-weight:bold;font-size:12px;'><img src='../icono/actions/checkbox-2.png'> <b>Permisos Asignados</b></td>
		
			<td style='text-align:right;font-size:10px;'><?php echo '<b>'.$us_q['us_rut'].' - </b>'.utf8_decode($us_q['us_nombres']).' '.utf8_decode($us_q['us_apellido_paterno']).' '.utf8_decode($us_q['us_apellido_materno']); ?></td>
		</tr>
	</table>
		
</div>
<div class='contenido-interno3'>

</div>
</body>


</html>