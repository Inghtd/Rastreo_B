<?php
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
include('../model/model_con.php');

$llave              = time();
$id_cli             = $_POST["id_cli"];
$id_ccosto          = $_POST["id_ccosto"];
$bolsa              = $_POST["bolsa"];

//print_r($bolsa);

$db = new model_con();

//Creacion de OS
$sql = $db->procesar_OS($id_cli,$bolsa);

//if($sql=='Insertado'){
if($sql > 0)
{
    $id_orden = $sql;

    //Si la orden se creo correctamente se procede a actualizar la Guia con el nuevo id de orden
    
  
   
    
    if($bolsa==1){
       
   

    $sql_1=$db->procesar_GuiaOS2($id_cli,$id_ccosto,$id_orden);

    $sql_1=$db->procesar_bolsa_OS($id_orden);
        
    }else{

        $sql_1=$db->procesar_GuiaOS($id_cli,$id_ccosto,$id_orden);
    }

    if($sql_1=='Insertado'){
        $retorno = "200-".$sql."-".$id_cli;

    }else{
        $retorno = "400-Error en proc_OS Guia: ".$sql;
    }
    $retorno = "200-".$id_orden."-".$id_cli;
}else
{
    $retorno = "400-Error en proc_OS : ".$sql;
}

echo $retorno;

?>

