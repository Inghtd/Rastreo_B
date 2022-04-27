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


$f1=$_GET['f1'];
$f2=$_GET['f2'];



include("historico.php");

$nivel=$_SESSION['nivel'];


$x1= new historico_ingresos();

$data= $x1->rep_historico_full($f1,$f2);

//Inicio de exportación en Excel


echo $data;

?>
