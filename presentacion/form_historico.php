<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>HISTORICO</title>
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
	<link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
	<link rel="shortcut icon" href="../presentacion/imagenes/logo.png" />
	<style>
		.error {
			font-size: 130%;
			font-weight: bold;
			color: #fb8305;
			text-transform: uppercase;
			background-color: transparent;
			text-align: center;
			padding: 10px;
		}

		html {
			background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}

		/*form 
{
    background:url(../presentacion/imagenes/LOGIN.png) top center no-repeat;
}*/
		@media screen and (max-width:1000px) {
			html {
				background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
		}
	</style>
</head>

<?php
	require('../datos/parse_str.php');
require('../datos/conex.php');
?>

<body>
	<div>
		<img src="../presentacion/imagenes/esquina.png" height="80px" style="margin-left:1%; margin-top:1%;" />
	</div>
	<form name="solicitud" id="solicitud" method="post" style="width:100%; margin-top:50px;">
		<?php
		$ID_PACIENTE = base64_decode($xxx);

		$SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_gestion WHERE ID_GESTION = '$ID_PACIENTE' ORDER BY FECHA_ULTIMO_SEGUIMIENTO DESC");
		echo mysqli_error($conex);
		$SELECT_SOLICITUDES = "SELECT * FROM bayer_gestion WHERE ID_GESTION = '$ID_PACIENTE' ORDER BY FECHA_ULTIMO_SEGUIMIENTO DESC LIMIT";

		//include('../logica/consultas_solicitudes.php');
		$url = "../presentacion/form_historico.php";
		$num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
		if ($num_total > 0) {
		?>
			<table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
				<tr>
					<!--<th class="botones">ID MOVIMIENTOS</th>-->
					<th class="botones">FECHA COMUNICACION</th>
					<th class="botones">ASESOR</th>
					<th class="botones">TIPIFICACION</th>
					<th class="botones">OBSERVACION</th>
					<th class="botones">SOLUCION</th>
					<th class="botones">MES</th>

				</tr>
				<?PHP
				//Limito la busqueda
				$TAMANO_PAGINA = 10;
				$pagina = false;
				//examino la pagina a mostrar y el inicio del registro a mostrar
				if (isset($_GET["pagina"]))
					$pagina = $_GET["pagina"];
				if (!$pagina) {
					$inicio = 0;
					$pagina = 1;
				} else {
					$inicio = ($pagina - 1) * $TAMANO_PAGINA;
				}
				//calculo el total de paginas
				$total_paginas = ceil($num_total / $TAMANO_PAGINA);

				$consulta = "$SELECT_SOLICITUDES " . $inicio . "," . $TAMANO_PAGINA;

				$consulta_sol = mysqli_query($conex, $consulta);
				$x = 0;
				while ($fila1 = mysqli_fetch_array($consulta_sol)) {
					$x = $x + 1;
				?>
					<tr align="center">
						<td><?php echo $fila1['FECHA_ULTIMO_SEGUIMIENTO']; ?></td>
						<td><?php echo $fila1['ASESOR']; ?></td>
						<td><?php echo $fila1['TIPIFICACION']; ?></td>
						<td><?php echo $fila1['DESCRIPCION']; ?></td>
						<td><?php echo $fila1['SOLUCION']; ?></td>

						<td><?php echo 'FEBRERO' ?></td>

					</tr>
				<?php

				}

				?>
				<tr bgcolor="#FFFFFF" class="titulo" align="center">
					<td colspan="5" class="botones">Se encontraron Registros <?php echo $num_total; ?></td>
					<td colspan="44" class="botones">
						<?php
						if ($total_paginas > 1) {
							if ($pagina != 1)
								echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '&xxx=' . base64_encode($ID_PACIENTE) . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
							for ($i = 1; $i <= $total_paginas; $i++) {
								if ($pagina == $i)
									//si muestro el indice de la pagina actual, no coloco enlace
									echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
								else
									//si el indice no corresponde con la pagina mostrada actualmente,co
									//coloco el enlace para ir a esa pagina
									echo '  <a href="' . $url . '?pagina=' . $i . '&xxx=' . base64_encode($ID_PACIENTE) . '" style="font-size:110%;">' . $i . '</a>  ';
							}
							if ($pagina != $total_paginas)
								echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '&xxx=' . base64_encode($ID_PACIENTE) . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
						}
						echo '</p>';
						?>
					</td>
				</tr>
			<?php
		} else {
			?>
				<span style="margin-top:1%;">
					<center>
						<img src="../presentacion/imagenes/advertencia.png" style="width:70px; margin-top:1%;" />
					</center>
				</span>
				<p class="error" style=" width:68.9%; margin:auto auto;">

					<span style="border-left-color:red">NO SE ENCUENTRAR REGISTROR CON ESTA INFORMACI&Oacute;N.</span>
				</p>
			<?php
		}
			?>
			</table>
	</form>
</body>

</html>