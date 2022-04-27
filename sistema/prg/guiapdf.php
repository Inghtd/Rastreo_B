<?php
class PDF extends FPDF
{
     public function pagina_pos1($id_referencia,$numero_guia,$i)
     {
     //require ('../class/db2.php');
     
     $fecha_my=date('Y-m-d');
     $fecha_hm=date('d    m   Y');
     $hora=date('H:i:s');
     $tiempo=time();
     $cab=new model_con();
     $producto	=$_POST['producto'];
     $datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}


$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 200, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,24,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,15,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,31,"".$origen1);
$this->text(10,35,"".$origen2);
$this->text(10,39,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,43,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
$this->text(10,47,$tel_remitente);
$this->SetFont('times','',8);
$this->text(95,43,"Recolectado por : _____________________________");
$this->text(95,47,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 50, 200, 28, 1.5, 'DF');

$this->text(10,53,"Destinatario :".$emp_destinatario);
$this->text(10,57,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,61,$destino1);
$this->text(10,65,$destino2);
$this->text(10,69,$destino3);
$this->SetFont('times','',8);
$this->text(10,73,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,77,$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80, 200, 8, 1.5, 'DF');

$this->text(10,85,"Cantidad :".$cantidad);
$this->text(30,85,"Seguro : ".$seguro);
$this->text(55,85,"Doc : ".$doc);
$this->text(110,85,"Monto : $".$monto);
$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 90, 200, 40, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,93,"Obs. :".$obs1);
$this->text(10,97,$obs2);
$this->text(10,101,$obs3);
$this->SetFont('times','',8);
$this->text(10,107,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,125,"Entregado Por :_______________________");
$this->text(140,105,"Fecha y Hora :_______________________");
$this->text(80,125,"Recibe :_____________________________");
$this->text(140,125,"Firma :_____________________________");


