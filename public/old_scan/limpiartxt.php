<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
header('Strict-Transport-Security: max-age=0;');
date_default_timezone_set('America/Guatemala');

$postdata = json_decode(file_get_contents("php://input"));

$nombre=$_GET['nom'];

$fch=date("d-m-Y");
$url="tmp/".$nombre;
If (unlink($url)) {
    return "archivo eliminado exitosamente";
  } else {
    return "no pudo ser eliminado";
  }
?>