<?php
	require_once('conexion_bd.php');
	/**
$query = "select * from sucursal";

$resultado = pg_query($con, $query) or die("Error en la Consulta SQL");

$numReg = pg_num_rows($resultado);
$tablahtml='';
if($numReg>0){
$tablahtml.= "<table>
<tr class='tabla_encabezado'>
<th>id sucursal</th>
<th>nombre sucursal</th>
<th>codigo sucursal</th></tr>";
while ($fila=pg_fetch_array($resultado)) {
$tablahtml.= "<tr class='tabla_tr2'><td>".$fila['sucursal_id']."</td>";
$tablahtml.= "<td>".$fila['sucursal_nombre']."</td>";
$tablahtml.= "<td>".$fila['sucursal_codigo']."</td></tr>";
}
                $tablahtml.= "</table>";
}else{
                $tablahtml.= "No hay Registros";
}*/
?>

<div class='contenido-interno' style='overflow:auto;'>
	<div class='contenido-titulo'><img src='icono/places/house.png'>  Inicio</div>
<div class='contenido-interno2' style='height:200px; overflow:auto;'>
	<?php //echo $tablahtml; ?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
</div>
