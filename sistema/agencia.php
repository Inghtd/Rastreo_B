<?php
include('../class/db.php');
 ini_set ("display_errors","1" );
 error_reporting(E_ALL);


//$p=array("a","b","c");
//print_r($p);
//echo json_decode($p);


$db=db::getInstance();
session_start();
$q = strtoupper($_REQUEST["search"]);
if (!$q) return;

$sql ="
select a.agencia_nombre,
       a.agencia_codigo,
       a.agencia_direccion
from agencia a 
where a.agencia_codigo ='".$q."'
";

$stmt=$db->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM))
{
    $response[]=array
    (
        "agencia"=>$row[0],
        "agencia_codigo"=>$row[1],
        "agencia_direccion"=>$row[2]
    );
}

//echo $row[0];
echo json_encode($response);

?>