<?php
	require_once('../conexion_bd.php');
?>

<script>

	function busca_usuario(){
	
		$('sel_ant').value='';
		$('us_id').value='';
		$('sel').value='';	
		$('div_datos').style.display='none';
		$('div_botones2').style.display='none';
		
		var myAjax = new Ajax.Updater(
		"listado_usuario", 'usuarios/listado_usuario.php', { 
		method: "post", 
		parameters: $('txt_usuario').serialize()
		});
		
		dibuja_campos(1);

	}
	
	function sel_user(us_id,pos){
		//actualizo los datos anteriores
		if(($('sel').value)!='')
			$('tr_'+($('sel').value*1)).className = $('sel_ant').value;
			
		$('sel_ant').value=$('tr_'+pos).className;
		$('tr_'+pos).className = 'tabla_tr_selected';		
		$('us_id').value=us_id;
		$('sel').value=pos;	
		carga_info();
		$('div_datos').style.display='';
		$('div_botones2').style.display='';
		dibuja_campos(1);
	}
	
	function carga_info(){
		
		var myAjax = new Ajax.Request(
		'usuarios/cargar_usuario.php',
		{
			method:'post',
			parameters: $('us_id').serialize(),
			onComplete: function(resp) {
			try {
			
				var resultado=resp.responseText.evalJSON(true);
				
				$('txt_rut').value=resultado.us_rut;
				$('txt_nombres').value=resultado.us_nombres;
				$('txt_apellido_pat').value=resultado.us_apellido_paterno;
				$('txt_apellido_mat').value=resultado.us_apellido_materno;
				$('txt_clave').value=resultado.us_clave;
				
				if(resultado.us_activado=='t') $('activado').checked=true; else $('activado').checked=false;
					
				}catch(err){
					alert("ERROR: " + resp.responseText);
				}
			}
		});
	
	}
	
	function modifica_datos(){
	
		if($('activado').checked) activado='true'; else activado='false';
		
		var myAjax = new Ajax.Request(
		'usuarios/modificar_usuario.php',
		{
			method:'post',
			parameters: $('form_datos').serialize()+'&tipo=0'+'&activado_check='+activado,
			onComplete: function(resp) {
			try {
			
				var resultado=resp.responseText.evalJSON(true);
				
				if(resultado){
					alert('Usuario Modificado');
					var us_id=$('us_id').value*1;
					var pos=$('sel').value*1;
					var ant=$('sel_ant').value;
					
					busca_usuario();
					$('us_id').value=us_id;
					$('sel').value=pos;
					$('sel_ant').value=ant;
					sel_user(us_id,pos);
				}
					
				}catch(err){
					alert("ERROR: " + resp.responseText);
				}
			}
		});
		
	
	}
	
	function dibuja_campos(tipo){
		
		if(tipo==1){
		
			if($('us_id').value*1>0){
				$('td_bton_modificar').style.display='none';
				$('btn_agrega_datos').style.display='none';	
				$('btn_modifica').style.display='';	
			}else{
				$('td_bton_modificar').style.display='none'
				$('us_id').value='';
				$('sel').value='';
				$('sel_ant').value='';
				$('txt_rut').value='';
				$('txt_nombres').value='';
				$('txt_apellido_pat').value='';
				$('txt_apellido_mat').value='';
				$('txt_clave').value='';
				$('activado').checked=false;
				$('btn_agrega_datos').style.display='none';	
				$('btn_modifica').style.display='';	
			}		
			
		}else if(tipo==2){
			
			if(($('us_id').value*1)>0 && $('sel_ant').value!='')
				$('tr_'+($('sel').value*1)).className = $('sel_ant').value;
			
			$('div_datos').style.display='';
			$('div_botones2').style.display='none';
			$('td_bton_modificar').style.display='none';
			$('us_id').value='';
			$('sel').value='';
			$('sel_ant').value='';
			$('txt_rut').value='';
			$('txt_nombres').value='';
			$('txt_apellido_pat').value='';
			$('txt_apellido_mat').value='';
			$('txt_clave').value='';
			$('activado').checked=false;	
			$('btn_agrega_datos').style.display='';	
			$('btn_modifica').style.display='none';	
		
		}else{
		
			$('div_datos').style.display='none';
			$('div_botones2').style.display='none';
			$('td_bton_modificar').style.display='none';
			$('us_id').value='';
			$('sel').value='';
			$('sel_ant').value='';
			$('txt_rut').value='';
			$('txt_nombres').value='';
			$('txt_apellido_pat').value='';
			$('txt_apellido_mat').value='';
			$('txt_clave').value='';
			$('activado').checked=false;
			$('btn_agrega_datos').style.display='none';	
			$('btn_modifica').style.display='none';	
			
		
		}
	}

	
	function agregar_datos(){
		if($('activado').checked) activado='true'; else activado='false';
		
		var myAjax = new Ajax.Request(
		'usuarios/agrega_usuario.php',
		{
			method:'post',
			parameters: $('form_datos').serialize()+'&tipo=0'+'&activado_check='+activado,
			onComplete: function(resp) {
			try {
			
				var resultado=resp.responseText.evalJSON(true);
				
				if(resultado){
					alert('Usuario Agregado');	
					$('txt_usuario').value=$('txt_rut').value;
					busca_usuario();
					
				}
					
				}catch(err){
					alert("ERROR: " + resp.responseText);
				}
			}
		});
	}
	
	abrir_permisos = function(){
		var ancho='600'; var alto='400';
		var posicion_x=(screen.width/2)-(ancho/2); 
		var posicion_y=(screen.height/2)-(alto/2); 
		
		var params=$('us_id').serialize();
		window.open('usuarios/pantalla_permisos.php?'+params, 'Permisos', 
		"width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
	}
	
	busca_usuario();
</script>
<form name='form_datos' id='form_datos'>
<div class='contenido-interno' style='overflow:auto;'>
<div class='contenido-titulo'><img src='icono/places/house.png'>  Administraci&oacute;n de Usuarios</div>
<div class='contenido-interno2' style='height:470px; overflow:auto;'>

<div class='contenido-interno3'>
<input type='hidden' name='us_id' id='us_id'>
<input type='hidden' name='sel' id='sel'>
<input type='hidden' name='sel_ant' id='sel_ant'>
	<table>
		<tr>
			<td style='text-align:left;'>B&uacute;scar:</td>
			<td style='text-align:left;'><input size='20' type='text' name='txt_usuario' id='txt_usuario' onKeyUp='busca_usuario();'>
			(Ej.: RUT, Nombre, Apellidos)</td>
		</tr>
	</table>
</div>
<div class='contenido-interno4' id='listado_usuario'  style='height:150px; overflow:auto;'></div>


<table>
<tr>
	<td id='td_bton_agregar'><input type='button' value='Agregar Usuario...' onClick="dibuja_campos(2);"></td>
	<td id='td_bton_modificar' style='display:none;'><input type='button' value='Modificar Usuario...'></td>
</tr>
</table>
<center>
<table>
<tr>
<td>
<div class='contenido-interno4' id='div_datos' style='width:400px; overflow:auto; display:none;'>
<table width='100%'>
	<tr>
		<td>RUT:</td>
		<td><input type='text' name='txt_rut' id='txt_rut' value=''></td>
	</tr>
	<tr>
		<td>Nombres:</td>
		<td><input type='text' name='txt_nombres' id='txt_nombres' value=''></td>
	</tr>
	<tr>
		<td>Apellido Paterno:</td>
		<td><input type='text' name='txt_apellido_pat' id='txt_apellido_pat' value=''></td>
	</tr>
	<tr>
		<td>Apellido Materno:</td>
		<td><input type='text' name='txt_apellido_mat' id='txt_apellido_mat' value=''></td>
	</tr>
	<tr>
		<td>Clave:</td>
		<td><input type='password' name='txt_clave' id='txt_clave' value=''></td>
	</tr>
	<tr>
		<td>Activar:</td>
		<td><input type='checkbox' name='activado' id='activado'></td>
	</tr>
	<tr>
		<td colspan='2' style='text-align:center;' id='td_boton_guardar'>
		<input type='button' id='btn_modifica' value='Guardar...' onClick='modifica_datos();'>
		<input type='button' id='btn_agrega_datos' value='Agregar...' onClick='agregar_datos();'>
		</td>
	</tr>
</table>

</div>
</td>
<td>
<div class='contenido-interno4' id='div_botones2' style='width:200px; display:none;'>
<input type='button' style='width:200px; height:50px; font-size:20px;' id='btn_perfiles' value='Asignar Permisos' onClick='abrir_permisos();'><br />
<input type='button' style='width:200px; height:50px; font-size:20px;' id='btn_perfil_grupos' value='Agrupar Permisos' onClick=''>
	
</div>
</td>
</tr>
</table>
</center>
</div>
</div>
</form>