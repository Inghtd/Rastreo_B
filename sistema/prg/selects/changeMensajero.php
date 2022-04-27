<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_mensajero=$_POST["id_mensajero"];

$sql="SELECT * FROM mensajero WHERE id_mensajero='$id_mensajero'";

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
   $id_mensajero    =$row[0]; 
   $nombre          =$row[1]; 
   $direccion       =$row[2]; 
   $telefono        =$row[3]; 

   echo "200-".$id_mensajero."-".$nombre."-".$direccion."-".$telefono."\n";
   //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}
?>