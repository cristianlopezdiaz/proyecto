<?php

require_once('../conexion_bd.php');

$us=$_POST['us_id']*1;

$query="SELECT * FROM usuario WHERE us_id=$us LIMIT 1";

$res=pg_query($query);

$reg = array();

for($i=0;$i<pg_num_fields($res);$i++) {
  
    $reg[pg_field_name($res, $i)]=html_entity_decode(pg_fetch_result($res, $i)); 
	
}

print(json_encode($reg));

?>