<?php
include('bdd.php');

class acciones extends export
{


public function export_xls()
{
include('lib/xls/xls/Classes/PHPExcel.php');
// Create new PHPExcel object
//** PHPExcel_Cell_AdvancedValueBinder */
require_once 'lib/xls/xls/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
//** PHPExcel_IOFactory */
require_once 'lib/xls/xls/Classes/PHPExcel/IOFactory.php';
//clase 2007
include 'lib/xls/xls/Classes/PHPExcel/Writer/Excel2007.php';

// Set value binder
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder());

$prc=$_GET['prc'];
$m=1;
$objPHPExcel = new PHPExcel();
// Set properties
$objPHPExcel->getProperties()->setCreator("Lic. Marvin Abrego")
							 ->setLastModifiedBy("Lic. Marvin Abrego")
							 ->setTitle('&L&BLo Importante es Saber Llegar')
							 ->setSubject("Urbano El Salvador")
							 ->setDescription("generado usando Clase PHPExcel .")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Web");

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(1);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.5);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.5);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("Urbano");
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&C&H' . $objPHPExcel->getProperties()->getTitle() . '&RPagina &P de &N');
$objPHPExcel->getActiveSheet()->setShowGridlines(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial');
$objPHPExcel->getDefaultStyle()->getFont()->setSize(9); 

    $borders = array(
          'borders' => array(
            'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN,
              'color' => array('argb' => 'FF000000'),
            )
          ),
        );

$styleArray = array(
	'font' => array(
		'bold' => true,
	),
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	),
	'borders' => array(
		'top' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
		),
	),
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
		'rotation' => 90,
		'startcolor' => array(
			'argb' => 'FFA0A0A0',
		),
		'endcolor' => array(
			'argb' => 'FFFFFFFF',
		),
	),
		'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
			'color' => array('argb' => 'FFFF0000'),
			
		),
	),

);

$negrita = array(
	'font' => array(
		'bold' => true));

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle($prc);

//datos generales
$data_general=$this->cargar_data_general();

$trozos=explode(",",$data_general);

$cols		=$trozos[0];
$titulo		=$trozos[1];
$nombre_doc	=$trozos[2];

$col=0;
$objPHPExcel->getActiveSheet()->mergeCells("A1:".chr(65+$cols)."1");
$objPHPExcel->getActiveSheet()->setCellValue("A1",$titulo);
$objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($styleArray);

//cabecera del documento
$cabecera=$this->cargar_cabecera();

//datos del documento
$data_general=$this->cargar_data_general();

foreach ($cabecera as $cab)
{

    for($j=0;$j<=$cols;$j++)
	{
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j,2, $cab[$j]);
    	$objPHPExcel->getActiveSheet()->getStyle("A2:".chr(65+$cols)."2")->applyFromArray($styleArray);
	}

}


$data=$this->cargar_datos();


$objPHPExcel->setActiveSheetIndex(0);
$cuenta_filas=2;
foreach($data as $row)
{
	//echo $row[$i];
	$cuenta_filas++;
    for($i=0;$i<=$cols;$i++)
	{
	//echo $col." - ".$i." - ".$row[$i];
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i, $col+3, trim($row[$i]));

	//echo $row[$i];
	}
        $col++;

}


for ($l = 1; $l <= $cols; $l++) {
	$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($l)->setAutoSize(true);
}

//borde a las celdas desde la fila 2
$objPHPExcel->getActiveSheet()->getStyle("A4:".chr(65+$cols).$cuenta_filas)->applyFromArray($borders);

//exportando la salida
$excelBinaryWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$excelBinaryWriter->save('php://output');

}

