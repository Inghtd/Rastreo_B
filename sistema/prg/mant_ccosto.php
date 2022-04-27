<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');

$id_ccosto         = $_POST["id_ccosto"];
$cli_id            = $_POST["cli_id"];
$id_agencia        = $_POST["id_agencia"];
$codigo_ccosto     = $_POST["codigo_ccosto"];
$nombre_ccosto     = $_POST["nombre_ccosto"];
$direccion_ccosto  = $_POST["direccion_ccosto"];
$telefono_ccosto   = $_POST["telefono_ccosto"];

$db = new model_con();

if($id_agencia=='' || $id_agencia ==NULL){
    $retorno = "Codigo de agencia esta vacio";
    $sql="";
}
elseif($nombre_ccosto=='' || $nombre_ccosto ==NULL){
    $retorno = "Nombre de centro de costo esta vacio";
    $sql="";
}
elseif($direccion_ccosto=='' || $direccion_ccosto ==NULL){
    $retorno = "Direccion de centro de costo esta vacio";
    $sql="";
}else{
    $sql = $db->ing_ccosto($id_ccosto,$cli_id,$id_agencia,$codigo_ccosto,$nombre_ccosto,$direccion_ccosto,$telefono_ccosto);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_ccosto;

    }else{
        $retorno = "400-Error en mant_ccosto : ".$sql;
    }
}
echo $retorno."-".$sql;
?>