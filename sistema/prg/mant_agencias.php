<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');

$cli_id             = $_POST["cli_id"];
$id_agencia         = $_POST["id_agencia"];
$codigo_agencia     = $_POST["codigo_agencia"];
$nombre_agencia     = $_POST["nombre_agencia"];
$direccion_agencia  = $_POST["direccion_agencia"];
$telefono_agencia   = $_POST["telefono_agencia"];

$db = new model_con();

if($codigo_agencia=='' || $codigo_agencia ==NULL){
    $retorno = "Codigo de agencia esta vacio";
    $sql="";
}
elseif($nombre_agencia=='' || $nombre_agencia ==NULL){
    $retorno = "Nombre de agencia esta vacio";
    $sql="";
}
elseif($direccion_agencia=='' || $direccion_agencia ==NULL){
    $retorno = "Direccion de agencia esta vacio";
    $sql="";
}else{
    $sql = $db->ing_agencia($cli_id,$id_agencia,$codigo_agencia,$nombre_agencia,$direccion_agencia,$telefono_agencia);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_agencia;

    }else{
        $retorno = "400-Error en mant_agencia : ".$sql;
    }
}
echo $retorno."-".$sql;
?>