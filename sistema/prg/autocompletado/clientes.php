<?php
include('../../../class/db2.php');
/* ini_set ("display_errors","1" );
 error_reporting(E_ALL);*/
$q=11;
$dbp=dbp::getInstance();
session_start();
$q = strtoupper($_GET["q"]);
//$q=K;
if (!$q) return;

$sql ="
select SKIP 0 FIRST 8
DISTINCT gui_llave
from cliente
where shi_codigo='".$_SESSION['shi_codigo']."'
and gui_llave LIKE '".$q."%'
";

$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM))
{
	$gui_llave=$row[0];
//	$cname = trim($rHyow[0]);
// 	$dir	=trim($row[1]).trim($row[2]);
// 	$tel	=trim($row[3])." ".trim($row[4]);
echo $gui_llave."\n";
//echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
}
//echo $cname." ZWX ".$dir." ZWX ".$tel."\n";
//echo  $sql;
?>