$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 45, array(255,255,255),array(0,0,0));
$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,7,$numero_guia,43,7);


}


     public function pagina_pos2($archivo)
     {
	//$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
	// Leemos el fichero
	$txt = utf8_decode(file_get_contents($archivo));
	// Times 12
	$this->SetFont('Times','',6);
	// Imprimimos el texto justificado
	$this->MultiCell(0,2,$txt);
	// Salto de línea
	//$this->Ln();
	// Cita en itálica
	//$this->SetFont('','I');
	//$this->Cell(0,5,'(Lo Importante Es Saber Llegar)');
     }



	function carta3copias($id_referencia,$numero_guia)
	{
	$fecha_my=date('Y-m-d');
	$fecha_hm=date('d    m   Y');
	$hora=date('H:i:s');
	$tiempo=time();
	$cab=new model_con();
	$producto	=12;
	$datos=$cab->datos_productos($producto);
	$nota	      ="test";//$datos[5];

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
	$emp_remitente		=utf8_decode($row[26]);
	$emp_destinatario	=utf8_decode($row[27]);

	if($seguro=='1')
	{
	$seguro="SI";
	}else
	{
	$seguro="NO";
	}

	}

	$origen1=substr($dir_remitente,0,150);
	$destino1=substr($dir_destinatario,0,140);
	$destino2=substr($dir_destinatario,140,150);
	$obs1=substr($observaciones,0,100);
	$obs2=substr($observaciones,100,100);
	$obs3=substr($observaciones,200,100);
	$url="https://www.urbano.com.sv/qr.php?key=";
	$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);
	$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
	$qrcode->displayFPDF($this, 162, 20, 5, array(255,255,255),array(0,0,0));
	
	
	//Pagina1
	$this->SetFont('times','',8);
	//roundrect
	$this->SetLineWidth(0.2);
	$this->SetFillColor(255,255,255);
	$this->RoundedRect(157, 5, 50, 14, 5.5, 'DF');
	//roundrect
	$this->SetLineWidth(0.2);
	$this->SetFillColor(255,255,255);
	$this->RoundedRect(7, 20, 200, 18, 1.5, 'DF');
	$this->SetFont('times','',12);
	$this->text(120,24,"# Ref :".$id_referencia);
	$this->SetFont('times','',8);
	$this->text(10,24,"Remitente :".$emp_remitente);
	$this->text(10,27,$nom_remitente);

	$this->text(10,31,"".$origen1);
	//descripcion_municipio($mun)
	$this->text(10,34,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
	$this->text(10,37,"Telefono :".$tel_remitente);
	//roundrect
	$this->SetLineWidth(0.2);
	$this->SetFillColor(255,255,255);
	$this->RoundedRect(7, 39, 200, 20, 1.5, 'DF');
	$this->text(10,42,"Destinatario :".$emp_destinatario);
	$this->text(10,45,$destinatario." ".$nom_destinatario);
	$this->SetFont('times','',7);
	$this->text(10,48,$destino1);
	$this->text(10,51,$destino2);
	$this->SetFont('times','',8);
	$this->text(10,54,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
	$this->text(10,57,"Telefono(s):".$tel_destinatario);

	//roundrect
	$this->SetLineWidth(0.2);
	$this->SetFillColor(255,255,255);
	$this->RoundedRect(7, 60, 200, 19, 1.5, 'DF');

	$this->SetFont('courier','',8);
	$this->text(10,63,"Obs. :".$obs1);
	$this->text(10,66,$obs2);
	$this->text(10,70,$obs3);
	$this->SetFont('times','',8);
	$this->text(10,78,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
	$this->text(80,78,"Recibe :_____________________________");
	$this->text(140,78,"Firma :_____________________________");

	//roundrect
	$this->SetLineWidth(0.2);
	$this->SetFillColor(255,255,255);
	$this->RoundedRect(7, 80, 200, 5, 1.5, 'DF');

	$this->text(10,83,"Cantidad :".$cantidad);
	$this->text(30,83,"Seguro : ".$seguro);
	$this->text(55,83,"Doc : ".$doc);
	$this->text(110,83,"Monto : $".$monto);
	$this->text(140,83,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

	$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
	$this->SetFont('times','',12);
$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 0, array(255,255,255),array(0,0,0));

	$this->Code128(161,7,$numero_guia,43,7);
	$this->Text(161,18,$numero_guia);

//Pagina2

$i=95;

$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 5+$i, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20+$i, 200, 18, 1.5, 'DF');
$this->SetFont('times','',12);
$this->text(120,24+$i,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
$this->text(10,24+$i,"Remitente :".$emp_remitente);
$this->text(10,27+$i,$nom_remitente);

$this->text(10,31+$i,"".$origen1);
//descripcion_municipio($mun)
$this->text(10,34+$i,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->text(10,37+$i,"Telefono :".$tel_remitente);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 39+$i, 200, 20, 1.5, 'DF');
$this->text(10,42+$i,"Destinatario :".$emp_destinatario);
$this->text(10,45+$i,$destinatario." ".$nom_destinatario);
$this->SetFont('times','',7);
$this->text(10,48+$i,$destino1);
$this->text(10,51+$i,$destino2);
$this->SetFont('times','',8);
$this->text(10,54+$i,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->text(10,57+$i,"Telefono(s):".$tel_destinatario);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 60+$i, 200, 19, 1.5, 'DF');

$this->SetFont('courier','',8);
$this->text(10,63+$i,"Obs. :".$obs1);
$this->text(10,66+$i,$obs2);
$this->text(10,70+$i,$obs3);
$this->SetFont('times','',8);
$this->text(10,78+$i,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(80,78+$i,"Recibe :_____________________________");
$this->text(140,78+$i,"Firma :_____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80+$i, 200, 5, 1.5, 'DF');

$this->text(10,83+$i,"Cantidad :".$cantidad);
$this->text(30,83+$i,"Seguro : ".$seguro);
$this->text(55,83+$i,"Doc : ".$doc);
$this->text(110,83+$i,"Monto : $".$monto);
$this->text(140,83+$i,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

$this->Image('../../images/default_r2_c2.gif',10,4+$i,35,15);
$this->SetFont('times','',12);
$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 0, array(255,255,255),array(0,0,0));
$this->Code128(161,7+$i,$numero_guia,43,7);
$this->Text(161,18+$i,$numero_guia);



//Pagina3

$i=188;

$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 5+$i, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20+$i, 200, 18, 1.5, 'DF');
$this->SetFont('times','',12);
$this->text(120,24+$i,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
$this->text(10,24+$i,"Remitente :".$emp_remitente);
$this->text(10,27+$i,$nom_remitente);

$this->text(10,31+$i,"".$origen1);
//descripcion_municipio($mun)
$this->text(10,34+$i,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->text(10,37+$i,"Telefono :".$tel_remitente);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 39+$i, 200, 20, 1.5, 'DF');
$this->text(10,42+$i,"Destinatario :".$emp_destinatario);
$this->text(10,45+$i,$destinatario." ".$nom_destinatario);
$this->SetFont('times','',7);
$this->text(10,48+$i,$destino1);
$this->text(10,51+$i,$destino2);
$this->SetFont('times','',8);
$this->text(10,54+$i,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->text(10,57+$i,"Telefono(s):".$tel_destinatario);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 60+$i, 200, 19, 1.5, 'DF');

$this->SetFont('courier','',8);
$this->text(10,63+$i,"Obs. :".$obs1);
$this->text(10,66+$i,$obs2);
$this->text(10,70+$i,$obs3);
$this->SetFont('times','',8);
$this->text(10,78+$i,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(80,78+$i,"Recibe :_____________________________");
$this->text(140,78+$i,"Firma :_____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80+$i, 200, 5, 1.5, 'DF');

$this->text(10,83+$i,"Cantidad :".$cantidad);
$this->text(30,83+$i,"Seguro : ".$seguro);
$this->text(55,83+$i,"Doc : ".$doc);
$this->text(110,83+$i,"Monto : $".$monto);
$this->text(140,83+$i,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

$this->Image('../../images/default_r2_c2.gif',10,4+$i,35,15);
$this->SetFont('times','',12);
$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 0, array(255,255,255),array(0,0,0));
$this->Code128(161,7+$i,$numero_guia,43,7);
$this->Text(161,18+$i,$numero_guia);







	}



	
function genera_ccf($gui,$ref)
{
include('model/model_con.php');
include('numeros.php');

$fecha_my=date('Y-m-d');
$fecha_hm=date('d    m   Y');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	=$_POST['producto'];
$datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

$num= new numeros();


$valor_texto=$num->numero_texto($monto);



echo $valor_texto;







}

public function guia_carta_2_copias($id_referencia,$numero_guia,$guia_facturacion)
{

$fecha_my=date('Y-m-d');
$fecha_hm=date('dmY');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	=$_POST['producto'];
$datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

//Pagina 1

$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 200, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,24,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,15,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,31,"".$origen1);
$this->text(10,35,"".$origen2);
$this->text(10,39,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,43,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
$this->text(10,47,$tel_remitente);
$this->SetFont('times','',8);
$this->text(95,43,"Recolectado por : _____________________________");
$this->text(95,47,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 50, 200, 28, 1.5, 'DF');

$this->text(10,53,"Destinatario :".$emp_destinatario);
$this->text(10,57,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,61,$destino1);
$this->text(10,65,$destino2);
$this->text(10,69,$destino3);
$this->SetFont('times','',8);
$this->text(10,73,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,77,$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80, 200, 8, 1.5, 'DF');

$this->text(10,85,"Cantidad :".$cantidad);
$this->text(30,85,"Seguro : ".$seguro);
$this->text(55,85,"Doc : ".$doc);
$this->text(110,85,"Monto : $".$monto);
$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 90, 200, 40, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,93,"Obs. :".$obs1);
$this->text(10,97,$obs2);
$this->text(10,101,$obs3);
$this->SetFont('times','',8);
$this->text(10,107,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,125,"Entregado Por :_______________________");
$this->text(140,105,"Fecha y Hora :_______________________");
$this->text(80,125,"Recibe :_____________________________");
$this->text(140,125,"Firma :_____________________________");
$this->text(10,129,"Guia Facturacion :".$guia_facturacion);


$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 45, array(255,255,255),array(0,0,0));
$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,7,$numero_guia,43,7);

//fin pagina 1





//pagina 2

$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 155, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 170, 200, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,175,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,165,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,175,"Remitente :".$emp_remitente);
$this->text(10,178,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,182,"".$origen1);
$this->text(10,186,"".$origen2);
$this->text(10,191,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,193,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
$this->text(10,197,$tel_remitente);
$this->SetFont('times','',8);
$this->text(95,193,"Recolectado por : _____________________________");
$this->text(95,197,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 200, 200, 28, 1.5, 'DF');

$this->text(10,203,"Destinatario :".$emp_destinatario);
$this->text(10,207,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,211,$destino1);
$this->text(10,215,$destino2);
$this->text(10,220,$destino3);
$this->SetFont('times','',8);
$this->text(10,223,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,227,$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 230, 200, 8, 1.5, 'DF');

$this->text(10,235,"Cantidad :".$cantidad);
$this->text(30,235,"Seguro : ".$seguro);
$this->text(55,235,"Doc : ".$doc);
$this->text(110,235,"Monto : $".$monto);
$this->text(140,235,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 240, 200, 41, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,243,"Obs. :".$obs1);
$this->text(10,247,$obs2);
$this->text(10,251,$obs3);
$this->SetFont('times','',8);
$this->text(10,257,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,275,"Entregado Por :_______________________");
$this->text(140,255,"Fecha y Hora :_______________________");
$this->text(80,277,"Recibe :_____________________________");
$this->text(140,277,"Firma :_____________________________");
$this->text(10,281,"Guia Facturacion :".$guia_facturacion);

$this->Image('../../images/default_r2_c2.gif',10,154,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 170, 45, array(255,255,255),array(0,0,0));
$this->Text(161,168,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,156,$numero_guia,43,7);


}

public function carta_2_copias($id_referencia,$numero_guia)
{

$fecha_my=date('Y-m-d');
$fecha_hm=date('dmY');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	=$_POST['producto'];
$datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

//Pagina 1
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 200, 25, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,24,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,15,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,30,"".$origen1);
$this->text(10,34,"".$origen2);
$this->text(10,38,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,41,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
$this->text(10,44,$tel_remitente);
$this->SetFont('times','',8);
$this->text(10,44,"Recolectado por : _____________________________");
$this->text(95,44,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 46, 200, 22, 1.5, 'DF');

$this->text(10,49,"Destinatario :".$emp_destinatario);
$this->text(10,52,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,54,"dir1".$destino1);
$this->text(10,57,"dir1".$destino2);
$this->text(10,60,"dir1".$destino3);
$this->SetFont('times','',8);
$this->text(10,63,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,66,"Tel:".$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 69, 200, 5, 1.5, 'DF');

$this->text(10,72,"Cantidad :".$cantidad);
$this->text(30,72,"Seguro : ".$seguro);
$this->text(55,72,"Doc : ".$doc);
$this->text(110,72,"Monto : $".$monto);
$this->text(140,72,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 75, 200,40, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,78,"Obs. :".$obs1);
$this->text(10,82,$obs2);
$this->text(10,86,$obs3);
$this->SetFont('times','',8);
$this->text(10,100,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,104,"Entregado Por :_______________________");
$this->text(140,104,"Fecha y Hora :_______________________");
$this->text(80,104,"Recibe :_____________________________");
$this->text(140,104,"Firma :_____________________________");
//$this->text(10,108,"Guia Facturacion :".$guia_facturacion);


$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 45, array(255,255,255),array(0,0,0));
$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,7,$numero_guia,43,7);

//fin pagina 1





//pagina 2

$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 155, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 170, 200, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,175,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,165,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,175,"Remitente :".$emp_remitente);
$this->text(10,178,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,182,"".$origen1);
$this->text(10,186,"".$origen2);
$this->text(10,191,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,193,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
$this->text(10,197,$tel_remitente);
$this->SetFont('times','',8);
$this->text(95,193,"Recolectado por : _____________________________");
$this->text(95,197,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 200, 200, 28, 1.5, 'DF');

$this->text(10,203,"Destinatario :".$emp_destinatario);
$this->text(10,207,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,211,$destino1);
$this->text(10,215,$destino2);
$this->text(10,220,$destino3);
$this->SetFont('times','',8);
$this->text(10,223,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,227,$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 230, 200, 8, 1.5, 'DF');

$this->text(10,235,"Cantidad :".$cantidad);
$this->text(30,235,"Seguro : ".$seguro);
$this->text(55,235,"Doc : ".$doc);
$this->text(110,235,"Monto : $".$monto);
$this->text(140,235,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 240, 200, 41, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,243,"Obs. :".$obs1);
$this->text(10,247,$obs2);
$this->text(10,251,$obs3);
$this->SetFont('times','',8);
$this->text(10,257,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,275,"Entregado Por :_______________________");
$this->text(140,255,"Fecha y Hora :_______________________");
$this->text(80,277,"Recibe :_____________________________");
$this->text(140,277,"Firma :_____________________________");
//$this->text(10,281,"Guia Facturacion :".$guia_facturacion);

$this->Image('../../images/default_r2_c2.gif',10,154,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 170, 45, array(255,255,255),array(0,0,0));
$this->Text(161,168,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,156,$numero_guia,43,7);


}

public function carta_2_copiasb($id_referencia,$numero_guia)
{

$fecha_my=date('Y-m-d');
$fecha_hm=date('dmY');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	=$_POST['producto'];
$datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

//Pagina 1
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 200, 25, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,24,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,15,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,30,"".$origen1);
$this->text(10,34,"".$origen2);
$this->text(10,38,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,41,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
//$this->text(10,44,$tel_remitente);
$this->SetFont('times','',8);
$this->text(10,44,"Recolectado por : _____________________________");
$this->text(95,44,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 46, 200, 22, 1.5, 'DF');

$this->text(10,49,"Destinatario :".$emp_destinatario);
$this->text(10,52,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,54,"dir1".$destino1);
$this->text(10,57,"dir1".$destino2);
$this->text(10,60,"dir1".$destino3);
$this->SetFont('times','',8);
$this->text(10,63,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,66,"Tel:".$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 69, 200, 5, 1.5, 'DF');

$this->text(10,72,"Cantidad :".$cantidad);
$this->text(30,72,"Seguro : ".$seguro);
$this->text(55,72,"Doc : ".$doc);
$this->text(110,72,"Monto : $".$monto);
$this->text(140,72,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 75, 200,40, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,78,"Obs. :".$obs1);
$this->text(10,82,$obs2);
$this->text(10,86,$obs3);
$this->SetFont('times','',8);
$this->text(10,96,$tel_remitente);
$this->text(10,100,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,104,"Entregado Por :_______________________");
$this->text(140,104,"Fecha y Hora :_______________________");
$this->text(80,104,"Recibe :_____________________________");
$this->text(140,104,"Firma :_____________________________");
$this->text(10,110,"ENTREGA DE PAQUETE ABIERTO SI_______    NO_______");


$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 20, 45, array(255,255,255),array(0,0,0));
$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,7,$numero_guia,43,7);

