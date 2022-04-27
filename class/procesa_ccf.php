<?php

//ini_set ("display_errors","1" );
//error_reporting(E_ALL);

session_start();
if(empty($_SESSION['shi_codigo']))
{
	exit("Tu sesion ha caducado, ingresa nuevamente.");
}

require('../lib/fpdf16/fpdf.php');
require_once('../lib/fpdf16/qrcode/qrcode.class.php');
require ('../class/db.php');
require ('../class/db2.php');
require ('../class/cab.php');
include('../sistema/model/model_con.php');
include('../sistema/prg/guiapdf.php');

$referencia	=$_POST['referencia'];
$guia		=$_POST['barra'];
$cli_codigo	=$_POST['cli_codigo'];
$nom_remitente	=$_POST['nom_remitente'];
$registro_fiscal=$_POST['registro_fiscal'];
$giro		=$_POST['giro'];
$nit		=$_POST['nit'];
$opciones_pago	=$_POST['opciones_pago'];
$tipo_documento	=$_POST['tipo_documento'];
$barra		=$_POST['barra'];
$documento	=intval($_POST['documento']);

$i=1;
$numero_guia=1;

$con=new model_con();
$actualizando_datos_fiscales=$con->update_datos_fiscales($barra,$cli_codigo,$registro_fiscal,$nit,$giro,$tipo_documento,$documento);
$pdf=new PDF('L','mm',array(215.9,215.9));
$pdf->AddPage();
$pdf->ccf_matricial1($referencia,$guia);

//$output=$numero_guia.".pdf";

$pdf1=new PDF_AutoPrint;
$pdf1->AutoPrintToPrinter('localhost','LQ590',true);
$pdf->Output($numero_guia.".pdf","D");

//$cmd = "lp -o media=Custom.21.50x21.50 ".$ouput." -d LQ590";
//exec($cmd,$output,$retval);

//lp -o media=Custom.21.50x21.50 1.pdf -d LQ590


?>