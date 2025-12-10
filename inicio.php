<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta charset="windows-1252">

<link rel="stylesheet" href="presentacion/css/estilos_menu.css" />
<title>Bayer</title>
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<style>
html
{
    background:url(presentacion/imagenes/FONDO.png) no-repeat fixed center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
form 
{
    background:url(presentacion/imagenes/LOGIN.png) top center no-repeat;
}
@media screen and (max-width:1000px )
{
	html
	{
		background:url(presentacion/imagenes/FONDO.png) no-repeat fixed center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
}
</style>
</head>
<body>
<div>
<img align="left" src="presentacion/imagenes/esquina.png" height="200px" width="250px" style="margin-left:10%; margin-top:1%;" />
  <br><br><br /><br /><br /><br /><br><br><br><br><br><br><br><br>
<form id="inicio" action="logica/ini_sesion.php" method="POST" style="width:100%; margin-top:100px;">

        <section style="width:20%; height:100%; padding:0;  text-align:center; margin:auto auto;">
            <br />
            <br />
            <br />   
            <br />         
            <span class="fuente">Usuario:</span><br />
            <input id="usuario" name="usuario" type="text" required="required" title="ESCRIBA UN NOMBRE DE USUARIO"/>
            <br />
            <br />
            <span class="fuente">Contrase&ntilde;a: </span><br />
            <input id="Contrasena" name="Contrasena" type="password" required="required" title="ESCRIBA UNA CONTRASEÑA CORRECTA"/>            
            <br />
            <br />
            <br />
            <center>
                <input id="Inicio" name="Inicio" type="submit" value="INICIAR SESION" class="btn_iniar"/>
            <br />
            <br />
            </center>
        </section>
    </form>
</body>
</html>