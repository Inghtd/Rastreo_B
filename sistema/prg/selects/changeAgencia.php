<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$agencia=$_GET["q"];

$sql="SELECT * FROM agencia WHERE agencia_nombre like '%$agencia%' AND agencia_estado=1";

$data=array();

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
    $id_agencia         =trim($row[0]);
    $cli_id             =trim($row[1]); 
    $agencia_codigo     =trim($row[2]); 
    $agencia_nombre     =trim($row[3]);
    $agencia_direccion  =trim($row[4]);
    $agencia_telefono   =trim($row[5]);

    //echo "200-".$id_agencia."-".$cli_id."-".$agencia_codigo."-".$agencia_nombre."-".$agencia_direccion."-".$agencia_telefono."\n";
    //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
if(isset($_GET['id'])){
  $data[]=array(
    "nombre"=>$agencia_nombre."-".$agencia_codigo ,
    "id"    =>$id_agencia
  );
}else{
    $data[]=array(
        "nombre"=>$agencia_nombre."-".$agencia_codigo ,
        "id"    =>$agencia_nombre
  );  
}

}

echo json_encode($data);
?>