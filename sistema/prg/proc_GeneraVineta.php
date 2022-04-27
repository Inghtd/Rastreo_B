<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');

$db = new model_con();

$sql = $db->consulta_correlativo();

if($sql > 0)
{
    $seq = "S".$sql;
    
    $retorno = "200-".$seq;
}else
{
    $retorno = "400-Error generando # vineta:  proc_GeneraVienta  ";
}

echo $retorno;
