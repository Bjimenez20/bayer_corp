<?php
require_once('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>insertar</title>
	<style>
		.aviso3 {
			font-size: 130%;
			font-weight: bold;
			color: #11a9e3;
			text-transform: uppercase;
			/*font-family: "Trebuchet MS";
	font-family:"Gill Sans MT";
	border-radius:10px;
	background: #11a9e3;*/
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		.error {
			font-size: 130%;
			font-weight: bold;
			color: #fb8305;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		.btn_continuar {
			padding-top: 7px;
			width: 152px;
			height: 37px;
			color: transparent;
			background-color: transparent;
			border-radius: 5px;
			border: 1px solid transparent;
		}

		.btn_continuar:active {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}

		.btn_continuar:hover {
			box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
			box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.3),
				inset 0px 0px 20px #EEECEC;
		}
	</style>
</head>

<body>
	<?PHP
	require('../datos/parse_str.php');
	mysqli_query($conex, "SET NAMES utf8");
	require_once("../datos/conex.php");

	if (isset($_POST['registrar'])) {

		$GES_REALIZAR = $_POST['ges_realizar'];
		$MEDIO_INGRESO = $_POST['MEDIO_INGRESO'];
		$UNIDAD_NEGOCIO = $_POST['UNIDAD_NEGOCIO'];
		if ($UNIDAD_NEGOCIO != "RRHH") {
			$TIPIFICACION = $_POST['TIPIFICACION'];
		} else {
			$TIPIFICACION = $_POST['CATEGORIA'];
		}

		$FECHA_CIERRE = $_POST['FECHA_CIERRE'];
		$FECHA_RECIBIDO = $_POST['FECHA_RECIBIDO'];
		$NOMBRE = $_POST['NOMBRE'];
		$TIPO = $_POST['TIPO'];
		$EMPRESA = $_POST['EMPRESA'];
		$CARGO = $_POST['CARGO'];
		$PAIS = $_POST['PAIS'];

		if ($PAIS != 'OTRO') {
			$CIUDAD = $_POST['CIUDAD'];
			$DEPARTAMENTO = $_POST['DEPARTAMENTO'];
		}
		if ($PAIS == 'OTRO') {
			$PAIS = strtoupper($_POST['otro_pais_text']);
			$CIUDAD = "N/A";
			$DEPARTAMENTO = "N/A";
		}
		$TEL_1 = $_POST['TEL_1'];
		$TEL_2 = $_POST['TEL_2'];
		$CELULAR = $_POST['CELULAR'];
		$EMAIL = $_POST['EMAIL'];

		if ($UNIDAD_NEGOCIO != "RRHH") {
			$PRODUCTO = $_POST['PRODUCTO'];
		} else {
			$PRODUCTO = $_POST['TEMA'];
		}
		$HABEAS_DATA = $_POST['HABEAS_DATA'];
		$DESCRIPCION = $_POST['DESCRIPCION'];
		$ESCALADO_A = $_POST['ESCALADO_A'];
		$FECHA_ULTIMO_SEGUIMIENTO = $_POST['FECHA_ULTIMO_SEGUIMIENTO'];
		$SOLUCION = $_POST['SOLUCION'];
		$STATUS = $_POST['STATUS'];
		$ORIGEN = $_POST['ORIGEN'];
		$OWNER = $_POST['OWNER'];
		$CALIFICACION_NSU = $_POST['CALIFICACION_NSU'];
		$EA = $_POST['EA'];


		mysqli_query($conex, "SET NAMES utf8");
		$insertar = mysqli_query($conex, "INSERT INTO bayer_registros (ID, FECHA_RECIBIDO, MEDIO_INGRESO, FECHA_LLAMADA, FECHA_CIERRE, NOMBRE, TIPO, EMPRESA, CARGO, CIUDAD, DEPARTAMENTO, PAIS, TEL_1, TEL_2, CELULAR, EMAIL, UNIDAD_NEGOCIO, PRODUCTO, TIPIFICACION, HABEAS_DATA, DESCRIPCION, ESCALADO_A, FECHA_ULTIMO_SEGUIMIENTO, SOLUCION, STATUS, ORIGEN, OWNER, CALIFICACION_NSU, EA, GESTION_A_REALIZAR) VALUES (NULL, '" . $FECHA_RECIBIDO . "', '" . $MEDIO_INGRESO . "', CURRENT_TIMESTAMP, '" . $FECHA_CIERRE . "', '" . $NOMBRE . "', '" . $TIPO . "', '" . $EMPRESA . "', '" . $CARGO . "', '" . $CIUDAD . "', '" . $DEPARTAMENTO . "', '" . $PAIS . "', '" . $TEL_1 . "', '" . $TEL_2 . "', '" . $CELULAR . "', '" . $EMAIL . "', '" . $UNIDAD_NEGOCIO . "', '" . $PRODUCTO . "', '" . $TIPIFICACION . "', '" . $HABEAS_DATA . "', '" . $DESCRIPCION . "', '" . $ESCALADO_A . "', '" . $FECHA_ULTIMO_SEGUIMIENTO . "', '" . $SOLUCION . "', '" . $STATUS . "', '" . $ORIGEN . "', '" . $OWNER . "', '" . $CALIFICACION_NSU . "', '" . $EA . "', '" . $GES_REALIZAR . "')");
		echo mysqli_error($conex);

		$cons_registro = mysqli_query($conex, "SELECT ID FROM bayer_registros ORDER BY ID DESC LIMIT 1");

		while ($fila2 = mysqli_fetch_array($cons_registro)) {
			$ID_GESTION = $fila2['ID'];
		}
		mysqli_query($conex, "SET NAMES utf8");
		$insertar_gestion = mysqli_query($conex, "INSERT INTO bayer_gestion (ID, ID_GESTION, TIPIFICACION, DESCRIPCION, FECHA_ULTIMO_SEGUIMIENTO, SOLUCION, GESTION_A_REALIZAR, ORIGEN, ASESOR) VALUES (NULL, '" . $ID_GESTION . "', '" . $TIPIFICACION . "', '" . $DESCRIPCION . "', CURRENT_TIMESTAMP, '" . $SOLUCION . "', '" . $GES_REALIZAR . "', '" . $ORIGEN . "', '" . $OWNER . "')");
		echo mysqli_error($conex);


		if ($insertar) {
	?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/chulo.png" width="118" height="117" style="width:100px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="aviso3" style=" width:68.9%; margin:auto auto;">HA REGISTRADO LA NOVEDAD CORRECTAMENTE.</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/novedades_registro.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BTN_CONTINUAR2.png" style="width:152px; height:37px" /></a>
			</center>
		<?php
		} else {
		?>
			<span style="margin-top:5%;">
				<center>
					<img src="../presentacion/imagenes/advertencia.png" style="width:50px; margin-top:100px;margin-top:5%;" />
				</center>
			</span>
			<p class="error" style=" width:68.9%; margin:auto auto;">

				<span style="border-left-color:red">ERROR EN EL REGISTRO DE NOVEDAD.</span>
			</p>
			<br />
			<br />
			<center>
				<a href="../presentacion/novedades_registro.php" target="info" class="btn_continuar"><img src="../presentacion/imagenes/BOTON_REGISTRAR_NARANJA.png" style="width:152px; height:37px" /></a>
			</center>
	<?php
		}
	}
	?>
</body>

</html>