//fin pagina 1





//pagina 2

$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(157, 155, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 170, 200, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('times','',12);
$this->text(120,175,"# Ref :".$id_referencia);
$this->SetFont('times','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('times','',12);
$this->text(90,165,$datos[5]);
$this->SetFont('times','',8);

$this->text(10,175,"Remitente :".$emp_remitente);
$this->text(10,178,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,182,"".$origen1);
$this->text(10,186,"".$origen2);
$this->text(10,191,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,193,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('times','',6);
$this->text(10,197,$tel_remitente);
$this->SetFont('times','',8);
$this->text(95,193,"Recolectado por : _____________________________");
$this->text(95,197,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 200, 200, 28, 1.5, 'DF');

$this->text(10,203,"Destinatario :".$emp_destinatario);
$this->text(10,207,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('times','',7);
$this->text(10,211,$destino1);
$this->text(10,215,$destino2);
$this->text(10,220,$destino3);
$this->SetFont('times','',8);
$this->text(10,223,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('times','',6);
$this->text(10,227,$tel_destinatario);
$this->SetFont('times','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 230, 200, 8, 1.5, 'DF');

$this->text(10,235,"Cantidad :".$cantidad);
$this->text(30,235,"Seguro : ".$seguro);
$this->text(55,235,"Doc : ".$doc);
$this->text(110,235,"Monto : $".$monto);
$this->text(140,235,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 240, 200, 41, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,243,"Obs. :".$obs1);
$this->text(10,247,$obs2);
$this->SetFont('times','',8);
$this->text(10,251,$tel_remitente);


$this->text(10,257,"Fecha  Envio :".$fecha_envio."      Peso(s): _______________________________________");
$this->text(10,275,"Entregado Por :_______________________");
$this->text(140,255,"Fecha y Hora :_______________________");
$this->text(80,277,"Recibe :_____________________________");
$this->text(140,277,"Firma :_____________________________");
$this->text(10,281,"ENTREGA DE PAQUETE ABIERTO SI_______    NO_______");
//$this->text(10,281,"Guia Facturacion :".$guia_facturacion);

$this->Image('../../images/default_r2_c2.gif',10,154,35,15);
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('times','',12);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

$qrcode = new QRcode($llave_url, 'H'); // error level : L, M, Q, H
$qrcode->displayFPDF($this, 162, 170, 45, array(255,255,255),array(0,0,0));
$this->Text(161,168,utf8_decode("Guía ").$numero_guia);
$this->Code128(161,156,$numero_guia,43,7);


}


public function guia_txt($id_referencia,$numero_guia)
{
// ini_set ("display_errors","1" );
// error_reporting(E_ALL);

header ("Content-Disposition: attachment; filename=\"".$numero_guia.".txt\"" );
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");
include('model/model_con.php');

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

$relleno=' ';
//comienza la generacion del txt
//creamos el archivo
$nuevo_archivo=fopen("/tmp/".$numero_guia.".txt","w");
$linea="";
$linea.=sprintf("%-200s","     Urbano - Lo importante es Saber LLegar")."\r\n";
$linea.=sprintf("%-200s","                                                      Guia :       ".$numero_guia)."\r\n";
$linea.=sprintf("%-200s","                                                      Referencia : ".$id_referencia)."\r\n";
$linea.=sprintf("%-200s","______________________________________________________________________________")."\r\n";
$linea.=sprintf("%-7s",":: ".$remitente." ".$nom_remitente)."\r\n";
$linea.=sprintf("%-7s",":: ".$dir_remitente)."\r\n";
$linea.=sprintf("%-7s",":: ".$cab->descripcion_municipio($cod_municipio_ori))."\r\n";
$linea.=sprintf("%-7s",":: ".$tel_remitente)."\r\n";
$linea.=sprintf("%-200s","------------------------------------------------------------------------------")."\r\n";
$linea.=sprintf("%-7s",":: ".$destinatario.$emp_destinatario)."\r\n";
$linea.=sprintf("%-7s",":: ".$nom_destinatario)."\r\n";
$linea.=sprintf("%-7s",":: ".$dir_destinatario)."\r\n";
$linea.=sprintf("%-7s",":: ".$cab->descripcion_municipio($cod_municipio_des))."\r\n";
$linea.=sprintf("%-7s",":: ".$tel_destinatario)."\r\n";
$linea.=sprintf("%-200s","_______________________________________________________________________________")."\r\n";
$linea.=sprintf("%-200s",":: Cantidad : ".$cantidad." - Seguro : ".$seguro."  - Monto: ".$monto." - Tipo :".$tipo_envio)."\r\n";
$linea.=sprintf("%-200s","_______________________________________________________________________________")."\r\n";
$linea.=sprintf("%-200s",":: Obs . :".$observaciones)."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s",":: Fecha :".$fecha_envio)."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s","::")."\r\n";
$linea.=sprintf("%-200s",":: Firma_______________________  Firma:______________________")."\r\n";
$linea.=sprintf("%-200s","_______________________________________________________________________________")."\r\n";
$escribiendo=fwrite($nuevo_archivo,$linea);
echo $linea;

fclose ($nuevo_archivo);

}



public function guia_txt2($id_referencia,$numero_guia)
{
// ini_set ("display_errors","1" );
// error_reporting(E_ALL);


$fecha_my=date('Y-m-d');
$fecha_hm=date('d    m   Y');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	='SE';
$datos=$cab->datos_productos($producto);
$nota	      ="";//$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}


$this->SetFont('courier','',10);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
//$this->RoundedRect(157, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 200, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('courier','',10);
$this->text(10,10,"Urbano");
$this->text(120,24,"# Ref :".$id_referencia);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->text(90,15,"Nota");//$datos[5]);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,31,"".$origen1);
$this->text(10,35,"".$origen2);
$this->text(10,39,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,43,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));

$this->text(10,47,$tel_remitente);
$this->text(95,43,"Recolectado por : _____________________________");
$this->text(95,47,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 50, 200, 28, 1.5, 'DF');

$this->text(10,53,"Destinatario :".$emp_destinatario);
$this->text(10,57,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,90);
$destino2=substr($dir_destinatario,90,90);
$destino3=substr($dir_destinatario,180,90);
$this->text(10,61,$destino1);
$this->text(10,65,$destino2);
$this->text(10,69,$destino3);
$this->text(10,73,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));

$this->text(10,77,$tel_destinatario);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80, 200, 8, 1.5, 'DF');

$this->text(10,85,"Cantidad :".$cantidad);
$this->text(40,85,"Seguro : ".$seguro);
$this->text(65,85,"Doc : ".$doc);
$this->text(110,85,"Monto : $".$monto);
$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 90, 200, 40, 1.5, 'DF');


