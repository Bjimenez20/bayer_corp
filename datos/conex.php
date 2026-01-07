<?PHP
$string_intro = getenv("QUERY_STRING");
require('parse_str.php');

$servidor = "host.docker.internal";
$usuario = "root";
$password = "root";
$basepaciente = "apppeopl_bayer_corporativo";


$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");
