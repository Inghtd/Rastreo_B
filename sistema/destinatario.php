<?php
include('../class/db.php');
/* ini_set ("display_errors","1" );
 error_reporting(E_ALL);*/


//$p=array("a","b","c");
//print_r($p);
//echo json_decode($p);


$db=db::getInstance();
session_start();
$q = strtoupper($_POST["search"]);
if (!$q) return;

$sql ="
select u.usr_nombre , 
       u.usr_cod, 
       c.ccosto_codigo,
       c.ccosto_nombre,
       c.centro_direccion,
       a.agencia_nombre,
       u.id_ccosto,
       a.agencia_codigo,
       a.agencia_telefono
from usuario u inner join centro_costo c
on u.id_ccosto=c.id_ccosto
inner join agencia a 
on c.id_agencia=a.id_agencia
where usr_nombre like '%".$q."%'
limit 1,20;
";

$stmt=$db->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM))
{
$response[]=array
(   "value"=>$row[1],
    "label"=>$row[0],
    "ccosto"=>$row[2],
    "ccosto_nombre"=>$row[3],
    "ccosto_direccion"=>$row[4],
    "agencia"=>$row[5],
    "id_ccosto"=>$row[6],
    "agencia_codigo"=>$row[7],
    "agencia_telefono"=>$row[8]
);
}

echo json_encode($response);

?>