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

$referencia		=$_POST['referencia'];
$tipo_envio		=$_POST['tipo'];
$tipo			=$_POST['tipo'];
$producto		=$_POST['producto'];
$cli_codigo		=$_POST['cli_codigo'];
$cuenta			=$_POST['cli_codigo'];
$nombre			=utf8_encode($_POST['nom_remitente']);
$direccion		=utf8_encode($_POST['dir_remitente']);
$nombre_municipio	=$_POST['municipio'];
$telefono		=utf8_encode($_POST['tel_remitente']);
$cantidad		=$_POST['cantidad'];
$observaciones		=preg_replace('`[^A-Za-z0-9-_,/.*#$]`i', ' ',$_POST['observaciones']);
$seguro			=$_POST['seguro'];
$monto			=$_POST['monto'];
$doc			=utf8_encode($_POST['doc']);
$shi_codigo		=$_SESSION['shi_codigo'];
$peso			=$_POST['peso'];







if(empty($referencia))
{
		$md5=strtoupper(preg_replace('`[^ 0-9A-Z]`i', '', md5(strtoupper(date('YMdhms')))));
		$cadena=substr($md5,1,9);
		$referencia=$cadena;
}


//'P','mm',array(215.9,140.0)

$i=1;
$numero_guia=1;
//$pdf->AddPage();


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
if($existe==0)
{
$inserta_cliente=$con->inserta_cliente($cuenta,$nombre,$direccion,$telefono,$empresa,$nombre_municipio);
//echo $inserta_cliente."<br>";
}else
{
$actualiza_cliente=$con->actualiza_cliente($cuenta,$nombre,$direccion,$telefono,$empresa,$nombre_municipio);
//echo $actualiza_cliente."<br>";
}

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
$registro="0";
$nit="0";
$giro="0";
$tipo_doc="0";
//$doc=0;

$numero_guia=$con->registra_envio($referencia,$tipo_envio,$cod_remitente,$nom_remitente,$dir_remitente,$cod_municipio_ori,$tel_remitente,$cod_destinatario,$nom_destinatario,$dir_destinatario,$cod_municipio_des,$tel_destinatario,$cantidad,$observaciones,$seguro,$monto,$fecha,$usuario,$hora,$producto,$doc,$shi_codigo,$emp_remitente,$emp_destinatario);


$consulta_impresion="
select * from sv_configuracion_guias
where tipo='impresion'
and valor='1'
and shi_codigo='$shi_codigo'
";

$cmy=$mys->consultam($consulta_impresion);
$municipio=0;
$opcion="";
while($rowm2 = $mys->fetchm($cmy))
{
$opcion=$rowm2[2];
}

if($opcion=="guia_carta_2_copias")
{
$pdf=new PDF();


$ciclo=date('dmY');
$trozo_doc=substr($doc,0,3);
$tipo_documento=$trozo_doc[0];
$recolector="123";

$guia_facturacion=$con->asignar_guias_facturacion();
$id_bitacora	=$con->solicitud_recoleccion($numero_guia,$referencia);
$orden		=$con->crea_os_counter($id_bitacora,$shi_codigo);
$insert_guia_u20=$con->insert_guia($guia_facturacion,1,$usuario,$recolector,$observaciones,$shi_codigo,"SE",$ciclo,$id_bitacora);
	//echo $insert_guia_u20."<br>";
		$ingreso_counter=$con->registro_counter($guia_facturacion,$doc,$nom_destinatario,$tel_destinatario,$cod_destinatario,"E","123",$shi_codigo,$monto,$usuario,$tipo_documento,"",$cantidad);


$datos_finanzas=$con->insert_datos_fiscales($numero_guia,$guia_facturacion,$cod_destinatario,$registro,$nit,$giro,$tipo_doc,$doc);

//$id_bitacora	=$con->solicitud_recoleccion($numero_guia,$referencia);
	
//$ord_numero	=$con->crea_os_counter($id_bitacora,$shi_codigo);

//$guia		=$con->agregar_guiax_counter($gui_codigo,$cantidad,$ord_numero);
	

	
$asignar=$con->asigna_shipper_guia_paq($numero_guia);
$asigna_peso=$con->asigna_pesos_guia_paq($numero_guia,$_POST['peso']);
$ar=$con->ar_guia_paq($numero_guia,$referencia);

// 		if($_SESSION['usr_codigo']=='mabrego')
// 		{
// 		echo $ar."<br>";
// 
// 		}

	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia,$guia_facturacion);
	$pdf->addPage();
	$pdf->pagina_pos2("/tmp/texto_pricesmart.txt");
	//no tocar estos espacios, son necesarios
	$pdf->MultiCell(0,2,"
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	");
	$pdf->pagina_pos2("/tmp/texto_pricesmart.txt");
	
	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia,$guia_facturacion);

	$pdf->Output($numero_guia.".pdf","D");
	$pdf->Output("/tmp/".$numero_guia.".pdf","F");


}else
{


if(!empty($opcion))
{




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
	//$pdf->Output("/tmp/".$numero_guia.".pdf","F");
	
	}else
	{

	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);
	$pdf->Output($numero_guia.".pdf","D");
	//$pdf->Output("/tmp/".$numero_guia.".pdf","F");

	}














}else
{


$pdf=new PDF();
$pdf->AddPage();
$pdf->guia_carta_2_copias($referencia,$numero_guia);
$pdf->Output($numero_guia.".pdf","D");
//$pdf->Output("/tmp/".$numero_guia.".pdf","F");


}



}



/*elseif($opcion=='guia_matricial1')
{


$pdf=new PDF('L','mm',array(141.0,191.1));
$pdf->AddPage();
$pdf->guia_matricial1($referencia,$numero_guia,$guia_facturacion);


}elseif($opcion=='guia_matricial2')
{
$pdf=new PDF('L','mm',array(141.0,191.1));
$pdf->AddPage();
$pdf->guia_matricial1($referencia,$numero_guia);

}
else
{

	if(!empty($_POST['tipo_impresion']))
	{
$tipo_impresion=$_POST['tipo_impresion'];
		if($tipo_impresion==1)
		{
		$pdf=new PDF('L','mm',array(139.7,191.1));
		$pdf->AddPage();
		$pdf->guia_txt2($referencia,$numero_guia);
		}else
		{
		$pdf=new PDF();
		$pdf->AddPage();
		$pdf->guia_carta_2_copias($referencia,$numero_guia);
		}

	}else
	{

	$pdf=new PDF();

	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);
	}

}

$pdf->Output($numero_guia.".pdf","D");
$pdf->Output("/tmp/".$numero_guia.".pdf","F");


*/

	


	








if($shi_codigo=='000591')
{
$pdf_file = "\/tmp\/".$numero_guia.".pdf";
$save_to = "\/imagenes\/imasan01\/guias\/paqueteria\/ar\/".$numero_guia.".jpg";
exec("gs -sDEVICE=jpeg -sPAPERSIZE=halfletter -dSAFER -r800x700 \-sOutputFile=".$save_to." ".$pdf_file);
}

?>