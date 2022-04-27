<?php
/*	ini_set ("display_errors","1" );
	error_reporting(E_ALL);*/
	session_start();
	if(empty($_SESSION['shi_codigo']))
	{
	exit("Tu sesion ha caducado, ingresa nuevamente.");
	}
//echo "1";
//define('FPDF_FONTPATH','../lib/fpdf16/font/');
require('../lib/fpdf16/fpdf.php');
require_once('../lib/fpdf16/qrcode/qrcode.class.php');
require ('../class/db.php');
require ('../class/db2.php');
require ('../class/cab.php');
include('../sistema/model/model_con.php');
include('../sistema/prg/guiapdf.php');

//$referencia		='Referencia'];
$tipo_envio		='tipo Envio';
$tipo			='tipo';
$producto		='12';
$cli_codigo		='cli_codigo';
$cuenta			='5000100';
$nombre			='nom_remitente';
$direccion		='dir_remitente';
$nombre_municipio	='municipio';
$telefono		='tel_remitente';
$cantidad		='cantidad';
$observaciones		='observaciones';
$seguro			='seguro';
$monto			='monto';
$doc			='doc';
$shi_codigo		=$_SESSION['shi_codigo'];
$peso			='peso';



$i=1;
$numero_guia=1;

	$con=new model_con();
	$mys=new model_con();
	$cmy=$mys->conectam();
	
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



	$mun=$con->consulta_municipio($nombre_municipio);
	$municipio=0;
	while($cod_muni = $con->fetch($mun))
	{
	$municipio=$cod_muni[0];
	}

	
	$fecha			=date('dmY');
	$usuario		=$_SESSION['cod_usuario'];
	$hora			=date('H:i:s');
	$tiempo			=time();
	$real_ip		=$con->realip();
/*echo $existe."<br>";
echo $barra_cliente."<br>";
echo $barra_cliente2."<br>";
echo $barra_cliente3."<br>";
echo $barra_cliente4."<br>";*/

$datos=$con->datos_productos($producto);

$nota	      =$datos[5];
$tipo_producto=$datos[0];

$tipo_envio="Entregas";

$cod_remitente=$datos[1];
$nom_remitente=$datos[2];
$dir_remitente=$datos[3];
$tel_remitente=$datos[4];

$cod_municipio_ori=205;
$emp_remitente=$_SESSION['shi_nombre'];

$cod_destinatario=$cuenta;
$nom_destinatario=$nombre;
$dir_destinatario=$direccion;
$cod_municipio_des=$municipio;
$tel_destinatario=$telefono;
$emp_destinatario=$empresa;


$consulta_impresion="
SELECT a . * , b . *
FROM sv_catalogo_guias a, sv_configuracion_guias b
WHERE b.tipo = 'impresion'
AND b.valor = '1'
AND b.shi_codigo = '$shi_codigo'
AND b.opcion = a.nombre_formato
";
//echo $consulta_impresion;
$cmy=$mys->consultam($consulta_impresion);
$municipio=0;
while($row = $mys->fetchm($cmy))
{
$id_formato		=$row[0];
$nombre_formato		=$row[1];
$descripcion		=$row[2];
$estado			=$row[3];
$orientacion		=$row[4];
$unidad			=trim($row[5]);
$largo			=$row[6];
$alto			=$row[7];
$usuario_creador	=$row[8];
$fecha_creacion		=$row[9];
$hora_creacion		=$row[10];
}

if(!empty($unidad))
{
		//echo $orientacion." - ".$unidad." - ".$largo." - ".$alto;
		$pdf=new PDF($orientacion,$unidad,array($largo,$alto));
		$pdf->AddPage();
		$pdf->$nombre_formato($referencia,$numero_guia);
	//$pdf->cell(10,10,$largo." - ".$alto);
	$pdf->Output($numero_guia.".pdf","D");
	$pdf->Output("/tmp/".$numero_guia.".pdf","F");

}
/*else
{
$pdf=new PDF('P','mm',array(215.9,279.4));
$pdf->AddPage();
$pdf->test3xpag($referencia,$numero_guia);
}
*/
//	echo $shi_codigo." - ".$orientacion." - ".$unidad." - ".$largo." - ".$alto;

?>