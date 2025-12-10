<?php
include('../datos/conex.php');


$PAIS = $_POST['PAIS'];
$dep = $_POST['dep'];
$vacio = "";
mysqli_query($conex, "SET NAMES utf8");
$select = mysqli_query($conex, "SELECT NOMBRE_CIUDAD FROM bayer_ciudad AS c
INNER JOIN bayer_departamento AS d ON d.id=c.ID_DEPARTAMENTO_FK
INNER JOIN bayer_pais AS p ON p.ID_PAIS=d.ID_PAIS_FK
WHERE p.NOMBRE_PAIS='$PAIS' AND d.NOMBRE_DEPARTAMENTO='$dep' ORDER BY c.NOMBRE_CIUDAD ASC");
echo mysqli_error($conex);
echo "<option value=\"" . $vacio . "\">SELECCIONE...</option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['NOMBRE_CIUDAD'] . "\">" . utf8_encode($fila['NOMBRE_CIUDAD']) . "</option>";
}