$obs1=substr($observaciones,0,80);
$obs2=substr($observaciones,80,90);
$obs3=substr($observaciones,170,90);

$this->text(10,93,"Obs. :".$obs1);
$this->text(10,97,$obs2);
$this->text(10,101,$obs3);

$this->text(10,107,"Fecha  Envio :".$fecha_envio."      Peso(s): __________________");
$this->text(10,125,"Entregado Por :_________________");
$this->text(140,105,"Fecha y Hora :_________________");
$this->text(80,125,"Recibe :___________________");
$this->text(140,125,"Firma :___________________");
$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
//$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
//$this->code128(161,7,"test",43,7);

}

public function guia_matricial1($id_referencia,$numero_guia)
{
// ini_set ("display_errors","1" );
// error_reporting(E_ALL);


$fecha_my=date('Y-m-d');
$fecha_hm=date('d    m   Y');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	='SE';
$datos=$cab->datos_productos($producto);
$nota	      ="";//$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

$i=1;
$this->SetFont('arial','',11);

$this->Text(150,17+$i,utf8_decode("Guía :").$numero_guia);
$this->text(120,27+$i,"# Ref :".$id_referencia);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

//$this->text(90,15,"-");//$datos[5]);

//$this->text(10,27+$i,"Empresa : ".$emp_remitente);
$this->text(10,30+$i,$remitente.$nom_remitente);

$origen1=substr($dir_remitente,0,80);
$origen2=substr($dir_remitente,80,160);
$origen3=substr($dir_remitente,160,80);


$this->text(10,34+$i,"".$origen1);
$this->text(10,38+$i,"".$origen2);
$this->text(10,42+$i,"".$origen3);
$this->text(10,46+$i,$tel_remitente);
$this->text(10,50+$i,$cab->descripcion_municipio($cod_municipio_ori));
$this->text(110,50+$i,$fecha_envio." ".$hora);

$this->text(10,60+$i,$emp_destinatario);
$this->text(10,64+$i,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,80);
$destino2=substr($dir_destinatario,80,80);
$destino3=substr($dir_destinatario,160,80);
$this->text(10,68+$i,$destino1);
$this->text(10,72+$i,$destino2);
$this->text(10,76+$i,$destino3);
$this->text(10,80+$i,$cab->descripcion_municipio($cod_municipio_des));

$this->text(10,84+$i,$tel_destinatario);

//$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

$obs1=substr($observaciones,0,45);
$obs2=substr($observaciones,45,45);
$obs3=substr($observaciones,90,45);
$obs4=substr($observaciones,135,45);
$obs5=substr($observaciones,180,45);
$obs6=substr($observaciones,225,45);


$this->text(55,103+$i,$obs1);
$this->text(55,107+$i,$obs2);
$this->text(55,111+$i,$obs3);
$this->text(55,115+$i,$obs4);
$this->text(55,119+$i,$obs5);
$this->text(55,123+$i,$obs6);

$this->text(10,104+$i,$cantidad);
if($seguro=='SI')
{
$this->text(20,125+$i,"X");
}else
{
$this->text(51,125+$i,"X");
}
$this->text(80,125+$i,"$".$monto);
$this->text(130,125+$i,$doc);

//$this->code128(141,7,$numero_guia,43,7);

}

