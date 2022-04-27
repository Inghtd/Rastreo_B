<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
$id_vineta = $_POST["id_vineta"];

$db = new model_con();

//Agregamos el movimiento
$sql=$db-> procesar_AR($id_vineta);

if($sql=='Existe')
{
    $retorno="400-Vi&ntilde;eta no esta apta para arribo o no existe en BDD";
}
elseif($sql=='Insertado')
{
    $retorno = "200-".$sql."-".$id_vineta;
}
else{
    $retorno = "400-Error en proc_AR : ".$id_vineta;
}

echo $retorno;