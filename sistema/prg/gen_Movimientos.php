
<style>
 
</style>

<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);

//America/Guatemala

date_default_timezone_set ( 'America/Guatemala');

ini_set("date.timezone", 'America/Guatemala');

include('../model/model_mov.php');

try 
  {
$db = new model_mov();

$barra = $_POST['vineta'];

//buscamos si existe la viñeta
 //Enca Envio   
 $sql_0=$db->mov_enca($barra);

 $existe_mov=0;
 while ($row_0=$sql_0->fetch(PDO::FETCH_NUM))
 { 
     
     $id_guia        =$row_0[0];
     $id_envio       =$row_0[1];
     $ori_ccosto     =$row_0[2];
     $des_ccosto     =$row_0[3];
     $estado         =$row_0[4];
     $id_usr         =$row_0[5];
     $fecha_date     =$row_0[6];
     $fecha_datetime =$row_0[7];
     $tiempo         =$row_0[8];
     $tipo_envio     =$row_0[9];
     $categoria      =$row_0[10];
     $id_orden       =$row_0[11];
     $barra          =$row_0[12];
     $comentario     =$row_0[13];
     $destinatario   =$row_0[14];
     $des_direccion  =$row_0[15];
     $existe_mov     =1;
 }

 if($existe_mov==1){
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">

            <div class="col-md-6">
                <!-- The time line -->
                <div class="timeline">
                    <!-- timeline item -->
                    <?php
                    
                    //Consulta para el TimeLine
                    $sql_1=$db->mov_tl2($barra);
                    
                    while ($row_1=$sql_1->fetch(PDO::FETCH_NUM))
                    {
                        $id_envio   =$row_1[1];
                        $PI         =$row_1[2];
                        $PI_D       =$row_1[3];
                        $AR         =$row_1[4];
                        $AR_D       =$row_1[5];
                        $LD         =$row_1[6];
                        $LD_D       =$row_1[7];
                        $DL         =$row_1[8];
                        $DL_D       =$row_1[9];
                        $DV         =$row_1[10];
                        $DV_D       =$row_1[11];

                        if(($PI)!=0){
                            $param_pi="fa-check bg-green";
                            $datetime_pi=$db->humanizando_fecha2($PI);
                        }else{
                            $param_pi="fa-circle-thin bg-white";
                            $datetime_pi="";
                        }

                        if(($AR)!=0){


                            $row_imagen_ar=$db->recurso_origen($barra);
                            while ($row_ar=$row_imagen_ar->fetch(PDO::FETCH_NUM))
                            {
                                $imagen_ar=base64_encode($row_ar[0]);
                                $lat_ar=$row_ar[1];
                                $lon_ar=$row_ar[2];
                            }



                            $param_ar="fa-check bg-green";
                            if($AR_D=="ENVIO RECIBIDO POR MENSAJERO"){
                                $datetime_ar=$db->humanizando_fecha2($AR);
                            }else{
                                $datetime_ar=$db->humanizando_fecha($AR);
                            }


                        }else{
                            $param_ar="fa-circle-thin bg-white";
                            $datetime_ar="";
                        }

                        if($LD != 0){
                            $param_ld="fa-check bg-green";
                            $datetime_ld=$db->humanizando_fecha($LD);
                        }else{
                            $param_ld="fa-circle-thin bg-white";
                            $datetime_ld="";
                        }

                        if($DL != 0){
                            $param_final="fa-check bg-green";
                            $des_final="Entrega";
                            $datetime_dl=$db->humanizando_fecha2($DL);

                            $imagen_dl="";
                            $lat_dl=0;
                            $lon_dl=0;
                            $geo_dl="";

                            $row_imagen_dl=$db->recurso_destino($barra);
                            while ($row_dl=$row_imagen_dl->fetch(PDO::FETCH_NUM))
                            {
                                if($row_dl[0]!=""){
                                $imagen_dl=$row_dl[0];
                                $lat_dl=$row_dl[1];
                                $lon_dl=$row_dl[2];
                                $geo_dl="https://www.google.com/maps/place/".$lat_dl.",".$lon_dl;
                                }
                            }


                        }elseif($DV != 0){
                            $param_final="fa-check bg-green";
                            $des_final="Devoluci&oacute;n";
                            $datetime_dl=$db->humanizando_fecha2($DV);

                            $row_imagen_dl=$db->recurso_destino($barra);
                            while ($row_dl=$row_imagen_dl->fetch(PDO::FETCH_NUM))
                            {
                                $imagen_dl=$row_dl[0];
                                $lat_dl=$row_dl[1];
                                $lon_dl=$row_dl[2];
                                $geo_dl="https://www.google.com/maps/place/".$lat_dl.",".$lon_dl;
                            }
                        }else{
                            $param_final="fa-circle-thin bg-white";
                            $des_final="Entrega";
                            $datetime_dl="";
                        }
                    }
                    ?>

                    <div>
                        <i class="fas <?php echo $param_pi;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header"><a href="#">Solicitud de Env&iacute;o</a> <?php echo $datetime_pi; ?></h3>

                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_ar;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header noborder-"><a href="#">Ingreso</a> <?php echo $datetime_ar; ?></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_ld;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header "><a href="#">Salida a Ruta</a> <?php echo $datetime_ar; ?></h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas <?php echo $param_final;?>"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header no-border"><a href="#"><?php echo $des_final;?></a> <?php echo $datetime_dl; ?>
                                <a href="<?php echo $geo_dl; ?>" target="_blank">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                    </a>
                            </h3>
                        </div>
                    </div>
                    <?php ?>
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card-orange">
                    <img class="img-fluid pad" src="'data:image/jpeg;base64,<?php echo $imagen_ar;?>" alt="Recolección">
                    <p>Imágen de recolección</p>
                </div>

                <div class="card-orange">
                    <img class="img-fluid pad" src="'data:image/jpeg;base64,<?php echo $imagen_dl;?>" alt="Entrega">
                    <p>Imágen de Entrega</p>
                    <?php
                    $img = '<a href="#" data-toggle="modal" data-target="#myModal" style="width:auto;" onclick="solicitar_imagen('.$barra.')" ><img id="myImg" alt="Entrega Efectiva" style="width:20%;" src="data:image/jpeg;base64,'. $imagen_dl .'" ></a>
                    ';
                    print $img;
                    ?>

  <!--------------------------------------Waning-------------------------------->
        <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <?php echo '<img id="myImg" alt="Entrega Efectiva" style="width:100%;" src="data:image/jpeg;base64,'. $imagen_dl .'" >';?>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
      <!--------------------------------------Waning-------------------------------->



                  
                </div>
            </div>
            <!-- /.col -->
        </div>

    </div>
        <!-- /.timeline -->
</section>
<!-- /.content -->

<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card card-widget collapsed-card">
            <div class="card-header">
                <span class="card-title">Información de env&iacute;o</span>
                <!-- /.user-block -->
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                 <div class="row mb-12">
                    <div class="col"><b>ORDEN: </b><?php echo " ".$id_orden;?></div>
                    <div class="col"><b>VI&Ntilde;ETA: </b><?php echo " ".$barra;?></div>
                    <div class="col"><b>TIPO: </b><?php echo " ".$tipo_envio;?></div>
                    <div class="col"><b>CARACTERISTICAS: </b><?php echo " ".$categoria;?></div>
                </div>
                <br>
                <div class="row mb-6">
                    <div class="col"><b>DE: </b><?php echo " ".$ori_ccosto;?></div>
                    <div class="col"><b>PARA: </b><?php echo " ".$des_ccosto;?></div>
                </div>
                <div class="row mb-6">
                    <div class="col"><b>REMITENTE:</b> <?php echo " ".$id_usr;?></div>
                    <div class="col"><b>DESTINATARIO: </b><?php echo " ".$destinatario;?></div>
                </div>
                <br>
                <?php
                
                    //Movimientos Envio
                    $sql=$db->mov_completo($barra);

                    while ($row=$sql->fetch(PDO::FETCH_NUM))
                    {
                        
                        if($row[3]=="ENVIO EN RUTA"||$row[3]=="ENVIO RECIBIDO POR MENSAJERO"||$row[3]=="ENVIO ENTREGADO")
                        {
                            list($fecha, $hora)=explode(" ",$row[8]);
                            list($y,$m,$d)=explode("-",$fecha);
                            $fecha=$d."/".$m."/".$y." ".$hora;
                            echo "<p><span class='description'>".$fecha." : <b>".$row[3]."</b></span></p>";

                        }else{
                            $fecha_hora=$db->correccion_fecha_hora1($row[8]);

                            list($fecha, $hora)=explode(" ",$fecha_hora);
                            list($d,$m,$y)=explode("-",$fecha);
                            $fecha=$d."/".$m."/".$y." ".$hora;
                            echo "<p><span class='description'>".$fecha." : <b>".$row[3]."</b></span></p>";
                        }
                ?>
                    <!-- /.card-body -->
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>


<?php 
  

 }else{
?>

<div class="card-body">
    <div class="row mb-12">
        <div class="col"><font color='red'>VI&Ntilde;ETA CONSULTADA NO REGISTRADA EN SISTEMA</font></div>
    </div>
    <div class="row mb-12">
        <div class="col"><a href="index.php?prc=movimientos">Retornar</a></div>     
    </div>
    <br>
</div>
<?php
 }
} catch(Exception $e) //capturamos un posible error
{
  //mostramos el texto del error al usuario	  
  //echo "Error " . $e;
  $respuesta=array(
    'codigo'=> 502,
    'mensaje'=>" A ocurrido un error critico: ".$e,
    'SQL'=>$sql
);
  echo json_encode($respuesta);
}
?>