public function guia_matricial3b($id_referencia,$numero_guia)
{
// ini_set ("display_errors","1" );
// error_reporting(E_ALL);


$fecha_my=date('Y-m-d');
$fecha_hm=date('d    m   Y');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$producto	='SE';
$datos=$cab->datos_productos($producto);
$nota	      ="";//$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}


$this->SetFont('arial','',10);

$this->Text(155,13,utf8_decode("Guía :").$numero_guia);
$this->text(120,24,"# Ref :".$id_referencia);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

//$this->text(90,15,"-");//$datos[5]);

$this->text(10,24,$emp_remitente);
$this->text(10,27,$remitente.$nom_remitente);

$origen1=substr($dir_remitente,0,80);
$origen2=substr($dir_remitente,80,160);
$origen3=substr($dir_remitente,160,80);


$this->text(10,31,"".$origen1);
$this->text(10,35,"".$origen2);
$this->text(10,39,"".$origen3);
$this->text(10,43,$tel_remitente);
$this->text(10,47,$cab->descripcion_municipio($cod_municipio_ori));

$this->text(10,57,$emp_destinatario);
$this->text(10,61,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,80);
$destino2=substr($dir_destinatario,80,80);
$destino3=substr($dir_destinatario,160,80);
$this->text(10,65,$destino1);
$this->text(10,69,$destino2);
$this->text(10,73,$destino3);
$this->text(10,77,$cab->descripcion_municipio($cod_municipio_des));

$this->text(10,81,$tel_destinatario);

//$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

$obs1=substr($observaciones,0,45);
$obs2=substr($observaciones,45,45);
$obs3=substr($observaciones,90,45);
$obs4=substr($observaciones,135,45);
$obs5=substr($observaciones,180,45);
$obs6=substr($observaciones,225,45);


$this->text(55,99,$obs1);
$this->text(55,103,$obs2);
$this->text(55,107,$obs3);
$this->text(55,111,$obs4);
$this->text(55,115,$obs5);
$this->text(55,119,$obs6);

$this->text(10,100,$cantidad);
if($seguro=='SI')
{
$this->text(20,122,"X");
}else
{
$this->text(51,122,"X");
}
$this->text(80,122,"$".$monto);
$this->text(130,122,$doc);

//$this->code128(141,7,$numero_guia,43,7);

}

