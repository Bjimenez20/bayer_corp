<?php
include('../datos/conex.php');

$PAIS = $_POST['PAIS'];
$vacio = "";
mysqli_query($conex, "SET NAMES utf8");
$select = mysqli_query($conex, "SELECT NOMBRE_DEPARTAMENTO FROM bayer_departamento AS d
INNER JOIN bayer_pais AS p ON p.ID_PAIS=d.ID_PAIS_FK
WHERE p.NOMBRE_PAIS='$PAIS' ORDER BY NOMBRE_DEPARTAMENTO ASC");
echo mysqli_error($conex);
echo "<option value=\"" . $vacio . "\">SELECCIONE...</option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['NOMBRE_DEPARTAMENTO'] . "\">" . utf8_encode($fila['NOMBRE_DEPARTAMENTO']) . "</option>";
}
