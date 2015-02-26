<?php
	require_once('../conexion_bd.php');
	
	$us_id=$_SESSION['us_id']*1;

	$tiendas = crear_resultados("SELECT * FROM sucursal WHERE sucursal_id IN(SELECT perm_opciones::bigint FROM permiso_usuario WHERE us_id=$us_id AND perm_id=9);");
	
	$suchtml='';
	if($tiendas){
		for($i=0;$i<count($tiendas);$i++){
			$suchtml.="<option value='".$tiendas[$i]['sucursal_id']."'>".$tiendas[$i]['sucursal_nombre']."</option>";
		}
	}
?>

<div class='contenido-interno' style='overflow:auto;'>
	<div class='contenido-titulo'><img src='icono/actions/basket-3.png'>  Productos</div>
<div class='contenido-interno2' style='height:200px; overflow:auto;'>
	<table>
		<tr>
			<td>Sucursal:</td>
			<td><SELECT name='sucursal_id' id='sucursal_id'><?php echo $suchtml; ?></SELECT></td>
		</tr>
	</table>
	<?php //echo $tablahtml; ?><br><br><br><br><br>
</div>
</div>