public function guia_matricial3($id_referencia,$numero_guia)
{
     //require ('../class/db2.php');
     
     $fecha_my=date('Y-m-d');
     $fecha_hm=date('d    m   Y');
     $hora=date('H:i:s');
     $tiempo=time();
     $cab=new model_con();
     $producto	=$_POST['producto'];
     $datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}


/*$this->SetFont('courier','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(70, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 180, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('courier','',12);
$this->text(120,24,"# Ref :".$id_referencia);
$this->SetFont('courier','',8);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('courier','',12);
$this->text(90,15,$datos[5]);
$this->SetFont('courier','',8);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,31,"".$origen1);
$this->text(10,35,"".$origen2);
$this->text(10,39,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,43,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('courier','',6);
$this->text(10,47,$tel_remitente);
$this->SetFont('courier','',8);
$this->text(95,43,"Recolectado por : _____________________________");
$this->text(95,47,"Fecha y Hora : _____________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 50, 180, 28, 1.5, 'DF');

$this->text(10,53,"Destinatario :".$emp_destinatario);
$this->text(10,57,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('courier','',7);
$this->text(10,61,$destino1);
$this->text(10,65,$destino2);
$this->text(10,69,$destino3);
$this->SetFont('courier','',8);
$this->text(10,73,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('courier','',6);
$this->text(10,77,$tel_destinatario);
$this->SetFont('courier','',8);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80, 180, 8, 1.5, 'DF');

$this->text(10,85,"Cantidad :".$cantidad);
$this->text(30,85,"Seguro : ".$seguro);
$this->text(55,85,"Doc : ".$doc);
$this->text(110,85,"Monto : $".$monto);
$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 90, 180, 40, 1.5, 'DF');

$this->SetFont('courier','',8);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,93,"Obs. :".$obs1);
$this->text(10,97,$obs2);
$this->text(10,101,$obs3);
$this->SetFont('courier','',8);
$this->text(10,107,"Fecha  Envio :".$fecha_envio."      Peso(s): __________________________");
$this->text(10,125,"Entregado Por :_______________________");
$this->text(120,105,"Fecha y Hora :_______________________");
$this->text(60,125,"Recibe :__________________________");
$this->text(120,125,"Firma :_____________________________");


//$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
$this->text(10,7,"URBANO");
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('courier','',18);

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);

*/
//$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
/*
$this->SetFillColor(0,0,0);
$this->Code128(10,7,$numero_guia,50,7);
$this->Code128(10,17,$numero_guia,60,7);
$this->Code128(10,27,$numero_guia,70,7);
$this->Code128(10,37,$numero_guia,80,7);
$this->Code128(10,47,$numero_guia,90,7);
$this->Code128(10,57,$numero_guia,100,7);
$this->Code128(10,67,$numero_guia,110,7);
$this->Code128(10,77,$numero_guia,120,7);
$this->Code128(10,87,$numero_guia,130,7);
$this->Code128(10,97,$numero_guia,140,7);
$this->Code128(10,107,$numero_guia,150,7);
*/

