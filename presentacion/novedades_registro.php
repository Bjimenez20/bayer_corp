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

    .btn_registrar {
      padding-top: 2%;
      background-image: url(imagenes/BOTONES_REGISTRAR.png);
      background-repeat: no-repeat;
      width: 152px;
      height: 37px;
      color: transparent;
      background-color: transparent;
      border-radius: 5px;
      border: 1px solid transparent;
    }

    .izq {
      text-align: left;
    }

    .der {
      text-align: right;
    }

    th {
      padding: 7px;
      color: #FFF;
      background: #A0C054;
      font-family: avenir;
      font-size: 100%;
      font-style: normal;
      line-height: normal;
      font-weight: normal;
      font-variant: normal;
      text-align: center;
      font-family: Tahoma, Geneva, sans-serif;
    }

    td {
      padding: 2px;
      color: #000;
      font-family: avenir;
      font-size: 100%;
      font-style: normal;
      line-height: normal;
      font-weight: normal;
      font-variant: normal;
      text-align: left;
      font-family: Tahoma, Geneva, sans-serif;
    }
  </style>
  <script>
    /*mostrar departamento*/
    function mostrar_departamento() {
      var PAIS = $('#PAIS').val();
      $("#DEPARTAMENTO").html('<img src="../presentacion/imgagenes/cargando.gif" />');
      $.ajax({
        url: '../presentacion/departamento.php',
        data: {
          PAIS: PAIS,
        },
        type: 'post',
        beforeSend: function() {
          $("#DEPARTAMENTO").html("Procesando, espere por favor" + '<img src="../presentacion/imgagenes/cargando.gif" />');
        },
        success: function(data) {
          $('#DEPARTAMENTO').html(data);
        }
      })
    }
    /*mostrar ciudades*/
    function mostrar_ciudades() {
      var PAIS = $('#PAIS').val();
      var departamento = $('#DEPARTAMENTO').val();
      $.ajax({
        url: '../presentacion/ciudades.php',
        data: {
          dep: departamento,
          PAIS: PAIS
        },
        type: 'post',
        success: function(data) {
          $('#CIUDAD').html(data);
        }
      })
    }
    /*mostrar categoria*/
    function mostrar_categoria() {
      //var PAIS=$('#PAIS').val();
      var TEM = $('#TEMA').val();
      $.ajax({
        url: '../presentacion/categoria.php',
        data: {
          TEMA: TEM
          //PAIS: PAIS
        },
        type: 'post',
        success: function(data) {
          $('#CATEGORIA').html(data);
        }
      })
    }
    $(document).ready(function() {
      $('#ver1').click(function() {
        $("#con").fadeIn();
      });
      $('#close').click(function() {
        $("#con").fadeOut();
      });
      $('#DEPARTAMENTO').change(function() {
        mostrar_ciudades()
      });
      $('#TEMA').change(function() {
        mostrar_categoria()
      });
      $("#UNIDAD_NEGOCIO").change(function() {
        var unidad = $('#UNIDAD_NEGOCIO').val();
        if (unidad == "RRHH") {
          $("#span_producto").css('display', 'none');
          $("#span_tipifi").css('display', 'none');
          $("#span_tema").css('display', 'block');
          $("#campo_producto").css('display', 'none');
          $("#campo_tema").css('display', 'block');
          $("#campo_tipifi").css('display', 'block');
        } else {
          $("#span_producto").css('display', 'block');
          $("#span_tipifi").css('display', 'block');
          $("#span_tema").css('display', 'none');
          $("#campo_producto").css('display', 'block');
          $("#campo_tema").css('display', 'none');
          $("#campo_tipifi").css('display', 'none');
        }
      });
      $('#TIPIFICACION').change(function() {
        var TIPIFICACION = $('#TIPIFICACION').val();
        if (TIPIFICACION == 'LLAMADA OCIOSA' || TIPIFICACION == 'CONMUTADOR Y/O AREAS INTERNAS') {
          $('#MEDIO_INGRESO').removeAttr('required');
          $('#NOMBRE').removeAttr('required');
          $('#TIPO').removeAttr('required');
          $('#PAIS').removeAttr('required');
          $('#TEL_1').removeAttr('required');
          $('#UNIDAD_NEGOCIO').removeAttr('required');
          $('#HABEAS_DATA').removeAttr('required');
          $('#STATUS').removeAttr('required');
          $('#ORIGEN').removeAttr('required');
          $('#EA').removeAttr('required');
        }
        if (TIPIFICACION != 'LLAMADA OCIOSA' && TIPIFICACION != '' && TIPIFICACION != 'CONMUTADOR Y/O AREAS INTERNAS') {
          $('#MEDIO_INGRESO').attr("required", true);
          $('#NOMBRE').attr("required", true);
          $('#TIPO').attr("required", true);
          $('#PAIS').attr("required", true);
          $('#TEL_1').attr("required", true);
          $('#UNIDAD_NEGOCIO').attr("required", true);
          $('#HABEAS_DATA').attr("required", true);
          $('#STATUS').attr("required", true);
          $('#ORIGEN').attr("required", true);
          $('#EA').attr("required", true);
        }
      });
      $('#PAIS').change(function() {
        var PAIS = $('#PAIS').val();
        if (PAIS != 'OTRO' && PAIS != '') {
          mostrar_departamento()
          $("#DEPARTAMENTO").attr("required", true);
          $("#CIUDAD").attr("required", true);
          $('#CIUDAD').html('');
          $("OTRO_PAIS").css('display', 'none');
        }
        if (PAIS == 'OTRO') {
          $("#OTRO_PAIS").css('display', 'block');
          $('#CIUDAD').html('');
          $('#DEPARTAMENTO').html('');
          $("#DEPARTAMENTO").removeAttr('required');
          $("#CIUDAD").removeAttr("required");
        }
      });
      $("#salir").click(function() {
        if (confirm('�Estas seguro de cerrar sesion?')) {
          window.location = "../index.php";
        } else {}
      });
    });
  </script>
  <?php
	require('../datos/parse_str.php');
  require_once("../datos/conex.php");
  //$usua = $_SESSION["usuarios"];
  $usua = strtoupper($usua);
  $Selecciones = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE USER = '$usua'");
  while ($fila2 = mysqli_fetch_array($Selecciones)) {
    $NOMBRES = $fila2['NOMBRES'];
    $APELLIDOS = $fila2['APELLIDOS'];
    $NOMBRE_COMP = $NOMBRES . " " . $APELLIDOS;
    //echo "<option>".$DEPARTAMENTO."</option>";
  }
  ?>
