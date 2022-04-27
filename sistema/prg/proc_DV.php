<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
$numid          = $_POST["numid"];
$posicion       = $_POST["posicion"];
$id_motivo      = $_POST["id_motivo"];
//$cli_id         = $_POST["cli_id"];

$db = new model_con();

if($numid=='' || $numid==NULL)
{
    $retorno = "400-Manifiesto esta vacio";
}elseif($posicion=='' || $posicion==NULL || $posicion==0)
{
    $retorno = "400-Posicion vacia o no valida";
}elseif($id_motivo=='' || $id_motivo==NULL)
{
    $retorno = "400-Motivo de devolucion vacio";
}
else{
    //Agregamos el movimiento
    $sql=$db-> procesar_DV($numid,$posicion,$id_motivo);

    if($sql=='Existe')
    {
        $retorno="400-Posicion no esta apta para devolucion o no existe en BDD";
    }
    elseif($sql=='Insertado')
    {
        $retorno = "200-".$sql."-".$numid;
    }
    else
    {
        $retorno = "400-Error en proc_DV : ".$numid;
    }
}

echo $retorno;