$code=$numero_guia;
$xpos=10;
$ypos=10;

$this->Code39($xpos, $ypos, $code, $baseline=0.5, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=0.6, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=0.7, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=0.8, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=0.9, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=1.0, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=1.1, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=1.2, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=1.3, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=1.4, $height=8);
$ypos=$ypos+10;
$this->Code39($xpos, $ypos, $code, $baseline=1.5, $height=8);
$ypos=$ypos+10;










$this->Text(75,18,utf8_decode("Guía ").$numero_guia);

}

public function guia_matricial2($id_referencia,$numero_guia)
{
     //require ('../class/db2.php');
     
     $fecha_my=date('Y-m-d');
     $fecha_hm=date('d    m   Y');
     $hora=date('H:i:s');
     $tiempo=time();
     $cab=new model_con();
     $producto	=$_POST['producto'];
     $datos=$cab->datos_productos($producto);
$nota	      =$datos[5];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}


$this->SetFont('arial','',10);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(70, 5, 50, 14, 5.5, 'DF');
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 20, 180, 28, 1.5, 'DF');
//$x, $y, $w, $h, $r, $style = ''
$this->SetFont('arial','',12);
$this->text(120,24,"# Ref :".$id_referencia);
$this->SetFont('arial','',10);
//$this->text(120,27,"Tipo Envio :".$tipo_envio);

$this->SetFont('arial','',12);
$this->text(90,15,$datos[5]);
$this->SetFont('arial','',10);

$this->text(10,24,"Remitente :".$emp_remitente);
$this->text(10,27,$remitente." ".$nom_remitente);

$origen1=substr($dir_remitente,0,100);
$origen2=substr($dir_remitente,100,100);
$origen3=substr($dir_remitente,200,100);


$this->text(10,31,"".$origen1);
$this->text(10,35,"".$origen2);
$this->text(10,39,"".$origen3);
//descripcion_municipio($mun)
$this->text(10,43,"Municipio : ".$cab->descripcion_municipio($cod_municipio_ori));
$this->SetFont('arial','',10);
$this->text(10,47,$tel_remitente);
$this->SetFont('arial','',10);
$this->text(95,43,"Recolectado por : ________________________");
$this->text(95,47,"Fecha y Hora : ________________________");

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 50, 180, 28, 1.5, 'DF');

$this->text(10,53,"Destinatario :".$emp_destinatario);
$this->text(10,57,$destinatario." ".$nom_destinatario);

$destino1=substr($dir_destinatario,0,100);
$destino2=substr($dir_destinatario,100,100);
$destino3=substr($dir_destinatario,200,100);
$this->SetFont('arial','',10);
$this->text(10,61,$destino1);
$this->text(10,65,$destino2);
$this->text(10,69,$destino3);
$this->SetFont('arial','',10);
$this->text(10,73,"Municipio : ".$cab->descripcion_municipio($cod_municipio_des));
$this->SetFont('arial','',10);
$this->text(10,77,$tel_destinatario);
$this->SetFont('arial','',10);
//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 80, 180, 8, 1.5, 'DF');

