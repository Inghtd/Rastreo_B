<?php

include('funciones/funciones.php');

$x1=new funciones();





if(isset($_GET['acc'])){
    $par = $_GET['acc'];
    

    switch($par){
        
        case 1:
            $proceso = "Escaneo Ingreso";
            break;

        case 2:
            $proceso = "Escaneo Despacho";
            break;

        case 3:
            $proceso = "Escaneo Recepcion Departamentos";
            break;

        case 4:
            $proceso = "Escaneo Salida Agencias";
            break;

        case 5:
            $proceso = "Stop";
            break;
    }

   
    $x1->proceso($proceso,$par);
    
}


$dd=$x1->proceso_actual();


foreach($dd as $row){
    $proceso = $row['seq_ini'];
    $estado  = $row['seq_fin'];
}

switch($estado){
  case 1:
    $btn1 = '<a type="button" disabled="disabled" class="btn btn-secondary" href="#">Ingreso</a>';
    $btn2 = '<a type="button" class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=2">Despacho</a>';
    $btn3 = '<a type="button" class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=3">Ingreso Departamentos</a>';
    $btn4 = '<a type="button" class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=4">Despacho Agencias</a>';
    $btn5 = '<a type="button" class="btn btn-danger" href="index.php?prc=bolsa&accion=scan_proceso&acc=5">Finalizar Proceso</a>';
    break;

case 2:
  $btn1 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=1">Ingreso</a>';
  $btn2 = '<a type="button" disabled="disabled" class="btn btn-secondary" href="#">Despacho</a>';
  $btn3 = '<a type="button" class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=3">Ingreso Departamentos</a>';
  $btn4 = '<a type="button" class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=4">Despacho Agencias</a>';
  $btn5 = '<a type="button" class="btn btn-danger" href="index.php?prc=bolsa&accion=scan_proceso&acc=5">Finalizar Proceso</a>';
  break;

case 3:
  $btn1 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=1">Ingreso</a>';
  $btn2 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=2">Despacho</a>';
  $btn3 = '<a type="button" disabled="disabled" class="btn btn-secondary" href="#">Ingreso Departamentos</a>';
  $btn4 = '<a type="button" class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=4">Despacho Agencias</a>';
  $btn5 = '<a type="button" class="btn btn-danger" href="index.php?prc=bolsa&accion=scan_proceso&acc=5">Finalizar Proceso</a>';
  break;

case 4:
  $btn1 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=1">Ingreso</a>';
  $btn2 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=2">Despacho</a>';
  $btn3 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=3">Ingreso Departamentos</a>';
  $btn4 = '<a type="button" disabled="disabled" class="btn btn-secondary" href="#">Despacho Agencias</a>';
  $btn5 = '<a type="button" class="btn btn-danger" href="index.php?prc=bolsa&accion=scan_proceso&acc=5">Finalizar Proceso</a>';
  break;


case 5:
  $btn1 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=1">Ingreso</a>';
  $btn2 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=2">Despacho</a>';
  $btn3 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=3">Ingreso Departamentos</a>';
  $btn4 = '<a type="button" class="btn btn-primary"  href="index.php?prc=bolsa&accion=scan_proceso&acc=4">Despacho Agencias</a>';
  $btn5 = '<a type="button" disabled="disabled" class="btn btn-secondary" href="#">Finalizar Proceso</a>';
  break;

  case 0:
    $btn1 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=1">Ingreso</a>';
    $btn2 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=2">Despacho</a>';
    $btn3 = '<a type="button"  class="btn btn-primary" href="index.php?prc=bolsa&accion=scan_proceso&acc=3">Ingreso Departamentos</a>';
    $btn4 = '<a type="button" class="btn btn-primary"  href="index.php?prc=bolsa&accion=scan_proceso&acc=4">Despacho Agencias</a>';
    $btn5 = '<a type="button" class="btn btn-danger" href="index.php?prc=bolsa&accion=scan_proceso&acc=5">Finalizar Proceso</a>';
    break;
  

}


$fch=date("d-m-Y");
$url="../public/api_sc/tmp/datos".$fch.".txt";
$nom="datos".$fch.".txt";
?>

<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.ui.js"></script>
<link rel="stylesheet" href="lib/jquery.ui.css">

<!--colocamos la informacion de select2-->
<style>
.anyClass {
  height:150px;
  overflow-y: scroll;
  
  background-color: black;
  background-image: radial-gradient(
    rgba(0, 150, 0, 0.75), black 120%
  );
  height: 75vh;
  color: #fff;
  font: 14px Inconsolata, monospace;

}
.anyClass>pre{
color:#fff;
}
</style>
<link href="vista/select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="vista/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- Script

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

