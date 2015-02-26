<?php
	session_start();
	session_unset();
	session_destroy();
	
?>
<html>
<head>
<title>Identificaci&oacute;n de Usuario</title>

<link href="css/sistema.css" type="text/css" rel="stylesheet"/>	
</head>

<body>
<center>
<table>
	<tr>
		<td style='text-align:center;'><img src='imagenes/logo.png'></td>
	</tr>
	<tr>	
		<td>
		<center>
			<form action='index.php' method='POST'>
				<div style='width:220px; height:120px;' class='contenido-interno'>
					<table>
						<tr>
							<td colspan=2><img src='icono/actions/user-go.png'><b>Iniciar Sesi&oacute;n</b></td>
						</tr>
						<tr>
							<td>Usuario:</td>
							<td><input type='text' name='txt_usuario' id='txt_usuario' size='15'></td>
						</tr>
						<tr>
							<td>Clave:</td>
							<td><input type='password' name='txt_clave' id='txt_clave' size='15'></td>
						</tr>
						<tr>
							<td colspan=2 style='text-align:center;'><input type='submit' value='(Ingresar...)'></td>
						</tr>
					</table>
				</div>
			</form>
		</center>
		</td>
	</tr>
</table>
</center>
</body>

</html>