$this->text(10,85,"Cantidad :".$cantidad);
$this->text(40,85,"Seguro : ".$seguro);
$this->text(65,85,"Doc : ".$doc);
$this->text(110,85,"Monto : $".$monto);
$this->text(140,85,"Tipo : ".$tipo." ".$tipo_envio." ".$producto);

//roundrect
$this->SetLineWidth(0.2);
$this->SetFillColor(255,255,255);
$this->RoundedRect(7, 90, 180, 40, 1.5, 'DF');

$this->SetFont('arial','',10);
$obs1=substr($observaciones,0,100);
$obs2=substr($observaciones,100,100);
$obs3=substr($observaciones,200,100);

$this->text(10,93,"Obs. :".$obs1);
$this->text(10,97,$obs2);
$this->text(10,101,$obs3);
$this->SetFont('arial','',10);
$this->text(10,107,"Fecha  Envio :".$fecha_envio."      Peso(s): __________________________");
$this->text(10,125,"Entregado Por :_______________________");
$this->text(120,105,"Fecha y Hora :_________________");
$this->text(60,125,"Recibe :__________________________");
$this->text(120,125,"Firma :________________________");


//$this->Image('../../images/default_r2_c2.gif',10,4,35,15);
//$this->text(10,7,"URBANO");
//$pdf->Image('imgs/logo.jpg',10,4,25,10);
$this->SetFont('arial','',25);
$this->text(10,15,"URBANO");

$url="https://www.urbano.com.sv/qr.php?key=";
$llave_url=$url.$cab->genera_llave($id_referencia,$numero_guia);


//$this->Text(161,18,utf8_decode("Guía ").$numero_guia);
$this->SetFillColor(0,0,0);
//$this->Code128(141,7,$numero_guia,43,7);

$this->Text(75,18,$numero_guia);

}


public function ccf_matricial1($id_referencia,$numero_guia)
{
// ini_set ("display_errors","1" );
// error_reporting(E_ALL);

include('numeros.php');
$fecha_my=date('Y-m-d');
$fecha_hm=date('d    m   Y');
$hora=date('H:i:s');
$tiempo=time();
$cab=new model_con();
$num=new numeros();

$shi_codigo=$_SESSION['shi_codigo'];

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
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}


$datos_fiscales=$cab->select_datos_fiscales($barra);

$id_registro       =$datos_fiscales[0];
$barra             =$datos_fiscales[1];
$guia_facturacion  =$datos_fiscales[2];
$destinatario	   =$datos_fiscales[3];
$registro          =$datos_fiscales[4];
$nit               =$datos_fiscales[5];
$giro              =$datos_fiscales[6];
$tipo_doc          =$datos_fiscales[7];

setlocale(LC_MONETARY, 'en_US');
$monto_formato=money_format('%(#3n', $monto);
$monto_texto=$num->numero_texto($monto);
$venta_afecta_sin_iva1=($monto/1.13);

$decimal=explode(".",$monto);

$decimales=str_pad($decimal[1], 2, "0", STR_PAD_RIGHT);



$venta_afecta_sin_iva=money_format('%(#3n',($monto/1.13));
$iva=money_format('%(#3n',($monto-$venta_afecta_sin_iva1));
$monto=money_format('%(#3n',$monto);


if($decimales==0)
{
$texto_decimales= " EXACTOS";

}else
{
$texto_decimales= " CON ".$decimales." /00 CENTAVOS";

}

if(($tipo_doc=='FAC')or($tipo_doc=='FEX'))
{
$venta_afecta_sin_iva=$monto;
$iva="";
}




$obs1=substr($observaciones,0,60);
$obs2=substr($observaciones,60,60);
$obs3=substr($observaciones,120,60);
$obs4=substr($observaciones,180,60);



$dir1=substr($dir_destinatario,0,50);

/*
$this->SetFont('courier','',10);
$this->text(27,1,$fecha_envio);
$this->text(27,3,$shi_codigo);
$this->text(27,6,$destinatario.$nom_destinatario);
$this->text(27,9,$dir1);
$this->text(27,12,$registro);
$this->text(85,12,$giro);



$this->text(9,52,"COBRO POR ENVIO :");
$this->text(9,55,$obs1);
$this->text(9,58,$obs2);
$this->text(9,65,$obs3);
$this->text(9,70,$obs4);


$this->text(191,52,$venta_afecta_sin_iva);
$this->text(191,138,$venta_afecta_sin_iva);
$this->text(191,141,$iva);
$this->text(13,140,$monto_texto." DOLARES ".$texto_decimales);



$this->text(191,167,$monto_formato);
*/
$i=6;
$this->SetFont('courier','',10);
$this->text(27+$i,28,$fecha_envio);
$this->text(27+$i,32,$shi_codigo);
$this->text(27+$i,36,$destinatario.$nom_destinatario);
$this->text(27+$i,40,$dir1);
$this->text(27+$i,44,$registro);
$this->text(85+$i,44,$giro);



$this->text(9+$i,88,"COBRO POR ENVIO :");
$this->text(9+$i,93,$obs1);
$this->text(9+$i,98,$obs2);
$this->text(9+$i,103,$obs3);
$this->text(9+$i,108,$obs4);


$this->text(189+$i,88,$venta_afecta_sin_iva);
$this->text(189+$i,172,$venta_afecta_sin_iva);
$this->text(189+$i,176,$iva);
$this->text(13+$i,172,$monto_texto." DOLARES ".$texto_decimales);



$this->text(189+$i,199,$monto_formato);






}


}

?>