<?php

require_once('../conexion_bd.php');

$us=$_POST['us_id']*1;
$us_nombres=$_POST['txt_nombres'];
$paterno=$_POST['txt_apellido_pat'];
$materno=$_POST['txt_apellido_mat'];
$tipo=$_POST['tipo']*1;
$activado=$_POST['activado_check'];
$estado='';

if($tipo==0){
	$query="UPDATE usuario SET 
		us_nombres='$us_nombres', 
		us_apellido_paterno='$paterno', 
		us_apellido_materno='$materno',
		us_activado=$activado
		WHERE us_id=$us";
	
	$res=pg_query($query);
	$estado='Usuario Modificado';
}

print(json_encode($estado));


?>