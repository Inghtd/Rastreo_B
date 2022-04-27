<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_zona=$_POST["id_zona"];

$sql="SELECT * FROM zona WHERE id_zona='$id_zona'";

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
    $id_zona         =trim($row[0]);
    $zona_codigo     =trim($row[1]); 
    $zona_nombre     =trim($row[2]);

    echo "200-".$id_zona."-".$zona_codigo."-".$zona_nombre."\n";
    //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}
?>