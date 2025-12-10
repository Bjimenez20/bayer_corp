<?php
include('../datos/conex.php');


$TEMA = $_POST['TEMA'];
mysqli_query($conex, "SET NAMES utf8");
$select = mysqli_query($conex, "SELECT categoria FROM bayer_listas WHERE tema = '$TEMA' ORDER BY categoria ASC
");
echo mysqli_error($conex);
echo "<option value=\"" . $vacio . "\">SELECCIONE...</option>";
while ($fila = (mysqli_fetch_array($select))) {
	echo "<option value=\"" . $fila['categoria'] . "\">" . utf8_encode($fila['categoria']) . "</option>";
}
