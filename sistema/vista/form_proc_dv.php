<?php 

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
          <h1>Devolucion- DV</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de devolucion</li>
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
              <h3 class="card-title">Formulario de Devolucion</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post"> <!--form-->
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12"> 
  
                  <!-- /.info-box -->
                </div>
                <input type="hidden" id="cli_id" name='cli_id' value="<?php echo $_SESSION['shi_codigo']; ?>">
                      
                <div class="form-group">
                  <label for="numid"># Manifiesto</label>
                  <input type="text" class="form-control" id="numid" name='numid'  />
                </div>

                <div class="form-group">
                  <label for="posicion">Posicion</label>
                  <input  type="text" class="form-control" id="posicion" name='posicion' />
                </div>

                <div class="form-group">
                  <label for="id_motivo">Motivo Devolucion</label>
                  <?php echo motivo_dv(); ?>
                </div>
               
              </div>

      
                <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarDV(formulario.numid.value,
                                            formulario.posicion.value,
                                            formulario.id_motivo.value)">
                  Procesar Devolucion
                </button>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Generar Devolucion</h4>
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
            </form><!--Form -->
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
  
</script>
