<?php require_once('conexion_bd.php'); ?>

<html>
	<head>
		<title><?php echo $nombre_sistema; ?></title>
		<meta http-equiv=content-type content="text/html; charset=windows-1250" />
		<script src='js/prototype.js' type='text/javascript' />
		<script> var $j=jQuery.noConflict();</script>
		<link href="css/sistema.css" type="text/css" rel="stylesheet"/>	
	</head>
	<body>
		<div id='header'>
			<table width='100%'>
				<tr>
					<td height='50' style='color:#6E6E6E; font-weight: bold; font-size:26px'><?php echo $nombre_sistema; ?></td>
					<td style="font-size:12px">Iniciado como: <?php print(utf8_decode($_SESSION['us_nombres'])); ?></td>
					<td height='50' style='text-align:right;'><img class='img_logo' src='<?php print($ruta_logo); ?>' alt='logo Sistema'></td>
				</tr>
			</table>
		</div>
		
		<div id='contenidoMenu'>
			<table>
				<tr>
					<td><div id='div_menu'><?php require_once('menu.php');?></div></td>
				</tr>
			</table>
		</div>
		<div id='contenido'> 
			
		</div>
	</body>
</html>
