<?php 

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mantenimiento Centro de Costos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de centro de costos</li>
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
              <h3 class="card-title">Formulario de ingreso centro de costos</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12"> 
  
                  <!-- /.info-box -->
                </div>
                <input type="hidden" id="cli_id" name='cli_id' value="<?php echo $_SESSION['shi_codigo']; ?>">
                      
                <div class="form-group">
                  <label for="id_ccosto">Centro de costo</label>
                  <?php echo select_ccosto(); ?>
                </div>

                <div class="form-group">
                  <label for="id_agencia">Agencia</label>
                  <?php echo select_agencias(); ?>
                </div>

                <div class="form-group">
                  <label for="codigo_ccosto">Codigo centro de costo</label>
                  <input autofocus type="text" class="form-control" id="codigo_ccosto" name='codigo_ccosto' placeholder="Codigo del centro costo"  required />
                </div>

                <div class="form-group">
                  <label for="nombre_ccosto">Nombre del centro costo</label>
                  <input type="text" class="form-control" id="nombre_ccosto" name='nombre_ccosto' placeholder="Nombre del centro costo"  required />
                </div>

                <div class="form-group">
                  <label for="direccion_ccosto">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="direccion_ccosto" name='direccion_ccosto' placeholder="Direcci&oacute;n de centro costo"  required />
                </div>

                <div class="form-group">
                  <label for="telefono_ccosto">Tel&eacute;fono</label>
                  <input type="text" class="form-control" id="telefono_ccosto" name="telefono_ccosto" placeholder="telefono">
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarMantCCosto(formulario.id_ccosto.value,formulario.cli_id.value,formulario.id_agencia.value,formulario.codigo_ccosto.value,
                        formulario.nombre_ccosto.value,formulario.direccion_ccosto.value,formulario.telefono_ccosto.value)">
                  Registrar Centro Costo
                </button>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Registro de centro de costo</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                           kghjgjhg     
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
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->
<script src="vista/funciones.js"></script>
