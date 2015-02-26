<?php
require_once('../conexion_bd.php');

$cant=count($_POST);
$us_id=$_POST['us_id']*1;

pg_query("START TRANSACTION");

pg_query("DELETE FROM permiso_usuario WHERE us_id=$us_id;");
$str_op = '';
$ult=0;
	if($cant>1)
		foreach($_POST as $nombre_campo => $valor){ 
			   if(strrpos($nombre_campo, 'chk_')===false){
				//$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
			   }else{
					$val=explode('|',$valor);
					$valor=$val[1];
					$tipo=$val[0];
					if($tipo*1==1){
						pg_query("INSERT INTO permiso_usuario VALUES(DEFAULT,$valor,CURRENT_TIMESTAMP,$us_id);");
					}
			   }
			 			   
		}
		
		foreach($_POST as $nombre_campo2 => $valor){ 
			   if(strrpos($nombre_campo2, 'chk2_')===false){
				//$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
			   }else{
					$val=explode('|',$valor);
					$tipo=$val[0];
					
					if($tipo*1==2){
						$valores = explode('_',$nombre_campo2);
						print($valores[0].'|'.$valores[1].'|'.$valores[2]);
						$valor_p=$valores[1];
						$str_op=$valores[2];
												
						pg_query("INSERT INTO permiso_usuario VALUES(DEFAULT,$valor_p,CURRENT_TIMESTAMP,$us_id,'$str_op');");
				
						
					}
			   }
			 			   
		}
		
pg_query("COMMIT;");

print('true');
?>