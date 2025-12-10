<?PHP
$string_intro = getenv("QUERY_STRING");
require('parse_str.php');

// $servidor = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
// $usuario = "apppeopl";
// $password = "ser1_pE0p1E*2018";
// $basepaciente = "apppeopl_bayer_corporativo";

$servidor = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
$usuario = "apppeopl_bayers";
$password = "65hUmP4@be8$";
$basepaciente = "apppeopl_bayer_corporativo";


$conex = mysqli_connect($servidor, $usuario, $password) or die("No se Puede conectar al Servidor");
mysqli_select_db($conex, $basepaciente) or die("No se Puede conectar a la base de Datos");


	/* AMAZON SSL
$user = "apppeopl";
$pass =  "ser1_pE0p1E*2018";
$ca_cert = "us-east-1-bundle.pem";
$rds_host = "app-peoplemarketing.ckkjycussdkq.us-east-1.rds.amazonaws.com";
$baseinvent="apppeopl_bayer_corporativo";
$conex = mysqli_init();
if (!$conex) {
    die('mysqli_init failed');
}
$conex->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
$conex->ssl_set(NULL, NULL, "/home/apppeopl/superlikers.panel.app-peoplemarketing.com/bayer.pe/datos/$ca_cert", NULL, NULL);
$conex->real_connect($rds_host, $user, $pass, $baseinvent);
*/
