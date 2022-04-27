<?php
include('../../../class/db2.php');
$q=11;
$dbp=dbp::getInstance();
$q = strtoupper($_GET["q"]);
if (!$q) return;
$sql ="
select *
from ruta_destino
where municipio LIKE '".$q."%'
";
$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM))
{
echo $row[1]."\n";
}
?>