<?php
session_start();
// ini_set ("display_errors","1" );
// error_reporting(E_ALL);

require ('../class/db2.php');
require ('../class/cab.php');
include('../sistema/model/model_con.php');
$referencia	=$_POST['referencia'];
$tipo_envio	=$_POST['tipo'];
$tipo		=$_POST['tipo'];
$producto	=$_POST['producto'];
$cli_codigo	=$_POST['cli_codigo'];
$cuenta		=$_POST['cli_codigo'];
$nombre		=$_POST['nom_remitente'];
$direccion	=$_POST['dir_remitente'];
$municipio	=$_POST['municipio'];
$telefono	=$_POST['tel_remitente'];
$cantidad	=$_POST['cantidad'];
$observaciones=preg_replace('`[^A-Za-z0-9-_,/]`i', ' ',$_POST['observaciones']);
$seguro		=$_POST['seguro'];
$monto		=$_POST['monto'];
$doc		=$_POST['doc'];
$shi_codigo=$_SESSION['shi_codigo'];


function salida_txt($id_referencia,$numero_guia,$i)
{
/*require ('db2.php');
require ('cab.php');
include('../sistema/model/model_con.php');
*/
header ("Content-Disposition: attachment; filename=\"guia.TXT\"" );
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");


$fecha_my=date('Y-m-d');
$fecha_hm=date('d    m   Y');
$hora=date('H:i:s');
$tiempo=time();

	$cab=new model_con();
	$stmt=$cab->detalle_cuenta($id_referencia);
	while($row = $cab->fetch($stmt))
	{
	$id_detalle		=utf8_decode($row[0]);
	$referencia		=utf8_decode($row[1]);
	$barra			=utf8_decode($row[2]);
	$tipo_envio		=utf8_decode($row[3]);
	$remitente		=utf8_decode($row[4]);
	$nom_remitente		=utf8_decode($row[5]);
	$dir_remitente		=utf8_decode($row[6]);
	$cod_municipio_ori	=utf8_decode($row[7]);
	$tel_remitente		=utf8_decode($row[8]);
	$destinatario		=utf8_decode($row[9]);
	$nom_destinatario	=utf8_decode($row[10]);
	$dir_destinatario	=utf8_decode($row[11]);
	$cod_municipio_des	=utf8_decode($row[12]);
	$tel_destinatario	=utf8_decode($row[13]);
	$cantidad		=utf8_decode($row[14]);
	$observaciones		=utf8_decode($row[15]);
	$seguro			=utf8_decode($row[16]);
	$fecha_envio		=utf8_decode($row[17]);
	$usuario		=utf8_decode($row[18]);
	$hora			=utf8_decode($row[19]);
	$tiempo			=utf8_decode($row[20]);
	$real_ip		=utf8_decode($row[21]);
	$monto			=round($row[22],2);
	$tipo			=utf8_decode($row[23]);
	$doc			=utf8_decode($row[24]);
	if($seguro=='1')
	{
	$seguro="SI";
	}else
	{
	$seguro="NO";
	}

	}


echo "REMITENTE: ".$remitente." ".$nom_remitente."\r\n";
echo "DIRECCION :".$dir_remitente."\r\n";
echo "|".$dir_remitente."\r\n";
echo "|".$dir_destinatario."\r\n";
echo "|".$dir_destinatario."\r\n";
echo "|".$dir_destinatario."\r\n";
echo "|".$dir_destinatario."\r\n";
echo "|".$dir_destinatario."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$dir_remitente."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$observaciones."\r\n";
echo "|".$dir_remitente."\r\n";


}

	$con=new model_con();
	$cou=$con->consulta_cuenta($cuenta);
	$existe=0;
	while($fil = $con->fetch($cou))
	{
	$existe='1';
	$barra_cliente=$fil[0];
	$barra_cliente2=$fil[1];
	$barra_cliente3=$fil[2];
	$barra_cliente4=$fil[3];
	}

	$fecha			=date('dmY');
	$usuario		=$_SESSION['shi_codigo'];
	$hora			=date('H:i:s');
	$tiempo			=time();
	$real_ip		=$con->realip();
