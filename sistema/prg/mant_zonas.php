<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');
$cli_id          = $_POST["cli_id"];
$id_zona         = $_POST["id_zona"];
$codigo_zona     = $_POST["codigo_zona"];
$nombre_zona     = $_POST["nombre_zona"];

$db = new model_con();

if($codigo_zona=='' || $codigo_zona ==NULL){
    $retorno = "Codigo de zona esta vacio";
    $sql="";
}
elseif($nombre_zona=='' || $nombre_zona ==NULL){
    $retorno = "Nombre de zona esta vacio";
    $sql="";
}else{
    $sql = $db->ing_zona($cli_id,$id_zona,$codigo_zona,$nombre_zona);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_zona;

    }else{
        $retorno = "400-Error en mant_zona : ".$sql;
    }
}
echo $retorno."-".$sql;
?>