<?php
$ccosto_ori=$_POST["ccosto_ori"];
$ccosto_des=$_POST["ccosto_des"];
$destinatario=$_POST["destinatario"];
$descripcion=$_POST["descripcion"];
$vineta=$_POST["vineta"];

$retorno="200-".$ccosto_ori."-".$ccosto_des."-".$destinatario."-".$descripcion."-".$vineta;

return $retorno;

?>
