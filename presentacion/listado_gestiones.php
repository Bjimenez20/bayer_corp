<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin titulo</title>
    <link rel="stylesheet" type="text/css" href="../presentacion/css/estilo_tablas.css" />
    <link rel="stylesheet" type="text/css" href="css/estilo_tablas.css" />
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
    </style>
</head>

<?php
require('../datos/parse_str.php');
require('../datos/conex.php');
$sta;
$pa;
$prod;
$nom;
$tel;

$hoy = date('Y-m-d');
if (isset($_POST['buscar'])) {
    $ID = $_POST['ID'];
    $STATUS = $_POST['STATUS'];
    $NOMBRE = $_POST['NOMBRE'];
    $PAIS = $_POST['PAIS'];
    $PRODUCTO = $_POST['PRODUCTO'];
    $TELEFONO = $_POST['TELEFONO'];
} else {
    $ID = "";
    $STATUS = "Seleccione...";
    if ($sta != '') {
        $STATUS = $sta;
    }
    $NOMBRE = "";
    if($nom != ''){
        $NOMBRE = $nom;
    }
    $PAIS = "";
    if ($pa != '') {
        $PAIS = $pa;
    }
    $PRODUCTO     = "";
    if ($prod != '') {
        $PRODUCTO = $prod;
    }
    $TELEFONO = "";
    if ($tel != ''){
        $TELEFONO = $tel;
    }
}
?>

<body>
    <?php
    //$ID_PACIENTE=base64_decode($xxx);
    if (!isset($_POST['buscar'])) {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_gestion ORDER BY ID ASC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_gestion ORDER BY ID DESC LIMIT";
    }

    if ($ID == "" and $STATUS == "Seleccione...") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros ORDER BY ID ASC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros ORDER BY ID DESC LIMIT";
    }

    if ($ID != "") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE ID = '" . $ID . "'");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE ID = '" . $ID . "' LIMIT";
    }

    if ($NOMBRE != "") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE NOMBRE = '" . $NOMBRE . "'");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE NOMBRE = '" . $NOMBRE . "' LIMIT";
    }

    if ($STATUS != "Seleccione...") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE STATUS = '" . $STATUS . "' ORDER BY ID DESC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE STATUS = '" . $STATUS . "' ORDER BY ID DESC LIMIT";
    }

    if ($ID != "" and $STATUS != "Seleccione...") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE ID = '" . $ID . "' AND STATUS = '" . $STATUS . "' ORDER BY ID DESC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE ID = '" . $ID . "' AND STATUS = '" . $STATUS . "' ORDER BY ID DESC LIMIT";
    }

    if ($PAIS != "") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE PAIS = '$PAIS' ORDER BY ID DESC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE PAIS = '$PAIS' ORDER BY ID DESC LIMIT";
    }

    if ($PRODUCTO != "") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE PRODUCTO = '$PRODUCTO' ORDER BY ID DESC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE PRODUCTO = '$PRODUCTO' ORDER BY ID DESC LIMIT";
    }

    if ($TELEFONO != "") {
        $SELECT_SOLICITUDES_TOTAL = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE TEL_1 = '$TELEFONO' OR TEL_2 = '$TELEFONO' OR CELULAR = '$TELEFONO' ORDER BY ID DESC");
        echo mysqli_error($conex);
        $SELECT_SOLICITUDES = "SELECT * FROM bayer_registros WHERE TEL_1 = '$TELEFONO' OR TEL_2 = '$TELEFONO' OR CELULAR = '$TELEFONO' ORDER BY ID DESC LIMIT";
    }

    $url = "../presentacion/listado_gestiones.php";
    $num_total = mysqli_num_rows($SELECT_SOLICITUDES_TOTAL);
    if ($num_total > 0) {
    ?>
        <table border="0" bordercolor="#A1A1A1" width="100%" rules="cols">
            <tr>
                <th class="botones">ID</th>
                <th class="botones">MEDIO DE INGRESO</th>
                <th class="botones">FECHA INICIO</th>
                <th class="botones">NOMBRE</th>
                <th class="botones">TIPO</th>
                <th class="botones">PAIS</th>
                <th class="botones">CIUDAD</th>
                <th class="botones">TELEFONO</th>
                <th class="botones">PRODUCTO</th>
                <th class="botones">STATUS</th>
                <th class="botones">OWNER</th>
                <th class="botones">EDIt</th>
            </tr>
            <?PHP
            //Limito la busqueda
            $TAMANO_PAGINA = 30;
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
                    <input type="hidden" name="ID_NOVEDAD" value="<?php echo $fila1["ID"] ?>" />
                    <?php $ID_PACIENTE = $fila1['ID']; ?>
                    <td><?php echo $fila1['ID'] ?></td>
                    <td><?php echo $fila1['MEDIO_INGRESO'] ?></td>
                    <td><?php echo $fila1['FECHA_RECIBIDO'] ?></td>
                    <td><?php echo $fila1['NOMBRE'] ?></td>
                    <td><?php echo $fila1['TIPO'] ?></td>
                    <td><?php echo $fila1['PAIS'] ?></td>
                    <td><?php echo $fila1['CIUDAD']; ?></td>
                    <td><?php echo $fila1['TEL_1'] ?></td>
                    <td><?php echo $fila1['PRODUCTO'] ?></td>
                    <td><?php echo $fila1['STATUS'] ?></td>
                    <td><?php echo $fila1['OWNER']; ?></td>
                    <td>
                        <a href="../presentacion/actualizar_registro.php?artid=<?php echo base64_encode($fila1['ID']); ?>" target="info"><img src="../presentacion/imagenes/lapiz 100.png" width="15" height="15" /></a>
                    </td>
                </tr>
            <?php

            }

            ?>
            <tr bgcolor="#FFFFFF" class="titulo" align="center">
                <td colspan="6" class="botones">Se encontraron Registros <?php echo $num_total; ?></td>
                <td colspan="6" class="botones">
                    <?php
                    if ($total_paginas > 1) {
                        if ($pagina != 1)
                            echo '<a href="' . $url . '?pagina=' . ($pagina - 1) . '&sta=' . $STATUS . '&prod=' . $PRODUCTO . '&pa=' . $PAIS . '&nom=' . $NOMBRE . '"><img src="../presentacion/imagenes/izq.gif" border="0"></a>';
                        for ($i = 1; $i <= $total_paginas; $i++) {
                            if ($pagina == $i)
                                //si muestro el indice de la pagina actual, no coloco enlace
                                echo "<label style='font-size:120%; color:#000;'> $pagina </label>";
                            else
                                //si el indice no corresponde con la pagina mostrada actualmente,co
                                //coloco el enlace para ir a esa pagina
                                echo '  <a href="' . $url . '?pagina=' . $i . '&sta=' . $STATUS . '&prod=' . $PRODUCTO . '&pa=' . $PAIS . '&nom=' . $NOMBRE . '" style="font-size:110%;">' . $i . '</a>  ';
                        }
                        if ($pagina != $total_paginas)
                            echo '<a href="' . $url . '?pagina=' . ($pagina + 1) . '&sta=' . $STATUS . '&prod=' . $PRODUCTO . '&pa=' . $PAIS . '&nom=' . $NOMBRE . '"><img src="../presentacion/imagenes/der.gif" border="0"></a>';
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

                <span style="border-left-color:red">NO SE ENCONTRARON REGISTROS CON ESTA INFORMACI&Oacute;N.</span>
            </p>
        <?php
    }
        ?>
        </table>
</body>

</html>