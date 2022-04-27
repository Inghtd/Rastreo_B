<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
$numid          = $_POST["numid"];

$db = new model_con();

if($numid=='' || $numid==NULL){
    $retorno = "Manifiesto esta vacio";
}else{
    //Agregamos el movimiento
    $sql=$db-> procesar_DL($numid);

    if($sql=='Insertado')
    {
        $retorno = "200-".$sql."-".$numid;
    }
    else
    {
        $retorno = "400-Error en proc_DL : ".$numid;
    }
}

echo $retorno;
