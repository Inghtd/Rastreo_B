<?php

/*ini_set ("display_errors","1" );
error_reporting(E_ALL);
date_default_timezone_set('America/El_Salvador');
*/
include('lib/xls/xls/Classes/PHPExcel.php');

include ("model/model_con.php");
$db = new model_con();


$ruta="../tmp/";

$archivo_nombre     = $_FILES["archivo"]["name"];
$archivo_peso       = $_FILES["archivo"]["size"];
$archivo_temporal   = $_FILES["archivo"]["tmp_name"];

if (copy($archivo_temporal,$ruta.$archivo_nombre)){
  //echo "Archivo subido $archivo_temporal = $archivo_nombre = $archivo_peso";

  $archivo        = $ruta.$archivo_nombre;
  $inputFileType  = PHPExcel_IOFactory::identify($archivo);
  $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
  $objPHPExcel    = $objReader->load($archivo);
  $sheet          = $objPHPExcel->getSheet(0); 
  $highestRow     = $sheet->getHighestRow(); 
  $highestColumn  = $sheet->getHighestColumn();
  $cargados       =0;

  $costo_origen=$_SESSION['ccosto'];
  $ccosto_des=1;
  $ccosto_nombre=1;

  for ($row = 2; $row <= $highestRow; $row++){
    /*
      $usr_destino  = $sheet->getCell("A".$row)->getValue()." – ";
      $tipo         = $sheet->getCell("B".$row)->getValue()." – ";
      $descripcion  = $sheet->getCell("C".$row)->getValue()." – ";
      $categoria    = trim(strtoupper($sheet->getCell("D".$row)->getValue()));
    */

    $tipo_envio=trim(strtoupper($sheet->getCell("A".$row)->getValue()));
    $destinatario=preg_replace('([^A-Za-z0-9 ])', '',$sheet->getCell("B".$row)->getValue());
    $cc_codigo=$sheet->getCell("C".$row)->getValue();
    $ccosto_nombre=$sheet->getCell("D".$row)->getValue();
    $direccion=$sheet->getCell("E".$row)->getValue();
    $agencia=$sheet->getCell("F".$row)->getValue();
    $descripcion=$sheet->getCell("G".$row)->getValue();
    $categoria    = trim(strtoupper($sheet->getCell("H".$row)->getValue()));
    $barra    = $sheet->getCell("I".$row)->getValue();
    if($destinatario!=""){
      /*
      1	RESTRINGIDO
      2	DELICADO
      3	PRIVADO
      4	NORMAL
       */

      if($categoria=='RESTRINGIDO')
      {
        $categoria=1;
      }
      elseif($categoria=='DELICADO')
      {
        $categoria=2;
      }
      elseif($categoria=='PRIVADO')
      {
        $categoria=3;
      }
      else
      {
        $categoria=4;
      }

      $ccosto_des=$db->ccodigo($cc_codigo);
      if($barra==0){
      $barra=$db->consulta_correlativo();
      }

    $con=$db->d_acuse($barra,$tipo_envio,$destinatario,$ccosto_des,$ccosto_nombre,$direccion,$agencia,$descripcion,$categoria);
    $sql=$db->registra_envio($costo_origen,$ccosto_des,$destinatario,$descripcion,$barra,$tipo_envio,$direccion,$categoria);


      $mj=$mj."tipo de envio: ".$tipo_envio."-->destinatario:".$destinatario."--> agencia destino:".$agencia."--> direccion destino:".$direccion."--> descripcion:".$descripcion."--> categoria:".$categoria."--> costo origen:".$costo_origen."--> costo destino:".$ccosto_des."<br>";

      //$db->registra_envio_xls($usr_destino,$tipo,$descripcion,$categoria);
  
      $cargados++;
  }

  $msj="<font color='blue'>Se han cargados $cargados registros</font>".$mj;
  }
}else{
  //echo "Error al subir el archivo ".$ruta.$archivo_nombre." ";
  $msj="<font color='red'>Error cargando el archivo validar</font>";
}
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Carga base envios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de carga de base</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-orange">
            <!-- /.card-header -->
            <!-- form start -->
            <div role="form" id="formulario" name="formulario" method="post"><!--ExForm-->
              <div class="card-body">
                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <?php echo $msj;?>
                            <div class="form-group" id='msj_div'></div>
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
        
                </div>

            </div><!--ExForm-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>