<?php

require_once('../conexion_bd.php');

$us=$_POST['txt_usuario'];

if($us!='') $us_q="us_rut='$us' OR ((us_nombres || ' ' || us_apellido_paterno || ' ' || us_apellido_materno) ILIKE '%$us%')"; else $us_q='true';

$query="SELECT * FROM usuario WHERE $us_q ORDER BY us_id";

$res=pg_query($query) or die("Error en la consulta SQL");

$cant_r=(pg_num_rows($res));

?>

<table width=100%>
	<tr class='tabla_encabezado'>
		<td>RUT</td>
		<td>Nombre</td>
		<td>Apellidos</td>
		<td>SELECCIONAR</td>
	</tr>

<?php

if($res){
	for ($i=0;$i<$cant_r;$i++){
		if($i%2==0) $clase='tabla_tr'; else $clase='tabla_tr2';
		 //onmouseout='if(this.className!=\"tabla_tr_selected\") this.className=\"$clase\";' onmouseover='if(this.className!=\"tabla_tr_selected\") this.className=\"tabla_tr3\";'
		$row = pg_fetch_array($res,$i);
		print("<tr id='tr_".$i."' name='tr_".$i."' style='cursor:pointer;' class='$clase' onClick='sel_user(".$row['us_id'].",".$i.");'>");
		print("<td style='text-align:center;'>".$row['us_rut']."</td>"); 
		print("<td style='text-align:left;'>".html_entity_decode($row['us_nombres'])."</td>"); 
		print("<td style='text-align:left;'>".html_entity_decode($row['us_apellido_paterno']).' '.html_entity_decode($row['us_apellido_materno'])."</td>"); 
		print("<td style='text-align:center;'><img src='icono/actions/arrow-down-3.png'></td>"); 
	}
}
?>
<tr onClick= this.style.border='3px dashed green'>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>

</table>