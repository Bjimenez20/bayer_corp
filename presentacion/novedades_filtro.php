<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="img/logo.png" />
	<link rel="stylesheet" href="css/estilos_menu.css" />
	<title>BAYER</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="js/jquery.js"></script>
	<script src="../presentacion/js/jquery.js"></script>
	<script>
		var height = window.innerHeight - 2;
		var porh = (height * 80 / 100);
		$(document).ready(function() {
			$('#consulta_inv').css('height', porh);
		});
	</script>
	<style>
		@import url("../../bayer/webfonts/avenir/stylesheet.css");

		.izq {
			text-align: left;
		}

		.der {
			text-align: right;
		}

		th {
			padding: 2px;
			color: #FFF;
			font-family: avenir;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: center;
			font-family: Tahoma, Geneva, sans-serif;
		}

		.tabla2 {
			padding: 2px;
			color: #000;
			background: #035da3;
			font-family: avenir;
			font-size: 100%;
			font-style: normal;
			line-height: normal;
			font-weight: normal;
			font-variant: normal;
			text-align: left;
		}
	</style>
	<script>
		$(document).ready(function() {
			$('#ver1').click(function() {
				$("#con").fadeIn();
			});
			$('#close').click(function() {
				$("#con").fadeOut();
			});
			$("#salir").click(function() {
				if (confirm('�Estas seguro de cerrar sesion?')) {
					window.location = "../index.php";
				} else {}
			});
		});
	</script>
	<?php
	/*
if($privilegios != 2)
{
  header("location: ../index.php");	
  session_unset();
  session_destroy();
  exit();
}*/
	require('../datos/parse_str.php');
	require_once("../datos/conex.php");
	if ($privilegios != '' && $usua != '') {
		$usua = strtoupper($usua);
		if (isset($_POST['actualizar'])) {
			$GES_REALIZAR = $_POST['ges_realizar'];
			$MEDIO_INGRESO = $_POST['MEDIO_INGRESO'];
			$FECHA_CIERRE = $_POST['FECHA_CIERRE'];
			$FECHA_RECIBIDO = $_POST['FECHA_RECIBIDO'];
			$NOMBRE = $_POST['NOMBRE'];
			$TIPO = $_POST['TIPO'];
			$EMPRESA = $_POST['EMPRESA'];
			$CARGO = $_POST['CARGO'];
			$CIUDAD = $_POST['CIUDAD'];
			$DEPARTAMENTO = $_POST['DEPARTAMENTO'];
			$PAIS = $_POST['PAIS'];
			if ($PAIS != 'OTRO') {
				$CIUDAD = $_POST['CIUDAD'];
				$DEPARTAMENTO = $_POST['DEPARTAMENTO'];
			}
			if ($PAIS == 'OTRO') {
				$PAIS = strtoupper($_POST['otro_pais_text']);
				$CIUDAD = $_POST['CIUDAD'];
				$DEPARTAMENTO = $_POST['DEPARTAMENTO'];
			}
			$TEL_1 = $_POST['TEL_1'];
			$TEL_2 = $_POST['TEL_2'];
			$CELULAR = $_POST['CELULAR'];
			$EMAIL = $_POST['EMAIL'];
			$UNIDAD_NEGOCIO = $_POST['UNIDAD_NEGOCIO'];
			$PRODUCTO = $_POST['PRODUCTO'];
			$TIPIFICACION = $_POST['TIPIFICACION'];
			$HABEAS_DATA = $_POST['HABEAS_DATA'];
			$DESCRIPCION = $_POST['DESCRIPCION'];
			$ESCALADO_A = $_POST['ESCALADO_A'];
			$FECHA_ULTIMO_SEGUIMIENTO = $_POST['FECHA_ULTIMO_SEGUIMIENTO'];
			$SOLUCION = $_POST['SOLUCION'];
			$STATUS = $_POST['STATUS'];
			$ORIGEN = $_POST['ORIGEN'];
			$OWNER = $_POST['OWNER'];
			$CODIGO_ARGUS = $_POST['CODIGO_ARGUS'];
			$CALIFICACION_NSU = $_POST['CALIFICACION_NSU'];
			$UPDATE_NOVEDADES = mysqli_query($conex, "UPDATE bayer_registros SET  
	FECHA_RECIBIDO = '" . $FECHA_RECIBIDO . "',
	MEDIO_INGRESO = '" . $MEDIO_INGRESO . "', 
	FECHA_CIERRE = '" . $FECHA_CIERRE . "', 	
	NOMBRE = '" . $NOMBRE . "', 
	TIPO = '" . $TIPO . "', 
	EMPRESA = '" . $EMPRESA . "', 
	CARGO = '" . $CARGO . "', 
	CIUDAD = '" . $CIUDAD . "', 
	DEPARTAMENTO = '" . $DEPARTAMENTO . "', 
	PAIS = '" . $PAIS . "', 
	TEL_1 = '" . $TEL_1 . "', 
	TEL_2 = '" . $TEL_2 . "', 
	CELULAR = '" . $CELULAR . "', 
	EMAIL = '" . $EMAIL . "', 
	UNIDAD_NEGOCIO = '" . $UNIDAD_NEGOCIO . "', 
	PRODUCTO = '" . $PRODUCTO . "', 
	TIPIFICACION = '" . $TIPIFICACION . "', 
	HABEAS_DATA = '" . $HABEAS_DATA . "', 
	DESCRIPCION = '" . $DESCRIPCION . "', 
	ESCALADO_A = '" . $ESCALADO_A . "', 
	FECHA_ULTIMO_SEGUIMIENTO = '" . $FECHA_ULTIMO_SEGUIMIENTO . "', 
	SOLUCION = '" . $SOLUCION . "', 
	STATUS = '" . $STATUS . "', 
	ORIGEN = '" . $ORIGEN . "', 
	OWNER = '" . $OWNER . "', 
	CODIGO_ARGUS = '" . $CODIGO_ARGUS . "',
	CALIFICACION_NSU = '" . $CALIFICACION_NSU . "',
	GESTION_A_REALIZAR  = '" . $GES_REALIZAR . "'
	WHERE ID = '" . $ID_NOVEDAD . "'");
			echo mysqli_error($conex);
			$insertar_gestion = mysqli_query($conex, "INSERT INTO bayer_gestion (ID, ID_GESTION, TIPIFICACION, DESCRIPCION, FECHA_ULTIMO_SEGUIMIENTO, SOLUCION, GESTION_A_REALIZAR, ORIGEN, ASESOR) VALUES (NULL, '" . $ID_NOVEDAD . "', '" . $TIPIFICACION . "', '" . $DESCRIPCION . "', CURRENT_TIMESTAMP, '" . $SOLUCION . "', '" . $GES_REALIZAR . "', '" . $ORIGEN . "', '" . $OWNER . "')");
			echo mysqli_error($conex);
		}
	?>
</head>

<body>
	<section>
		<blockquote>
			<form name="miformulario" method="post" action="listado_gestiones.php" onkeydown="return filtro(2)" target="consulta_inv">
				<table width="95%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
					<tr align="center">
						<?php
						if ($privilegios == 1 || $privilegios == 2) {
						?>
							<th width="10%" align="left" class="titulosth" bgcolor="#2facbc">
								<div id="movimiento1">
									ID
									<input name="ID" type="text" id="ID" class="tipo1" style="height:20px">
								</div>
							</th>
							<th width="15%" align="left" class="titulosth" bgcolor="#2facbc">
								<div id="movimiento1">
									STATUS
									<select name="STATUS" id="STATUS" required="required" style="height:25px">
										<option selected="selected">Seleccione...</option>
										<option>ABIERTO</option>
										<option>CERRADO</option>
										<option>EN PROCESO</option>
									</select>
								</div>
							</th>
							<th width="15%" bgcolor="#2facbc">
								<div id="consulta">PAIS
									<input name="PAIS" type="text" id="PAIS" class="tipo1" style="height:20px" />
								</div>
							</th>
							<th width="20%" bgcolor="#2facbc">
								<div id="consulta">PRODUCTO
									<input name="PRODUCTO" type="text" id="PRODUCTO" class="tipo1" style="height:20px" />
								</div>
							</th>
						<?php
						}
						?>
						<th width="20%" bgcolor="#2facbc">
							<div id="consulta">NOMBRE
								<input name="NOMBRE" type="text" id="NOMBRE" class="tipo1" style="height:20px" />
							</div>
						</th>
						<th width="20%" bgcolor="#2facbc">
							<div id="consulta">TELEFONO
								<input name="TELEFONO" type="text" id="TELEFONO" class="tipo1" style="height:20px" />
							</div>
						</th>
						<th width="20%" bgcolor="#2facbc"><span>
								<input type="submit" name="buscar" id="buscar" value="Consultar" class="btn_buscar" title="BUSCAR" />
							</span>
						</th>
					</tr>
					<tr>
						<th colspan="6">
							<iframe src="listado_gestiones.php" name="consulta_inv" id="consulta_inv" class="ifra2"></iframe>
						</th>
					</tr>
				</table>
			</form>
		</blockquote>
	</section>
	<map name="Map7" id="Map7">
		<area shape="rect" coords="-3,-1,275,78" href="#" />
	</map>
</body>
<?php
	} else {
?>
	<script type="text/javascript">
		window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
	</script>
<?php
	}
?>

</html>