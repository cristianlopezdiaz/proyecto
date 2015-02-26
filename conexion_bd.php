<?php

require_once('configuracion.php');

Global $con;

$permi = Array();

$con = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if(!$con) { die('Problemas con la Conexi&oacute;n.'); }

session_start();

if(!isset($_SESSION['us_id']) AND isset($_POST['txt_usuario'])){

	$usuario = pg_escape_string(trim(strtoupper($_POST['txt_usuario'])));
	$clave =  pg_escape_string($_POST['txt_clave']);
	
	$us_query = pg_query("SELECT us_id, us_nombres || ' ' || us_apellido_paterno || ' ' || us_apellido_materno as us_nombres, us_rut
	FROM usuario WHERE us_rut='$usuario' AND us_clave=md5('$clave') AND us_activado;");
	
	if(pg_num_rows($us_query)!=1){
		die("<script>alert('Usuario Incorrecto'); window.open('$ruta_sistema/login.php', '_self');</script>");
	}
	
	$info = pg_fetch_row($us_query);
	
	$nombres = $info[1];
	$us_id = $info[0];
	$us_rut = $info[2];
	
	$_SESSION['us_id'] = $us_id;
	$_SESSION['us_nombres'] = $nombres;
	$_SESSION['us_rut'] = $us_rut;


}

ob_start();

if(!$_SESSION OR !isset($_SESSION['us_id']) OR ($_SESSION['us_id']==0)){
	
	header("Location: $ruta_sistema/login.php");

}

function crear_resultado($consulta){

	$resultado_array = array();
	
	$resultado=pg_query($consulta);
	$numfields = pg_num_fields($resultado);
	if($resultado){		
		while ($row = pg_fetch_row($resultado)) {
			 for ($i=0;$i<$numfields;$i++) {
				$resultado_array[pg_field_name($resultado,$i)]=$row[$i];
				//print($row[$i].'<br>');
			}
		}
	}else{
		$resultado_array=false;
	}
	return $resultado_array;

}

function crear_resultados($consulta){

	//$resultado_array = array();
	
	$resultado=pg_query($consulta);
	$numfields = pg_num_fields($resultado);
	if($resultado){		
		$resultado_array=pg_fetch_all($resultado);
	}else{
		$resultado_array=false;
	}
	return $resultado_array;

}

function perm($permiso){
	Global $permi;

	$permi = crear_resultados("SELECT perm_id FROM permiso_usuario WHERE us_id=".$_SESSION['us_id']);
	
	$permiso=$permiso*1;
	$estado=false;

	for($i=0; $i<count($permi);$i++){
		if($permi[$i]['perm_id']*1==$permiso){
			$estado=true;
		}
	}
	
	return $estado;
}
?>
