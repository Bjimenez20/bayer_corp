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
  <script language=javascript>
    function ventanaSecundaria(URL) {
      //alert('hola1')
      window.open(URL, "ventana1", "width=1300,height=500,Top=150,Left=50%")
    }
  </script>
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
      background-image: url(imagenes/BOTON_ACTUALIZAR.png);
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
    /*mostrar departamento*/
    function codigo_arguz(sel) {
      if (sel.value == "SI") {
        divC = document.getElementById("SI_CODIGO_ARGUS");
        divC.style.display = "";
      }
      if (sel.value != "SI") {
        divC = document.getElementById("SI_CODIGO_ARGUS");
        divC.style.display = "none";
      }
    }

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
    $ID_NOVEDAD = base64_decode($artid);
    $novedad = mysqli_query($conex, "SELECT * FROM bayer_registros WHERE ID = '" . $ID_NOVEDAD . "'");
    echo mysqli_error($conex);
    while ($fila1 = mysqli_fetch_array($novedad)) {
      $FECHA_RECIBIDO = $fila1['FECHA_RECIBIDO'];
      $MEDIO_INGRESO = $fila1['MEDIO_INGRESO'];
      $FECHA_CIERRE = $fila1['FECHA_CIERRE'];
      $NOMBRE = $fila1['NOMBRE'];
      $TIPO = $fila1['TIPO'];
      $EMPRESA = $fila1['EMPRESA'];
      $CARGO = $fila1['CARGO'];
      $CIUDAD = $fila1['CIUDAD'];
      $DEPARTAMENTO = $fila1['DEPARTAMENTO'];
      $PAIS = $fila1['PAIS'];
      $TEL_1 = $fila1['TEL_1'];
      $TEL_2 = $fila1['TEL_2'];
      $CELULAR = $fila1['CELULAR'];
      $EMAIL = $fila1['EMAIL'];
      $UNIDAD_NEGOCIO = $fila1['UNIDAD_NEGOCIO'];
      $PRODUCTO = $fila1['PRODUCTO'];
      $TIPIFICACION = $fila1['TIPIFICACION'];
      $HABEAS_DATA = $fila1['HABEAS_DATA'];
      $DESCRIPCION = $fila1['DESCRIPCION'];
      $ESCALADO_A = $fila1['ESCALADO_A'];
      $FECHA_ULTIMO_SEGUIMIENTO = $fila1['FECHA_ULTIMO_SEGUIMIENTO'];
      $SOLUCION = $fila1['SOLUCION'];
      $STATUS = $fila1['STATUS'];
      $ORIGEN = $fila1['ORIGEN'];
      $OWNER = $fila1['OWNER'];
      $CALIFICACION_NSU = $fila1['CALIFICACION_NSU'];
      $EA = $fila1['EA'];
      $CODIGO_ARGUS = $fila1['CODIGO_ARGUS'];
    }
  ?>
</head>