</head>
<?PHP
if ($NOMBRE_COMP != '') {
  $Seleccion_tema = mysqli_query($conex, "SELECT tema FROM bayer_listas GROUP BY tema ORDER BY tema ASC");
  echo mysqli_error($conex);
?>

  <body>
    <section>
      <blockquote>
        <form name="miformulario" method="post" action="../logica/insertar_novedad.php">
          <table width="95%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
            <tr>
              <th colspan="6">
                <strong>REGISTRO</strong>
              </th>
            </tr>
            <tr>
              <td width="20%"><strong>GESTION A REALIZAR</strong></td>
              <td width="21%" height="44" align="left">
                <input name="ges_realizar" type="radio" value="Inbound" checked="checked" />
                <label for="radio"><strong>Inbound</strong></label>
              </td>
              <td colspan="2">
                <input name="ges_realizar" type="radio" value="Outbound" />
                <label for="radio"><strong>Outbound</strong></label>
              </td>
              <td colspan="2">
                <input name="ges_realizar" type="radio" value="Mail" />
                <label for="radio"><strong>Mail</strong></label>
              </td>
            </tr>
            <tr>
              <td><strong>MEDIO INGRESO</strong></td>
              <td height="44" align="left"><strong>
                  <select type="text" name="MEDIO_INGRESO" id="MEDIO_INGRESO" required="required" style="width:200px; height:25px">
                    <option value="">Seleccione...</option>
                    <option>CONTACTO BAYERANDINA</option>
                    <option>LINEA DE SERVICIO AL CLIENTE</option>
                    <option>E-MAIL</option>
                    <option>BUZON DE VOZ</option>
                    <option>FORMULARIO BAYER ANDINA</option>
                    <option>LLAMADA OUTBOUND</option>
                    <option>FORMULARIO CROPSCIENCE</option>
                    <option>FORMULARIO ASPIRINA 100</option>
                  </select>
                </strong></td>
              <td width="7%"><strong>FECHA RECIBIDO </strong></td>
              <td width="19%"><strong>
                  <input name="FECHA_RECIBIDO" type="date" id="FECHA_RECIBIDO" class="tipo1" style="height:20px" required="required" />
                </strong></td>
              <td width="7%"><strong>FECHA CIERRE</strong></td>
              <td width="26%"><strong>
                  <input name="FECHA_CIERRE" type="date" id="FECHA_CIERRE" class="tipo1" style="height:20px" />
                </strong></td>
            </tr>
            <tr>
              <td><strong>NOMBRE</strong></td>
              <td height="44" align="left"><strong>
                  <input name="NOMBRE" type="text" id="NOMBRE" class="tipo1" style="height:20px" required="required" />
                </strong></td>
              <td colspan="2"><strong>TIPO</strong></td>
              <td colspan="2"><strong>
                  <select type="text" name="TIPO" id="TIPO" required="required" style="width:200px; height:25px">
                    <option value="">Seleccione...</option>
                    <option>CONSUMIDOR O USUARIO FINAL</option>
                    <option>LABORATORIO CLINICO</option>
                    <option>COLEGIO</option>
                    <option>CONSULTORIO VETERINARIO</option>
                    <option>DISTRIBUIDOR</option>
                    <option>DUENO DE CULTIVO</option>
                    <option>EMPRESA</option>
                    <option>COLABORADOR BAYER</option>
                    <option>GANADERO</option>
                    <option>MEDICO</option>
                    <option>PROVEEDOR</option>
                    <option>MEDIO DE COMUNICACION (PERIODISTAS)</option>
                    <option>ESTUDIANTE</option>
                    <option>OTRO</option>
                  </select>
                </strong></td>
            </tr>
            <tr>
              <td><strong>EMPRESA</strong></td>
              <td height="44" class="titulosth"><strong>
                  <input name="EMPRESA" type="text" id="EMPRESA" class="tipo1" style="height:20px" />
                </strong></td>
              <td colspan="2"><strong>CARGO </strong></td>
              <td colspan="2"><strong>
                  <input name="CARGO" type="text" id="CARGO" class="tipo1" style="height:20px" />
                </strong></td>
            </tr>
            <tr>
              <td><strong>PAIS</strong></td>
              <td height="44" class="titulosth"><strong>
                  <select type="text" name="PAIS" id="PAIS" required="required" style="width:90%; height:25px">
                    <option value="">Seleccione...</option>
                    <option>COLOMBIA</option>
                    <option>ECUADOR</option>
                    <option>MEXICO</option>
                    <option>PERU</option>
                    <option>VENEZUELA</option>
                    <option>OTRO</option>
                  </select>
                  <br />
                  <div id="OTRO_PAIS" style="display:none">
                    <span>CUAL: </span><input type="text" name="otro_pais_text" id="otro_pais_text" style="width:70%; height:25px" />
                  </div>
                </strong></td>
              <td colspan="2"><strong>DEPARTAMENTO</strong></td>
              <td colspan="2"><strong>
                  <select type="text" name="DEPARTAMENTO" id="DEPARTAMENTO" style="width:90%; height:25px;">
                  </select>
                </strong></td>
            </tr>
            <tr>
              <td><strong>CIUDAD</strong></td>
              <td height="44" align="left"><span class="titulosth"><strong>
                    <select type="text" name="CIUDAD" id="CIUDAD" style="width:90%; height:25px;">
                    </select>
                  </strong></span></td>
              <td colspan="2"><strong>TEL 1</strong></td>
              <td colspan="2"><strong>
                  <input name="TEL_1" type="text" id="TEL_1" class="tipo1" style="height:20px" required="required" />
                </strong></td>
            </tr>
            <tr>
              <td><strong>TEL 2</strong></td>
              <td height="44" align="left"><strong>
                  <input name="TEL_2" type="text" id="TEL_2" class="tipo1" style="height:20px" />
                </strong></td>
              <td colspan="2"><strong>CELULAR</strong></td>
              <td colspan="2"><strong>
                  <input name="CELULAR" type="text" id="CELULAR" class="tipo1" style="height:20px" />
                </strong></td>
            </tr>
            <tr>
              <td><strong>EMAIL</strong></td>
              <td height="44" class="titulosth"><strong>
                  <input name="EMAIL" type="email" id="EMAIL" class="tipo1" style="height:20px" />
                </strong></td>
              <td colspan="2"><strong>UNIDAD NEGOCIO </strong></td>
              <td colspan="2"><strong>
                  <select type="text" name="UNIDAD_NEGOCIO" id="UNIDAD_NEGOCIO" required="required" style="width:200px; height:25px">
                    <option value="">Seleccione...</option>
                    <option>ANIMAL HEALTH</option>
                    <option>BHC CC</option>
                    <option>BHC PHARMA</option>
                    <option>BAYER AGENCY BUSINESS</option>
                    <option>BAYER REPRESENTACIONES</option>
                    <option>BMS</option>
                    <option>COVESTRO</option>
                    <option>CROP SCIENCE</option>
                    <option>ENVIRONMENTAL SCIENCE</option>
                    <option>NO PERTINENTE</option>
                    <option>RRHH</option>
                  </select>
                </strong></td>
            </tr>
            <tr>
              <td>
                <div id="span_producto"><strong>PRODUCTO</strong></div>
                <div style="display:none;" id="span_tema"><strong>TEMA</strong></div>
              </td>
              <td height="44" class="titulosth">
                <div id="campo_producto">
                  <strong><input name="PRODUCTO" type="text" id="PRODUCTO" class="tipo1" style="height:20px" /></strong>
                </div>
                <div style="display:none;" id="campo_tema">
                  <strong>
                    <select name="TEMA" id="TEMA" style="width:200px; height:25px">
                      <option value="">Seleccione...</option>
                      <?php
                      while ($fila = mysqli_fetch_array($Seleccion_tema)) {
                        echo "<option>" . $fila['tema'] . "</option>";
                      }
                      ?>
                    </select>
                  </strong>
                </div>
              </td>
              <td colspan="2"><strong>TIPIFICACION</strong></td>
              <td colspan="2">
                <div id="span_tipifi">
                  <strong>
                    <select type="text" name="TIPIFICACION" id="TIPIFICACION" style="width:200px; height:25px">
                      <option value="">Seleccione...</option>
                      <option>AGRADECIMIENTO O FELICITACION</option>
                      <option>ASESORIA EN CULTIVO</option>
                      <option>ASESORIA EN PRODUCTO</option>
                      <option>CONFIRMACION ASISTENCIA EVENTO</option>
                      <option>CONMUTADOR Y/O AREAS INTERNAS</option>
                      <option>DEVOLUCION DE LLAMADA</option>
                      <option>EVENTOS ADVERSOS - FARMACOVIGILANCIA</option>
                      <option>INFO DE PTOS DE VTA Y OFERTAS</option>
                      <option>OFRECIMIENTO DE SERVICIOS</option>
                      <option>OTRAS CONSULTAS</option>
                      <option>PSP</option>
                      <option>POSIBLE FALSIFICACION O CONTRABANDO DE PRODUCTO</option>
                      <option>LLAMADA OCIOSA</option>
                      <option>LLAMADA EQUIVOCADA</option>
                      <option>TESTEO DE LLAMADA</option>
                      <option>RECLAMO O QUEJA</option>
                      <option>SOLICITUD DE INFORMACION BYCI</option>
                      <option>SOLICITUD DE DONACION</option>
                      <option>VISITA MEDICA</option>
                      <option>CERTIFICADOS TRIBUTARIOS</option>
                      <option>ASUNTOS LEGALES</option>
                      <option>BOLETINES INFORMATIVOS</option>
                    </select>
                  </strong>
                </div>
                <div style="display:none;" id="campo_tipifi">
                  <strong>
                    <select type="text" name="CATEGORIA" id="CATEGORIA" style="width:90%; height:25px;">
                    </select>
                  </strong>
                </div>
              </td>
            </tr>
            <tr>
              <td><strong>HABEAS DATA</strong></td>
              <td height="44" class="titulosth"><strong>
                  <select type="text" name="HABEAS_DATA" id="HABEAS_DATA" required="required" style="width:200px; height:25px">
                    <option value="">Seleccione...</option>
                    <option>SI</option>
                    <option>NO</option>
                  </select>
                </strong></td>
              <td colspan="2"><strong>DESCRIPCION</strong></td>
              <td colspan="2"><strong>
                  <textarea name="DESCRIPCION" cols="30" class="tipo1" id="DESCRIPCION" style="width:auto"></textarea>
                </strong></td>
            </tr>
            <tr>
              <td><strong>ESCALADO A</strong></td>
              <td height="44" align="left"><strong>
                  <input name="ESCALADO_A" type="text" id="ESCALADO_A" class="tipo1" style="height:20px" />
                </strong></td>
              <td colspan="2"><strong>FECHA ULTIMO SEGUIMIENTO</strong></td>
              <td colspan="2"><strong>
                  <input name="FECHA_ULTIMO_SEGUIMIENTO" type="date" id="FECHA_ULTIMO_SEGUIMIENTO" class="tipo1" style="height:20px" />
                </strong></td>
            </tr>
            <tr>
              <td><strong>SOLUCION</strong></td>
              <td height="44" align="left"><strong>
                  <textarea name="SOLUCION" cols="30" class="tipo1" id="SOLUCION" style="width:auto"></textarea>
                </strong></td>
              <td colspan="2"><strong>STATUS</strong></td>
              <td colspan="2"><strong>
                  <select type="text" name="STATUS" id="STATUS" required="required" style="width:200px; height:25px">
                    <option>Seleccione...</option>
                    <option>ABIERTO</option>
                    <option>CERRADO</option>
                    <option>EN PROCESO</option>
                  </select>
                </strong></td>
            </tr>
            <tr>
              <td><strong>ORIGEN</strong></td>
              <td height="44" class="titulosth"><strong>
                  <select type="text" name="ORIGEN" id="ORIGEN" required="required" style="width:200px; height:25px">
                    <option value="">Seleccione...</option>
                    <option>COL_SAC_ComCo</option>
                    <option>PAGINA WEB</option>
                  </select>
                </strong></td>
              <td colspan="2"><strong>OWNER</strong></td>
              <td colspan="2"><strong>
                  <input name="OWNER" type="text" class="tipo1" id="OWNER" style="height:20px" value="<?php echo $NOMBRE_COMP; ?>" readonly="readonly" required="required" />
                  <!--   <select type="text" name="OWNER" id="OWNER" required="required" style="width:200px; height:25px">
                <option><?php echo $usua; ?></option>
              </select> -->
                </strong></td>
            </tr>
            <tr>
              <td><strong>CALIFICACION NSU</strong></td>
              <td height="44" class="titulosth"><strong>
                  <select type="text" name="CALIFICACION_NSU" id="CALIFICACION_NSU" style="width:200px; height:25px">
                    <option value="">Seleccione...</option>
                    <option>EXCELENTE</option>
                    <option>BUENO</option>
                    <option>REGULAR</option>
                    <option>MALO</option>
                  </select>
                </strong></td>
              <td colspan="2"><strong>EA</strong></td>
              <td colspan="2">
                <select type="text" name="EA" id="EA" required="required" style="width:200px; height:25px">
                  <option value="">Seleccione...</option>
                  <option>NO</option>
                  <option>SI</option>
                </select>
              </td>
            </tr>
            <tr>
              <th colspan="6">
                <input id="registrar" name="registrar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(paciente_nuevo,1)" />
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
<?PHP
} else {
?>
  <script type="text/javascript">
    window.onload = window.top.location.href = "../logica/cerrar_sesion2.php";
  </script>
<?php
}
?>

</html>