<?php
$barra="";

  if(isset($_GET['br'])){
    $barra=$_GET['br'];
  }

?>
<style type="text/css">
  .deshabilita{pointer-events:none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Salida a Ruta - LD</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de salida a ruta</li>
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
            <div class="card-header">
              <h3 class="card-title">Formulario de Salida a Ruta</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div role="form" id="formulario" name="formulario" method="post"> <!--form-->
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12"> 
  
                  <!-- /.info-box -->
                </div>
                <input type="hidden" id="cli_id" name='cli_id' value="<?php echo $_SESSION['shi_codigo']; ?>">
                <!--    
                <div class="form-group">
                  <label for="numid"># Manifiesto</label>
                  <input type="text" class="form-control" id="numid" name='numid' value="<?php echo genera_numid(); ?>" readonly />
                </div>
                <div class="form-group">
                  <label for="posicion">Posicion</label>
                  <input  type="text" class="form-control" id="posicion" name='posicion' value="1" readonly/>
                </div>
                -->
                <div class="form-group">
                  <label for="id_zona">Zona</label>
                  <?php echo zona_ld(); ?>
                </div>

                <div class="form-group">
                  <label for="id_mensajero">Mensajero</label>
                  <?php echo mensajero_ld(); ?>
                </div>

                <div class="form-group">
                  <label for="vineta">Etiqueta</label>
                  <input type="text" value="<?php echo $barra;?>" class="form-control" id="vineta"  name='vineta' autofocus
                  onchange="procesarLD($('#id_zona').val(),
                                        $('#id_mensajero').val(),
                                        $('#vineta').val());
                                        return false;"/>
                </div>


              </div>
              <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy">
                      <?php
                      if(isset($_GET['br'])) {
                        ?>

                        <i class="far fa-envelope" onclick="procesarLD($('#id_zona').val(),
                                        $('#id_mensajero').val(),
                                        $('#vineta').val());
                        return false;"></i></span>
                          <?php
                      }else{
                        echo '<i class="far fa-envelope"></i></span>';
                      }
                    ?>
                        <div class="info-box-content">
                          
                            <div class="form-group" id='msj_div'></div>
                         
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
              <!-- /.card-body -->
                <!--
                <form>
                <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarMantCCosto(formulario.numid.value)">
                  Generar Manifiesto
                </button>
              </div>
                </form>
              -->
              
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Generar Manifiesto</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                                
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </div><!--Form -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->
<script src="vista/funciones.js"></script>
<!--Manejo de bloqueos en select-->
<script>
    let opciones = document.getElementById("id_zona");
    opciones.onchange=changeEventHandler;

    let opciones2 = document.getElementById("id_mensajero");
    opciones2.onchange=changeEventHandler2;

    function changeEventHandler(event) {
        opciones.classList.add("deshabilita");
  
    }
    function changeEventHandler2(event) {
        opciones2.classList.add("deshabilita");
  
    }
</script>
