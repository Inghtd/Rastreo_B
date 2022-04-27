<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');
$id_mensajero          = $_POST["id_mensajero"];
$nombre_mensajero      = $_POST["nombre_mensajero"];
$direccion_mensajero   = $_POST["direccion_mensajero"];
$telefono_mensajero    = $_POST["telefono_mensajero"];
   
$db = new model_con();

if($nombre_mensajero=='' || $nombre_mensajero ==NULL){
    $retorno = "Nombre de mensajero esta vacio";
    $sql="";
}elseif($direccion_mensajero=='' || $direccion_mensajero ==NULL){
    $retorno = "Direccion de mensajero esta vacio";
    $sql="";
}elseif($telefono_mensajero=='' || $telefono_mensajero ==NULL){
    $retorno = "Telefono de mensajero esta vacio";
    $sql="";
}else{
    $sql = $db->ing_mensajero($id_mensajero,$nombre_mensajero,$direccion_mensajero,$telefono_mensajero);

    if($sql=='Insertado'){
        $retorno = "200-".$sql."-".$id_mensajero;

    }else{
        $retorno = "400-Error en mant_mensajero : ".$sql;
    }
}
echo $retorno."-".$sql;
?>