<!-- jQuery UI -->
<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->

<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Asignación de procesos de Escaneo Masivo.</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Asignación de procesos de Escaneo Masivo. </li>
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
          <div class="card card-green">
            <div class="card-header">
              <h2 class="card-title">Proceso actual <?php echo $proceso; ?></h2>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post"><!--ExForm-->
              <div class="card-body">

              
                  
<div class="form-inline col-md-12">

                <div class="col-md-2">
                <?php echo $btn1;?>
                 </div>

                <div class="col-md-2">
                <?php echo $btn2;?>
                </div>


                <div class="col-md-2">
                <?php echo $btn3;?>
                </div>

                

                <div class="col-md-2">
                <?php echo $btn4;?>
                </div>

                <div class="col-md-2">
                <?php echo $btn5;?>
                </div>

    </div>

    <script>
          

          /** consulta  **/
          function contador(){
            $.ajax({
          url : '../sistema/prg/selects/info_scaneo.php',
          dataType: "text",
          success : function(data){
                    var str = JSON.parse(data);
                    console.log(str.sc_barra);
                    $(".text").html("");
                    var scbarra='';
                    if(str.sc_barra!=null){
                      scbarra="Ultimo escaneo realizado en los ultimos 5 minutos"
                      +"<br> Codigo: "+str.codigo_unico
                      +"<br> Barra: "+str.sc_barra
                      +"<br> Fecha y hora: "+str.sc_fecha_hora
                      +"<br> Estado: "+str.sc_estado
                       ;
                    }else if(str.sc_barra==null){
                      scbarra="No hay ningun escaneo realizado en los ultimos 5 minutos";
                    }

                   $(".text").append("<pre> <h3>Proceso actual: "+ str.proceso
                   +"<br> Ultimo codigo escaneado: "+str.codigo_unico
                   +"<br> Barra: "+str.barra
                   +"<br> Fecha y hora: "+str.fecha_hora
                   +"<br> Estado ultimo escaneo: "+str.estado
                   +"<br>-----------------------------------------------"
                   +"<br> "+scbarra
                   +"<h3></pre>");
                  //adding row to end and start
                  //$("#test>tbody").prepend("<tr><td>Test Row Prepend</td></tr>");
                }
              }
            );
            }


          setInterval('contador()',1000);

            function eliminar(){
                $.ajax({
                  url:"../public/api_sc/limpiartxt.php",
                  data:{"nom":"<?php echo $nom; ?>"}
                });
            }


</script>

<br>
<div class="col-md-12">
<input type="hidden" id="input-url" size="50" value="<?php echo $url;?>"></input>
<hr />
  <h2>Consola:</h2>
<!--input type="button" id="button" value="consola"></input-->

<input type="button" id="button" value="Actualizar" onclick="contador()"></input>
<div class="text anyClass">
 
</div>


</div>

  <!-- /.botones -->
  <BR><BR>
                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          
                            <div class="form-group" id='msj_div'></div>
                         
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
        
                </div>
                <!-- /.card-body -->
                <!--
                <div class="card-footer">
                    <button type="button" class="btn btn-outline-dark" >
                    Procesar Ingreso
                    </button>
                </div>
                -->
            </div><!--ExForm-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->


<script>

$(document).ready(function(){
  
  $.ajax({
          url : '../sistema/prg/selects/info_scaneo.php',
          dataType: "text",
          success : function(data){
                    var str = JSON.parse(data);
                    console.log(str);
                    
                    var scbarra='';
                    if(str.sc_barra!=null){
                      scbarra="Ultimo escaneo realizado en los ultimos 5 minutos"
                      +"<br> Codigo: "+str.codigo_unico
                      +"<br> Barra: "+str.sc_barra
                      +"<br> Fecha y hora: "+str.sc_fecha_hora
                      +"<br> Estado: "+str.sc_estado
                       ;
                    }else if(str.sc_barra==null){
                      scbarra="No hay ningun escaneo realizado en los ultimos 5 minutos";
                    }
                   $(".text").append("<pre> <h2>Proceso actual: "+ str.proceso
                   +"<br> Ultimo codigo escaneado: "+str.codigo_unico
                   +"<br> Barra: "+str.barra
                   +"<br> Fecha y hora: "+str.fecha_hora
                   +"<br> Estado ultimo escaneo: "+str.estado
                   +"<br>-----------------------------------------------"
                   +"<br> "+scbarra
                   +"<h2></pre>");


                }
              }
            );
 });
</script>

