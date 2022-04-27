<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);>
include('../model/model_con.php');
require('../lib/fpdf16/fpdf.php');


//$vineta="100028";
$vineta = $_GET['v'];
$cab=new model_con();
$pdf = new FPDF('P','mm','Letter');

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
//$pdf->Cell(40,10,'Hello World!');
$pdf->SetFont('times','',8);
//ACUSE 1
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 10, 198, 14, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 25, 198, 29, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 55, 198, 80, 1.5, 'DF');

//ACUSE 2
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 145, 198, 14, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 160, 198, 29, 1.5, 'DF');
//roundrect
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(255,255,255);
$pdf->RoundedRect(7, 190, 198, 80, 1.5, 'DF');

//Logo
$pdf->Image('../vista/imgs/bam.png',10,12,12,10);
$pdf->Image('../vista/imgs/bam.png',10,147,12,10);

//Encabezados
$pdf->SetFillColor(0,0,0);
$pdf->Code128(151,12,$vineta,43,9);
$pdf->Code128(151,147,$vineta,43,9);
$pdf->SetFont('Arial','B',16);
$pdf->SetFont('times','',14);
$pdf->Text(30,18,'VOUCHER DE ENCOMIENDA');
$pdf->Text(30,153,'VOUCHER DE ENCOMIENDA');

//Textos 1
$pdf->SetFont('Arial','B',16);
$pdf->SetFont('times','',11);
$pdf->Text(10,31,'Trasaccion: ');
$pdf->Text(10,37,'Remitente: ');
$pdf->Text(10,43,'Depto: ');
//$pdf->Text(10,49,'Direccion: ');
$pdf->Text(130,31,'Fecha y hora: ');
//$pdf->Text(130,37,'Nivel/Extension: ');
//$pdf->Text(130,43,': ');
//
$pdf->Text(10,166,'Trasaccion: ');
$pdf->Text(10,172,'Remitente: ');
$pdf->Text(10,178,'Depto: ');
//$pdf->Text(10,184,'Direccion: ');
$pdf->Text(130,166,'Fecha y hora: ');
//$pdf->Text(130,172,'Nivel/Extension: ');
//$pdf->Text(130,178,': ');

//Textos 2
$pdf->Text(10,62,'Destinatario: ');
$pdf->Text(10,68,'Prioridad: ');
$pdf->Text(10,75,'Agencia o edificio:');
$pdf->Text(10,82,'Direccion: ');
$pdf->Text(10,89,'Descripcion de la encomienda: ');
//$pdf->Text(130,62,'Zona: ');
//$pdf->Text(130,68,'Tipo de gestion: ');
//
$pdf->Text(10,198,'Destinatario: ');
$pdf->Text(10,205,'Prioridad: ');
$pdf->Text(10,212,'Agencia o edificio: ');
$pdf->Text(10,219,'Direccion: ');
$pdf->Text(10,226,'Descripcion de la encomienda: ');
//$pdf->Text(130,198  ,'Zona: ');
//$pdf->Text(130,205,'Tipo de gestion: ');

//Llenando Variables
$stmt=$cab->data_acuse2($vineta);

//prioridad
//Fecha y Hora



while ($row=$stmt->fetch(PDO::FETCH_NUM))
{
    $barra=$row[0];
    $tipo_envio=$row[1];
    $nombre_destinatario=utf8_decode($row[2]);
    $ccosto=$row[3];
    $nombre_ccosto=utf8_decode($row[4]);
    $direccion=utf8_decode($row[5]);
    $agencia=utf8_decode($row[6]);
    $descripcion=utf8_decode($row[7]);
    $categoria=$row[8];
}


$stmt1=$cab->data_acuse($vineta);

while ($row1=$stmt1->fetch(PDO::FETCH_NUM))
{
    $ori_ccosto     =$row1[1];
    $age_ori        =$row1[2];
    $ori_ccosto_nombre=utf8_decode($row1[3]);
    $des_ccosto     =$row1[4];
    $age_des        =$row1[5];
    $usr_ori        =utf8_decode($row1[7]);
    $ccDirOri       =utf8_decode($row1[14]);
    $fecha_datetime =$row1[8];
}
$ajuste=(60*60*6);

$tiempo=explode(" ",$fecha_datetime);


if($categoria==1)
{
    $cat="Restringido";
}
elseif($categoria==2)
{
    $cat="Delicado";
}
elseif($categoria==3)
{
    $cat="Privado";
}
elseif($categoria==4)
{
    $cat="Normal";
}


$fechat=strtotime($fecha_datetime)-$ajuste;

$datet=date("d-m-Y H:i:s",$fechat);

//Comepletando informacion
$pdf->Text(30,31,$vineta);
$pdf->Text(30,37,$usr_ori);
$pdf->Text(30,43,$ori_ccosto_nombre);
$pdf->Text(30,49,$ccDirOri);
$pdf->Text(160,31,$datet);
$pdf->Text(160,37,'');
$pdf->Text(160,43,'');
//
$pdf->Text(30,166,$vineta);
$pdf->Text(30,172,$usr_ori);
$pdf->Text(30,178,$ori_ccosto_nombre);
$pdf->Text(30,184,$ccDirOri);
$pdf->Text(160,166,$datet);
$pdf->Text(160,172,'');
$pdf->Text(160,178,'');

$pdf->Text(30,62,$nombre_destinatario);
$pdf->Text(30,68,$cat);
$pdf->Text(50,75,$agencia);
$pdf->Text(30,82,$direccion);
//$pdf->Text(60,89,$descripcion);
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetXY($x + 49, $y + 75);

$pdf->MultiCell(145,5,$descripcion,0,'J',false);


$pdf->Text(160,62,'');
$pdf->Text(160,68,'');

$pdf->Text(30,198,$nombre_destinatario);
$pdf->Text(30,205,$cat);
$pdf->Text(50,212,$agencia);
$pdf->Text(30,219,$direccion);
//$pdf->Text(60,226,$descripcion);
$x = $pdf->GetX();
$y = $pdf->GetY();
switch($y){
    case "90.00125";
    $y2=132;
    break;

    case "95.00125";
        $y2=127;
        break;

    case "100.00125";
        $y2=122;
        break;

    case "105.00125";
        $y2=117;
        break;
}
$pdf->SetXY($x + 49, $y+$y2);
$y3=$y2+$y;

$pdf->MultiCell(145,5,$descripcion,0,'J',false);

$pdf->Text(160,198,'');
$pdf->Text(160,205,'');

$pdf->Output('Acuse.pdf','I');