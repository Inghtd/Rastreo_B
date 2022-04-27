<?php
//clase modelo BDD
class sql
{



	function __construct()
	{

	$action	=$_GET['m2'];
	$prc	=$_GET['prc'];
	$url	=$_SERVER['REQUEST_URI'];
	//?prc=filtro_xls&f1=19-08-2012&f2=19-11-2012&m=205&m2=x
	}

public function data_general_filtro_xls()
{
$cantidad=16;

$f1=$_GET['f1'];
$f2=$_GET['f2'];

$titulo="Reporte de Envios Urbano Desde ".$f1." Hasta ".$f2." Generado el ".date('d-mY H:i:s');
$nombre_doc="Reporte_Distribucion_Urbano_".date('d-m-Y_H:i:s');

return $cantidad.",".$titulo.",".$nombre_doc;
}

public function cabecera_filtro_xls()
{
$data[]=array("referencia","barra","tipo_envio","remitente","nombre","direccion","tel","Cta destinatario","Nombre","Direccion","telefono","cant","observaciones","seguro","fecha_envio","monto","documento");
return $data;
}

public function filtro_xls()
{
$f1=$_GET['f1'];
$f2=$_GET['f2'];
	session_start();

$shi_codigo=$_SESSION['shi_codigo'];

$query1 = "select
referencia,barra,tipo_envio,remitente,nom_remitente,dir_remitente,tel_remitente,destinatario,nom_destinatario,dir_destinatario,tel_destinatario,cantidad,observaciones,seguro,fecha_envio,monto,documento
from detalle_cuenta
where fecha_envio between '$f1' and '$f2'
and shi_codigo='$shi_codigo'
";
			$dbp=dbp::getInstance();

$stmt_fact=$dbp->consultar($query1);
while ($fac =$dbp->fetch($stmt_fact))
{
$data[]=$fac;
}
return $data;
}




}

?>