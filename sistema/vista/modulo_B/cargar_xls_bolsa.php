
<?php

/*ini_set ("display_errors","1" );
error_reporting(E_ALL);
date_default_timezone_set('America/El_Salvador');
*/

include('funciones/funciones.php');

$x1 = new funciones();


$ruta="../../tmp/";

$archivo_nombre     = $_FILES["archivo"]["name"];
$archivo_peso       = $_FILES["archivo"]["size"];
$archivo_temporal   = $_FILES["archivo"]["tmp_name"];

$lineas = file($archivo_temporal);
$i=0;
$cn=0;

  $table='<table><tr><th>N°</th><th>Codigos de bolsas</th></tr><tbody>';

  $rowt='';
foreach($lineas as $lineas_num => $linea){

    $hex='';
    $barra='';
    if($i>5){
      $cn++;

        $datos = explode(",",$linea);
        $hex=$datos[0];
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $barra .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        $hex=substr($barra, 0, 16);

        

        $rowt=$rowt."<tr><td>".$cn."<-<input type='checkbox'></td><td>".$hex."--->".$barra."</td></tr>";
        $hex='';
        $barra='';


    }
    $i++;

}


$fecha = date("d-m-Y H:i:s");

$table=$table.$rowt." </tbody><tfoot><tr><th>N°</th><th>Codigos de bolsas</th></tr></tfoot></table>";



  


?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Carga base de bolsas</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de carga de bolsas</li>
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
                            <div class="form-group" id='msj_div'>
                            <form method="Post" action="vista/modulo_B/bolsa_expo_xls.php" target="_blank">

                           
                            
                            <input type="hidden" name="tabla" value="<?php echo $table; ?>">

                         
                            <?php
                            echo "<h2>Nombre Archivo: ".$archivo_nombre."</h2><br>";
                            
                            echo '<h2>Cantidad de volsas leidas:'.($cn).' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button type="submit" class="btn bg-navy">Descargar a Excel <i class="fas fa-file-excel"></i></button></h2>';
                            echo ' <br>';

                            echo $table;
                            ?>
                                 </form>
                            </div>
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
