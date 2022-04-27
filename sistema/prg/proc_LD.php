<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
//$numid          = $_POST["numid"];
//$posicion       = $_POST["posicion"];
$id_zona        = $_POST["id_zona"];
$id_mensajero   = $_POST["id_mensajero"];
$vineta         = $_POST["vineta"];

$db = new model_con();


//echo $vineta.'-ss';
if($id_zona=='' || $id_zona==NULL)
{
    $retorno="400-No se ha seleccionado una zona valida";
}
elseif($id_mensajero=='' || $id_mensajero==NULL)
{
    $retorno="400-No se ha seleccionado un mensajero valido";
}
elseif($vineta=='' || $vineta==NULL)
{
    $retorno="400-Ingrese una vi&ntilde;eta valida, sin proceso";
}
else{
    //Agregamos el movimiento
    $sql=$db-> procesar_LD($id_zona,$id_mensajero,$vineta);

    if($sql=='Existe')
    {
        $retorno="400-Vi&ntilde;eta no esta apta para salida a ruta o no existe en BDD";
    }
    elseif($sql=='Insertado')
    {
        $retorno = "200-".$sql."-".$vineta;
    }
    else{
        $retorno = "400-Error en proc_LD : ".$vineta;
    }
}

echo $retorno;