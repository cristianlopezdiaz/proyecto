<?php

require_once('../conexion_bd.php');

$rut=$_POST['txt_rut'];
$us_nombres=$_POST['txt_nombres'];
$paterno=$_POST['txt_apellido_pat'];
$materno=$_POST['txt_apellido_mat'];
$clave=$_POST['txt_clave'];
$tipo=$_POST['tipo']*1;
$activado=$_POST['activado_check'];
$estado='';

	$query="INSERT INTO usuario VALUES(DEFAULT,'$rut','$us_nombres','$paterno','$materno',md5('$clave'),$activado)";
	
	$res=pg_query($query);
	$estado='Usuario Agregado';

print(json_encode($estado));


?>