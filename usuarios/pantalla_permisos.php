<?php

	require_once('../conexion_bd.php');
	
	$us_id = $_GET['us_id']*1;
	
	$us_q=crear_resultado("SELECT * FROM usuario WHERE us_id=$us_id;");
	
	//////////SE CARGAN LOS GRUPOS DE PERMISOS/////////////////////////////////
	$pcat=crear_resultados("SELECT * FROM permiso_categoria ORDER BY permc_id;");
	//////////FIN CARGA DE GRUPOS//////////////////////////////////////////////
	
	if(!perm(1)){ print("<script>window.close();</script>"); }
?>
<html>
<head>
	<meta http-equiv=content-type content="text/html; charset=windows-1250" />
	<script src="../js/prototype.js" type="text/javascript" />
	<script> var $j=jQuery.noConflict();</script>
	<link rel="stylesheet" href="../css/jquery-ui.css">

	
	<link href="../css/sistema.css" type="text/css" rel="stylesheet"/>
	
	<script>
		function guardar_permisos(){
			$('btn_guardar').innerHTML="<img src='../imagenes/cargando.gif' width='20px' height='20px'>";
			
						
			var myAjax = new Ajax.Request(
				'guardar_permisos.php',
				{
					method:'post',
					parameters: $('form_permiso').serialize()+'&us_id=<?php echo $us_id; ?>',
					onComplete: function(resp) {
					try {
							$('btn_guardar').innerHTML="<B>PERMISOS GUARDADOS!</B>";
							alert("Permisos Asignados");
							window.close();
					}catch(err){
							alert("ERROR: " + resp.responseText);
					}
					}
				});
		}
	</script>

</head>

<body>
<form name='form_permiso' id='form_permiso'>
<div class='contenido-interno3'>
	<table width='100%'>
		<tr>
			<td style='text-align:left;font-weight:bold;font-size:12px;'><img src='../icono/actions/checkbox-2.png'> <b>Permisos Asignados</b></td>
		
			<td style='text-align:right;font-size:10px;'><?php echo '<b>'.$us_q['us_rut'].' - </b>'.utf8_decode($us_q['us_nombres']).' '.utf8_decode($us_q['us_apellido_paterno']).' '.utf8_decode($us_q['us_apellido_materno']); ?></td>
		</tr>
	</table>
		
</div>
<div class='contenido-interno3'>
<table width='100%'>
<?php 
	for($i=0;$i<count($pcat);$i++){
		print("<tr class='tabla_tr'>
					<td colspan='2' style='text-align:center;font-weight:bold;font-size:12px;'>".$pcat[$i]['permc_nombre']."</td>
			</tr>");
		
		$perms=crear_resultados("SELECT * FROM permiso WHERE perm_cat=".$pcat[$i]['permc_id']."ORDER BY perm_id, perm_orden");
		
		for($o=0;$o<count($perms);$o++){
			
			$perm_us = crear_resultado("SELECT * FROM permiso_usuario WHERE perm_id=".$perms[$o]['perm_id']." AND us_id=".$us_id." LIMIT 1");
			
			if($perms[$o]['perm_tipo']*1==1){
				if($perm_us) $checked='CHECKED'; else $checked=''; 
			
				print("<tr class='tabla_tr2'>
						<td style='text-align:left;font-size:12px;' width='70%'>".$perms[$o]['perm_nombre']."</td>
						<td style='text-align:left;font-size:12px;' width='30%'>
							<input type='checkbox' name='chk_".$perms[$o]['perm_id']."' id='chk_".$perms[$o]['perm_id']."' value='".$perms[$o]['perm_tipo']."|".$perms[$o]['perm_id']."' $checked>
							Activado
						</td>
				</tr>");
			}else if($perms[$o]['perm_tipo']*1==2){
							
				print("<tr class='tabla_tr2'><td style='text-align:left;font-size:12px;' width='70%'>".$perms[$o]['perm_nombre']."</td>
						<td style='text-align:left;font-size:12px;' width='30%'>
						<div class='contenido-interno4' style='width: 200px; height:70px; overflow:auto;'>
					");
				
				$sucursales = crear_resultados("SELECT * FROM sucursal ORDER BY sucursal_id;");
				for($s=0;$s<count($sucursales);$s++){
				
					$perm_us = crear_resultado("SELECT * FROM permiso_usuario WHERE perm_id=".$perms[$o]['perm_id']." AND us_id=".$us_id." AND perm_opciones='".$sucursales[$s]['sucursal_id']."' LIMIT 1");
					
					if($perm_us)
					if($perm_us['perm_opciones']==$sucursales[$s]['sucursal_id']) $checked='CHECKED'; else $checked=''; 
					else	$checked='';

					print("<input type='checkbox' name='chk2_".$perms[$o]['perm_id']."_".$sucursales[$s]['sucursal_id']."' id='chk2_".$perms[$o]['perm_id']."_".$sucursales[$s]['sucursal_id']."' value='".$perms[$o]['perm_tipo']."|".$sucursales[$s]['sucursal_id']."' $checked>
							".utf8_decode($sucursales[$s]['sucursal_nombre'])."<br>");
				}
				
				print("<div></td></tr>");
			}
		}
	}
?>
</table>
</div>
<center><span id='btn_guardar'><input type='button' id='btn' name='btn' value='Guardar Permisos...' onClick='guardar_permisos();'></span></center>
</form>
</body>


</html>