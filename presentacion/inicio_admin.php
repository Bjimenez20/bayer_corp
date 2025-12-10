<?php
include('../logica/session.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin titulo</title>
    <link rel="stylesheet" href="css/menu.css" />
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <link type="text/css" rel="stylesheet" href="css/estilo_form_paciente.css" />
    <link rel="stylesheet" href="../presentacion/css/menu.css" />
</head>
<script src="js/jquery.js"></script>
<script src="../presentacion/js/jquery.js"></script>
<script>
    var height = window.innerHeight - 2;
    var porh = (height * 74 / 100);
    $(document).ready(function() {
        $('#info').css('height', porh);
    });
</script>
<style>
    html {
        background: url(../presentacion/imagenes/FONDO.png) no-repeat fixed center;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php
if ($privilegios != '' && $usua != '') {
?>

    <body>
        <div class="body">
            <div class="div_menu" style="margin-top:-20px;">
                <ul>
                    <li><a href="../presentacion/novedades_registro.php" target="info"><span class="icon-unlocked"></span> REGISTRO</a></li>
                    <li><a href="../presentacion/novedades_filtro.php" target="info"><span class="icon-unlocked"></span> CONSULTA</a></li>
                    <li><a href="../SCRIPTCASE/Bayer_corporativo_20230704133819000000" target="info"><span class="icon-unlocked"></span> REPORTE</a></li>
                    <li><a href="#"><span class="icon-unlocked"></span> CONFIGURACION</a>
                        <ul>
                            <li><a href="../presentacion/form_usuarios.php" target="info"><span class="icon-unlocked"></span> USUARIOS</a></li>
                            <li><a href="../presentacion/form_cuenta_usuario.php" target="info"><span class="icon-unlocked"></span> MI CUENTA</a></li>
                        </ul>
                    </li>
                    <li class="a1" id="salir"><a href="../logica/cerrar_sesion.php" style="border-right:2px solid transparent;"><span class="icon-exit"></span> SALIR</a></li>
                </ul>
            </div>
        </div>
        <div class="body">
            <iframe style=" padding-top:20px; width:100%;border:1px solid transparent" name="info" id="info" scrolling="auto"></iframe>
        </div>
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