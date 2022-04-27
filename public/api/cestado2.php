<?php


header('Strict-Transport-Security: max-age=0;');
date_default_timezone_set('America/Guatemala');
$postdata = json_decode(file_get_contents("php://input"));

$pedido=$postdata->pedido;
$proceso=$postdata->proceso;
$descripcion=$postdata->descripcion;
$latitude=$postdata->latitude;
$longitude=$postdata->longitude;
$tiempo=$postdata->tiempo;
$resurce=$postdata->resource;
$userid=$postdata->userid;

$dd=array(
    "status" => 200,
    "mensaje"=> "OK"
);
sleep(15);
return $dd;

?>