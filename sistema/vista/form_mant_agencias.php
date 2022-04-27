<?php 

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mantenimiento de Agencias</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de agencias</li>
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
              <h3 class="card-title">Formulario de Ingreso de agencias</h3>
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
                  <label for="id_agencia">Agencia</label>
                  <?php echo select_agencias(); ?>
                </div>

                <div class="form-group">
                  <label for="codigo_agencia">Codigo agencia</label>
                  <input autofocus type="text" class="form-control" id="codigo_agencia" name='codigo_agencia' placeholder="Codigo de la agencia"  required />
                </div>

                <div class="form-group">
                  <label for="nombre_agencia">Nombre de agencia</label>
                  <input type="text" class="form-control" id="nombre_agencia" name='nombre_agencia' placeholder="Nombre de la agencia"  required />
                </div>

                <div class="form-group">
                  <label for="direccion_agencia">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="direccion_agencia" name='direccion_agencia' placeholder="Direcci&oacute;n de agencia"  required />
                </div>

                <div class="form-group">
                  <label for="telefono_agencia">Tel&eacute;fono</label>
                  <input type="text" class="form-control" id="telefono_agencia" name="telefono_agencia" placeholder="telefono">
                </div>

              </div>
              <!-- /.card-body -->
              <!---->
              <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarMantAgencia(formulario.cli_id.value,
                                                      formulario.id_agencia.value,
                                                      formulario.codigo_agencia.value,
                                                      formulario.nombre_agencia.value,
                                                      formulario.direccion_agencia.value,
                                                      formulario.telefono_agencia.value)">
                  Registrar Agencia
                </button>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Registro de agencia</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                                X
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <!--button type="button" class="btn btn-primary">Save changes</button-->
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