<body>
  <section>
    <blockquote>
      <form name="miformulario" method="post" action="../presentacion/novedades_filtro.php?ID_NOVEDAD=<?php echo $ID_NOVEDAD; ?>">
        <table width="95%" border="0" align="center" cellpadding="2" cellspacing="1" style="margin:auto auto;">
          <tr>
            <th colspan="6">
              <strong>ACTUALIZAR REGISTRO</strong>
            </th>
          </tr>
          <tr>
            <td width="20%"><strong>GESTION A REALIZAR</strong></td>
            <td width="25%" height="44" align="left">
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
            <td width="20%"><strong>MEDIO INGRESO</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <select type="text" name="MEDIO_INGRESO" id="MEDIO_INGRESO" required="required" style="width:200px; height:25px">
                  <option><?php echo $MEDIO_INGRESO; ?></option>
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
            <td width="10%"><strong>FECHA RECIBIDO </strong></td>
            <td width="17%">
              <input name="FECHA_RECIBIDO" type="date" id="FECHA_RECIBIDO" class="tipo1" style="height:20px" value="<?php echo $FECHA_RECIBIDO; ?>" required="required" />
            </td>
            <td width="10%"><strong>FECHA CIERRE</strong></td>
            <td width="18%">
              <input name="FECHA_CIERRE" type="date" id="FECHA_CIERRE" class="tipo1" style="height:20px" value="<?php echo $FECHA_CIERRE; ?>" />
            </td>
          </tr>
          <tr>
            <td><strong>NOMBRE</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <input name="NOMBRE" type="text" required="required" class="tipo1" id="NOMBRE" style="height:20px" value="<?php echo $NOMBRE; ?>" />
              </strong></td>
            <td colspan="2"><strong>TIPO</strong></td>
            <td colspan="2"><strong>
                <select type="text" name="TIPO" id="TIPO" required="required" style="width:200px; height:25px">
                  <option><?php echo $TIPO; ?></option>
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
                <input name="EMPRESA" type="text" class="tipo1" id="EMPRESA" style="height:20px" value="<?php echo $EMPRESA; ?>" />
              </strong></td>
            <td colspan="2"><strong>CARGO </strong></td>
            <td colspan="2"><strong>
                <input name="CARGO" type="text" class="tipo1" id="CARGO" style="height:20px" value="<?php echo $CARGO; ?>" />
              </strong></td>
          </tr>
          <tr>
            <td><strong>CIUDAD</strong></td>
            <td height="44" class="titulosth"><strong>
                <input name="CIUDAD" type="text" class="tipo1" id="CIUDAD" style="height:20px" value="<?php echo $CIUDAD; ?>" />
              </strong></td>
            <td colspan="2"><strong>DEPARTAMENTO</strong></td>
            <td colspan="2"><strong>
                <input name="DEPARTAMENTO" type="text" class="tipo1" id="DEPARTAMENTO" style="height:20px" value="<?php echo $DEPARTAMENTO; ?>" />
              </strong></td>
          </tr>
          <tr>
            <td width="20%"><strong>PAIS</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <select type="text" name="PAIS" id="PAIS" required="required" style="width:90%; height:25px">
                  <option><?php echo $PAIS; ?></option>
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
            <td colspan="2"><strong>TEL 1</strong></td>
            <td colspan="2"><strong>
                <input name="TEL_1" type="text" class="tipo1" required="required" id="TEL_1" style="height:20px" value="<?php echo $TEL_1; ?>" />
              </strong></td>
          </tr>
          <tr>
            <td><strong>TEL 2</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <input name="TEL_2" type="text" class="tipo1" id="TEL_2" style="height:20px" value="<?php echo $TEL_2; ?>" />
              </strong></td>
            <td colspan="2"><strong>CELULAR</strong></td>
            <td colspan="2"><strong>
                <input name="CELULAR" type="text" class="tipo1" id="CELULAR" style="height:20px" value="<?php echo $CELULAR; ?>" />
              </strong></td>
          </tr>
          <tr>
            <td><strong>EMAIL</strong></td>
            <td height="44" class="titulosth"><strong>
                <input name="EMAIL" type="email" class="tipo1" id="EMAIL" style="height:20px" value="<?php echo $EMAIL; ?>" />
              </strong></td>
            <td colspan="2"><strong>UNIDAD NEGOCIO </strong></td>
            <td colspan="2"><strong>
                <select type="text" name="UNIDAD_NEGOCIO" id="UNIDAD_NEGOCIO" required="required" style="width:200px; height:25px">
                  <option><?php echo $UNIDAD_NEGOCIO; ?></option>
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
            <td><strong>PRODUCTO</strong></td>
            <td height="44" class="titulosth"><strong>
                <input name="PRODUCTO" type="text" class="tipo1" id="PRODUCTO" style="height:20px" value="<?php echo $PRODUCTO; ?>" />
              </strong></td>
            <td colspan="2"><strong>TIPIFICACION</strong></td>
            <td colspan="2"><strong>
                <select type="text" name="TIPIFICACION" id="TIPIFICACION" required="required" style="width:200px; height:25px">
                  <option><?php echo $TIPIFICACION; ?></option>
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
                  <option>RECLAMO O QUEJA</option>
                  <option>TESTEO DE LLAMADA</option>
                  <option>SOLICITUD DE INFORMACION BYCI</option>
                  <option>SOLICITUD DE DONACION</option>
                  <option>VISITA MEDICA</option>
                  <option>ASUNTOS LEGALES</option>
                  <option>BOLETINES INFORMATIVOS</option>
                </select>
              </strong></td>
          </tr>
          <tr>
            <td><strong>HABEAS DATA</strong></td>
            <td height="44" class="titulosth"><strong>
                <select type="text" name="HABEAS_DATA" id="HABEAS_DATA" required="required" style="width:200px; height:25px">
                  <option><?php echo $HABEAS_DATA; ?></option>
                  <option>SI</option>
                  <option>NO</option>
                </select>
              </strong></td>
            <td colspan="2"><strong>DESCRIPCION</strong></td>
            <td colspan="2"><strong>
                <textarea name="DESCRIPCION" cols="30" class="tipo1" id="DESCRIPCION" style="width:auto"><?php echo $DESCRIPCION; ?></textarea>
              </strong></td>
          </tr>
          <tr>
            <td width="20%"><strong>ESCALADO A</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <input name="ESCALADO_A" type="text" class="tipo1" id="ESCALADO_A" style="height:20px" value="<?php echo $ESCALADO_A; ?>" />
              </strong></td>
            <td colspan="2"><strong>FECHA ULTIMO SEGUIMIENTO</strong></td>
            <td colspan="2"><strong>
                <input name="FECHA_ULTIMO_SEGUIMIENTO" type="date" class="tipo1" id="FECHA_ULTIMO_SEGUIMIENTO" style="height:20px" value="<?php echo $FECHA_ULTIMO_SEGUIMIENTO; ?>" />
              </strong></td>
          </tr>
          <tr>
            <td><strong>SOLUCION</strong></td>
            <td width="25%" height="44" align="left"><strong>
                <textarea name="SOLUCION" cols="30" class="tipo1" id="SOLUCION" style="width:auto"><?php echo $SOLUCION; ?></textarea>
              </strong></td>
            <td colspan="2"><strong>STATUS</strong></td>
            <td colspan="2"><strong>
                <select type="text" name="STATUS" id="STATUS" required="required" style="width:200px; height:25px">
                  <option><?php echo $STATUS; ?></option>
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
                  <option><?php echo $ORIGEN; ?></option>
                  <option>COL_SAC_ComCo</option>
                  <option>PAGINA WEB</option>
                </select>
              </strong></td>
            <td colspan="2"><strong>OWNER</strong></td>
            <td colspan="2"><strong>
                <select type="text" name="OWNER" id="OWNER" required="required" style="width:200px; height:25px">
                  <?php
                  $Selecciones = mysqli_query($conex, "SELECT * FROM bayer_usuario WHERE PRIVILEGIOS = '2'");
                  while ($fila2 = mysqli_fetch_array($Selecciones)) {
                    $NOMBRES = $fila2['NOMBRES'];
                    $APELLIDOS = $fila2['APELLIDOS'];
                    $NOMBRE_COMP = $NOMBRES . " " . $APELLIDOS;
                    echo "<option>" . $NOMBRE_COMP . "</option>";
                  }
                  ?>
                </select>
              </strong></td>
          </tr>
          <tr>
            <td><strong>CALIFICACION NSU</strong></td>
            <td height="44" class="titulosth"><strong>
                <select type="text" name="CALIFICACION_NSU" id="CALIFICACION_NSU" required="required" style="width:200px; height:25px">
                  <option><?php echo $CALIFICACION_NSU; ?></option>
                  <option>EXCELENTE</option>
                  <option>BUENO</option>
                  <option>REGULAR</option>
                  <option>MALO</option>
                </select>
              </strong></td>
            <td colspan="2"><strong>EA</strong></td>
            <td colspan="2">
              <input name="EA" type="text" class="tipo1" id="EA" style="height:20px" value="<?php echo $EA; ?>" readonly="readonly" />
            </td>
          </tr>
          <?php if ($EA == 'SI') { ?>
            <tr>
              <td><strong>CODIGO ARGUS</strong></td>
              <td height="44" class="titulosth"><strong>
                  <input name="CODIGO_ARGUS" type="text" class="tipo1" id="CODIGO_ARGUS" style="height:20px" value="<?php echo $CODIGO_ARGUS; ?>" />
                </strong></td>
            </tr>
          <?php } ?>
          <tr>
            <th colspan="6">
              <input type="button" name="historico" id="historico" title="Historico reclamacion" style="width:100%; background-color:#A0C054; color:#FFF; font-family: avenir; height:30px; font-size:16px;" value="HISTORICO GESTIONES" onclick="javascript:ventanaSecundaria('form_historico.php?xxx=<?php echo base64_encode($ID_NOVEDAD) ?>')" />
            </th>
          </tr>
          <tr>
            <th colspan="6">
              <input id="actualizar" name="actualizar" type="submit" value="REGISTRAR" class="btn_registrar" onClick="return validar(paciente_nuevo,1)" />
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