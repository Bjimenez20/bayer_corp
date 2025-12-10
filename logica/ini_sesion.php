<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<link rel="stylesheet" type="text/css" href="../presentacion/css/saisenestilo.css" />
	<link rel="stylesheet" type="text/css" href="../presentacion/css/btn_filtros.css" />

	<link rel="stylesheet" href="../presentacion/css/estilos_menu.css" />
	<link rel="stylesheet" href="../presentacion/css/fonts.css" />
	<style type="text/css">
		._css3m {
			display: none
		}
	</style>



	<!-- End css3menu.com HEAD section -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>INICIO</title>
	<link rel="shortcut icon" href="report.jpg" />
	<style>
		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	</style>
</head>

<body>
	<div style="display:inline-block;margin-left:1%; margin-top:1%;">
		<img src="../presentacion/imagenes/esquina.png" height="120" />
	</div>
	<?PHP

	//require('include_sup.php'); //traigame lo que viene de esta pagina//

	//session_start();
	require('../datos/parse_str.php');
	require('../datos/conex.php');
	$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
	mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");

	$_SESSION['NAME'] = '';
	$USER = addslashes($_POST['usuario']);
	$CONTRASENA = addslashes($_POST['Contrasena']);


	//  $sql = mysql_query("SELECT * FROM `bayer_usuario` WHERE `USER` = '".$USER."' and `CONTRASENA` = MD5('".$CONTRASENA."') and `ESTADO` != '0' ",$conex) or die ("No se Puede hacer la cosulta");

	$sql = mysqli_query($conex, "SELECT `USER`, `CONTRASENA`, `PRIVILEGIOS`, `CONTRASENA_FECHA`,`ID_USUARIO` FROM `bayer_usuario` WHERE `USER` = '" . $USER . "' and `CONTRASENA` = MD5('" . $CONTRASENA . "') and `ESTADO` != '0' ") or die("No se Puede hacer la cosulta");

	$conusuario = mysqli_query($conex, "SELECT `USER`, `INTENTOS`, `ESTADO` FROM `bayer_usuario` WHERE `USER` = '" . $USER . "' and `ESTADO` != '0' ") or die("No se Puede hacer la cosulta");

	echo mysqli_error($conex);

	mysqli_num_rows($sql);

	if (mysqli_num_rows($sql) > 0) {
		$linea = mysqli_fetch_array($sql);

		$usua = $linea[0];
		$privilegios = $linea[2];
		$contra_fecha = $linea[3];
		$id_usuario = $linea[4];
		$hoy = date("Y-m-d H:i:s");

		$_SESSION["usuarios"] = $usua;
		$_SESSION["privilegios"] = $privilegios;
		$_SESSION["id"] = $id_usuario;

		$actu = mysqli_query($conex, "UPDATE bayer_usuario SET 
	  INTENTOS = '0'
	  WHERE USER='" . $usua . "';");

		if ($CONTRASENA == '1234' or $hoy >= $contra_fecha) {
			require("../presentacion/form_restablecer_clave.php");
		} else {
			switch ($privilegios) {
				case '1':
					require("../presentacion/inicio_admin.php");
					break;
				case '2':
					require("../presentacion/inicio_call.php");
					break;
				case '3':
					require("../presentacion/inicio_bodega.php");
					break;
				case '4':
					require("../presentacion/inicio_fundem.php");
					break;
				case '5':
					require("../presentacion/inicio_consultas.php");
					break;
			}
		}
	} else {

		if (mysqli_num_rows($conusuario) > 0) {
			$linea2 = mysqli_fetch_array($conusuario);

			$usua2 = $linea2[0];
			$intentos = $linea2[1];
			$estado = $linea2[2];

			if ($intentos >= 3 or $estado == 0) {
	?>
				<script>
					if (confirm('Usuario Bloqueado Comuniquese con el administrador')) {
						window.onload = window.top.location.href = "../index.php";
					} else {
						window.onload = window.top.location.href = "../index.php";
					}
				</script>
			<?php
				$actu = mysqli_query($conex, "UPDATE bayer_usuario SET 
		  ESTADO = '0'
		  WHERE USER='" . $usua2 . "';");
			} else {
				$NUM_INTENTOS = $intentos + 1;
				$actu = mysqli_query($conex, "UPDATE bayer_usuario SET 
		INTENTOS = '" . $NUM_INTENTOS . "'
		WHERE USER='" . $usua2 . "';");
			?>
				<script>
					if (confirm('Contrase&ntilde;a incorrecta')) {
						window.onload = window.top.location.href = "../index.php";
					} else {
						window.onload = window.top.location.href = "../index.php";
					}
				</script>
			<?php
			}
		} else {

			?>
			<script>
				if (confirm('Usuario Bloqueado Comuniquese con el administrador')) {
					window.onload = window.top.location.href = "../index.php";
				} else {
					window.onload = window.top.location.href = "../index.php";
				}
			</script>
	<?php

			require("cerrar_sesion.php");
			exit();
		}
	}
	mysqli_close($conex);

	/*    */
	?>
	<script src="../jquery.js"></script>
	<script src="../presentacion/js/menu.js"></script>
</body>

</html>