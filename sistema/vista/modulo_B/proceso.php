<?php

include('funciones/funciones.php');

$x1=new funciones();

$dd=$x1->proceso_actual();

$proceso_a = 'no hay seleccion de proceso';
$estado_a  = 0;

foreach($dd as $row){
    $proceso_a = $row['seq_ini'];
    $estado_a  = $row['seq_fin'];
}




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




switch($estado_a){
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

.parpadea1{
  
  animation-name: parpadeo;
  animation-duration: 2s;
  animation-timing-function: linear;
  animation-iteration-count: infinite;

  -webkit-animation-name:parpadeo;
  -webkit-animation-duration: 2s;
  -webkit-animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
}

@-moz-keyframes parpadeo{
  0%{opacity: 1.0;}
  50%{opacity: 0.0;}
  100%{opacity: 1.0;}
}

@-webkit-keyframes parpadeo{
  0%{opacity: 1.0;}
  50%{opacity: 0.0;}
  100%{opacity: 1.0;}
}

@keyframes parpadeo {
  0%{opacity: 1.0;}
  50%{opacity: 0.0;}
  100%{opacity: 1.0;}
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
              <h1 class="">Proceso actual <?php echo $proceso_a; ?></h1>
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

    <!--script>
          

          /** consulta  **/
          function contador(){

            $('.text').html('');
            //$('#text').addClass('parpadea1');
            $(".text").append("<pre> <h2> <span class='parpadea1'>Cargando informacion...</span> <h2></pre>");


            $.ajax({
          url : '../sistema/prg/selects/info_scaneo.php',
          dataType: "text",
          success : function(data){
                    var str = JSON.parse(data);
                    //$('#text').removeClass('parpadea1');
                    $(".text").html("");
                    var scbarra='';

                    //var lgd;
                    str.log.forEach(lgd=>{
                   $(".text").append("<pre> <p><h4>|Proceso actual: "+ lgd.id
                   
                   +"<br>|Codigo: "+lgd.rfid
                   +"<br>| Barra: "+lgd.barra
                   +"<br>| Fecha y hora: "+lgd.fecha
                   +"<br>| Estado ultimo escaneo: "+lgd.estado
                   +"<br>| Estado codigo: "+lgd.proceso
                   +"<br>| Estado bolsa: "+lgd.estado_bolsa
                   +"<br>| Agencia: "+lgd.agencia
                   +"<br>-----------------------------------------------"
                   
                   +"<h4></p></pre>");
                    });

                    }
                  //adding row to end and start
                  //$("#test>tbody").prepend("<tr><td>Test Row Prepend</td></tr>");
                }
              
            );
            }


           /** consulta  **/
           function contador_B(){

            $('.text').html('');
            $(".text").append("<pre> <h2> <span class='parpadea1'>Cargando informacion...</span> <h2></pre>");

            $.ajax({
          url : '../sistema/prg/selects/info_scaneo.php?data=1',
          type: 'POST',
          data:{'codigo': $('#codigo_unico').val()},
          dataType: "text",
          success : function(data){
                    var str = JSON.parse(data);
                    
                    $(".text").html("");
                    var scbarra='';

                    //var lgd;
                    str.log.forEach(lgd=>{
                   $(".text").append("<pre> <p><h4>|Proceso actual: "+ lgd.id
                   
                   +"<br>|Codigo: "+lgd.rfid
                   +"<br>| Barra: "+lgd.barra
                   +"<br>| Fecha y hora: "+lgd.fecha
                   +"<br>| Estado ultimo escaneo: "+lgd.estado
                   +"<br>| Estado codigo: "+lgd.proceso
                   +"<br>| Estado bolsa: "+lgd.estado_bolsa
                   +"<br>| Agencia: "+lgd.agencia
                   +"<br>-----------------------------------------------"
                   
                   +"<h4></p></pre>");
                    });

                    }
                  //adding row to end and start
                  //$("#test>tbody").prepend("<tr><td>Test Row Prepend</td></tr>");
                }
              
            );
            }

</script-->

<br>
<div class="col-md-12">
<input type="hidden" id="input-url" size="50" value="<?php echo $url;?>"></input>
<hr />
 
<!--input type="button" id="button" value="consola"></input-->
          </form>
<div class="form-group">
                <form id='formulario' method="post" name="formulario" action="index.php?prc=bolsa&accion=csv" target="_blank" enctype='multipart/form-data'>
                
                <br><br>
	                <input class='input' name='archivo' type='file' id='archivo'><br>
                    <input type='hidden' name='MAX_FILE_SIZE' value='100000000'>
                    <br>
                    <br>
                    <input class="btn btn-outline-dark " name='enviar' id='enviar' value='Cargar Base' type='submit'>
                
                </form>
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

</script>

