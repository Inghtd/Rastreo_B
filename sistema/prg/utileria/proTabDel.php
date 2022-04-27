<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_vineta     =$_POST["id_vineta"];


$sql="UPDATE rastreobam.guia SET estado=0 WHERE estado=1 AND id_orden=1 AND id_envio='$id_vineta'";

$stmt= $dbp->preparar($sql);

if($stmt->execute()){
    $msj="Insertado";
}else{
	$msj="Error";
}

if($msj=='Insertado'){
    $retorno = "200-".$id_vineta."-".$sql;

}else{
    $retorno = "400-Error en proTabDel : ".$sql;
}

//$retorno = "200-".$id_vineta;

echo $retorno;