public function export_pdf()
{
require('lib/fpdf16/fpdf.php');

$pdf = new FPDF("L");
$pdf->AddPage();

    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(240,240,240);
    $pdf->SetLineWidth(.3);
    $pdf->SetXY(10,15);
    $fill = true;
//cabecera del documento
$cabecera=$this->cargar_cabecera();
//datos del documento
$data_general=$this->cargar_data_general();
$trozos=explode(",",$data_general);
$cols		=$trozos[0];
$titulo		=$trozos[1];
$nombre_doc	=$trozos[2];
$ancho_g=0;
foreach ($cabecera as $tit)
{

    for($n=0;$n<=$cols;$n++)
	{
	$ancho[$n]=intval((strlen($tit[$n])*2));
	$ancho_g=$ancho[$n]+$ancho_g;
	}

}


        $pdf->Cell($ancho_g,4,$titulo,'1',0,'C',$fill);
        $pdf->Ln();

    

foreach ($cabecera as $cab)
{

    for($j=0;$j<=$cols;$j++)
	{
	$ancho[$j]=(strlen($cab[$j])*2);
        $pdf->Cell($ancho[$j],4,substr($cab[$j],0,$ancho[$j]+3),'1',0,'L',$fill);
	}

}
        $pdf->Ln();



    $fill = false;

$pdf->SetFont('Arial','',8);
$data=$this->cargar_datos();

$cuenta_filas=2;
foreach($data as $row)
{
    	for($i=0;$i<=$cols;$i++)
	{
        $pdf->Cell($ancho[$i],4,substr($row[$i],0,$ancho[$i]-5),'1',0,'L',$fill);
	}
        $pdf->Ln();
}

$pdf->Output($nombre_doc.".pdf","D");


}

public function export_guias_pdf()
{
/*ini_set ("display_errors","1" );
error_reporting(E_ALL);*/


require('lib/fpdf16/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(240,240,240);
    $pdf->SetLineWidth(.3);
    $pdf->SetXY(10,15);
    $fill = true;
//cabecera del documento
$cabecera=$this->cargar_cabecera();
//datos del documento
$data_general=$this->cargar_data_general();
$trozos=explode(",",$data_general);
$cols		=$trozos[0];
$titulo		=$trozos[1];
$nombre_doc	=$trozos[2];

foreach ($cabecera as $tit)
{

    for($n=0;$n<=$cols;$n++)
	{
	$ancho[$n]=(strlen($tit[$n])*2);
	$ancho_g=$ancho[$n]+$ancho_g;
	}

}


        $pdf->Cell($ancho_g,4,$titulo,'1',0,'C',$fill);
        $pdf->Ln();



    $fill = false;

$pdf->SetFont('Arial','',8);
$data=$this->cargar_datos();

$cuenta_filas=2;
foreach($data as $row)
{
$q++;
if($q%2==0)
{
	$w=10;
	$h=150;


}else
{
if($q==1)
{
    	$w=10;
	$h=28;
}else
{
$pdf->AddPage();
    	$w=10;
	$h=25;
}
}
$pdf->SetXY($w,$h-8);

    	for($i=0;$i<=$cols;$i++)
	{
        $pdf->Cell($ancho[$i],4,substr($row[$i],0,$ancho[$i]-1),'1',0,'L',$fill);
	}

	$guia=trim($row[0]);
	$PREFIX="../reportes/imagenes5/";
	$imagen=$PREFIX.$guia.".jpg";

	if(file_exists($imagen))
	{
	$pdf->Image($imagen,$w,$h,180,110);
	}else
	{
	$pdf->Text(14,10,"Sin Imagen Disponible".$imagen);
	}




	
	
}

$pdf->Output($nombre_doc.".pdf","D");


}




public function cargar_datos()
{
$prc	=$_GET['prc'];
$sql=new sql();
$data=$sql->$prc();
return $data;
}

public function cargar_cabecera()
{
$sql=new sql();
$prc="cabecera_".$_GET['prc'];
$data=$sql->$prc();
return $data;
}


public function cargar_data_general()
{
$sql=new sql();
$prc="data_general_".$_GET['prc'];
$data=$sql->$prc();
return $data;
}

}

class export
{



	function __construct()
	{

	}



public function resp()
{
	$acciones 	= new acciones;
	$action=$_GET["m2"];

	$data_general=$acciones->cargar_data_general();

	$trozos=explode(",",$data_general);

	$cols		=$trozos[0];
	$titulo		=$trozos[1];
	$nombre_doc	=$trozos[2];

	$prc	=$_GET['prc'];

	if($action=='x')
	{
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=$nombre_doc.xls");
	header("Cache-Control: max-age=0");
	$acciones->export_xls();
	}
	elseif($action=='p')
	{
	$acciones->export_pdf();
	}
	elseif($action=='g')
	{
	$acciones->export_guias_pdf();
	}
	else
	{
	exit("Acci&oacute;n no valida");
	}
	
	//echo "123";
}

}



?>