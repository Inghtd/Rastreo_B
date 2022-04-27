<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$id_ccosto=strtoupper ($_GET["q"]);

//echo $id_ccosto;

$sql="SELECT * FROM centro_costo WHERE ccosto_nombre like '%$id_ccosto%' AND ccosto_estado=1";

$data=array();

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
    $id_ccosto         =trim($row[0]);
    $id_agencia        =trim($row[1]);
    $cli_id            =trim($row[2]); 
    $ccosto_codigo     =trim($row[3]); 
    $ccosto_nombre     =trim($row[4]);
    $ccosto_direccion  =trim($row[5]);
    $ccosto_telefono   =trim($row[6]);

  $data[]=array(
        "nombre"=>$ccosto_nombre."-".$ccosto_codigo,
        "id"    =>$id_ccosto
  );  
    //echo "200+".$id_ccosto."+".$id_agencia."+".$cli_id."+".$ccosto_codigo."+".$ccosto_nombre."+".$ccosto_direccion."+".$ccosto_telefono."\n";
    //echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}
echo json_encode($data);
?>