if($existe==0)
{
$inserta_cliente=$con->inserta_cliente($cuenta,$nombre,$direccion,$telefono);
//echo $inserta_cliente."<br>";
}else
{
$actualiza_cliente=$con->actualiza_cliente($cuenta,$nombre,$direccion,$telefono);
//echo $actualiza_cliente."<br>";
}

$datos=$con->datos_productos($producto);


if($tipo==0)
{
$tipo_envio="Entregas";

$cod_remitente=$datos[1];
$nom_remitente=$datos[2];
$dir_remitente=$datos[3];
$tel_remitente=$datos[4];
$cod_municipio_ori=205;

$cod_destinatario=$cuenta;
$nom_destinatario=$nombre;
$dir_destinatario=$direccion;
$cod_municipio_des=$municipio;
$tel_destinatario=$telefono;

$numero_guia=$con->registra_envio($referencia,$tipo_envio,$cod_remitente,$nom_remitente,$dir_remitente,$cod_municipio_ori,$tel_remitente,$cod_destinatario,$nom_destinatario,$dir_destinatario,$cod_municipio_des,$tel_destinatario,$cantidad,$observaciones,$seguro,$monto,$fecha,$usuario,$hora,$tipo_envio,$doc,$shi_codigo);
salida_txt($referencia,$numero_guia,$i,$inserta_cliente);
//$pdf->pagina_pos1($referencia,$numero_guia,$i,$inserta_cliente);
}elseif($tipo==1)
{
$tipo_envio="Recolecciones";

$cod_remitente=$cuenta;
$nom_remitente=$nombre;
$dir_remitente=$direccion;
$tel_remitente=$telefono;
$cod_municipio_ori='205';
$cod_municipio_des=$municipio;


$cod_destinatario=$datos[1];
$nom_destinatario=$datos[2];
$dir_destinatario=$datos[3];
//$cod_municipio_des=205;
$tel_destinatario=$datos[4];


$numero_guia=$con->registra_envio($referencia,$tipo_envio,$cod_remitente,$nom_remitente,$dir_remitente,$cod_municipio_ori,$tel_remitente,$cod_destinatario,$nom_destinatario,$dir_destinatario,$cod_municipio_des,$tel_destinatario,$cantidad,$observaciones,$seguro,$monto,$fecha,$usuario,$hora,$tipo_envio,$doc,$shi_codigo);

//$pdf->pagina_pos1($referencia,$numero_guia,$i);
}elseif($tipo==2)
{
$tipo_envio="Entrega";

$cod_remitente=$datos[1];
$nom_remitente=$datos[2];
$dir_remitente=$datos[3];
$tel_remitente=$datos[4];
$cod_municipio_ori=205;
//$cod_municipio_des=$municipio;

$cod_destinatario=$cuenta;
$nom_destinatario=$nombre;
$dir_destinatario=$direccion;
$cod_municipio_des=$municipio;
$tel_destinatario=$telefono;

$numero_guia=$con->registra_envio($referencia,$tipo_envio,$cod_remitente,$nom_remitente,$dir_remitente,$cod_municipio_ori,$tel_remitente,$cod_destinatario,$nom_destinatario,$dir_destinatario,$cod_municipio_des,$tel_destinatario,$cantidad,$observaciones,$seguro,$monto,$fecha,$usuario,$hora,$tipo_envio,$doc,$shi_codigo);

//$pdf->pagina_pos1($referencia,$numero_guia,$i);

$cod_remitente=$cuenta;
$nom_remitente=$nombre;
$dir_remitente=$direccion;
$tel_remitente=$telefono;
$cod_municipio_ori=$municipio;

$cod_destinatario=$datos[1];
$nom_destinatario=$datos[2];
$dir_destinatario=$datos[3];
$cod_municipio_des=205;
$tel_destinatario=$datos[4];
$tipo_envio="Recoleccion";
$numero_guia=$con->registra_envio($referencia,$tipo_envio,$cod_remitente,$nom_remitente,$dir_remitente,$cod_municipio_ori,$tel_remitente,$cod_destinatario,$nom_destinatario,$dir_destinatario,$cod_municipio_des,$tel_destinatario,$cantidad,$observaciones,$seguro,$monto,$fecha,$usuario,$hora,$tipo_envio,$doc,$shi_codigo);

$pdf->AddPage();
//$pdf->pagina_pos1($referencia,$numero_guia,$i);

}else
{
$tipo_envio="Entregas";
}


?>
