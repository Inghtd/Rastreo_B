<?php
/**/
$fecha = date("d-m-Y H:i:s");
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Convertido_$fecha.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
/**/
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);

$t=$_POST['tabla'];

echo $t;

?>