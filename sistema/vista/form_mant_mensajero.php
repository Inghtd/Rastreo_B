<?php 

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Mantenimiento de Mensajero</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de mensajero</li>
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
              <h3 class="card-title">Formulario de Ingreso de Mensajero</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12"> 
  
                  <!-- /.info-box -->
                </div>
                        
                <div class="form-group">
                  <label for="id_mensajero">Mensajero</label>
                  <?php echo select_mensajeros(); ?>
                </div>

                <div class="form-group">
                  <label for="nombre_mensajero">Nombre </label>
                  <input autofocus type="text" class="form-control" id="nombre_mensajero" name='nombre_mensajero' placeholder="Nombre de mensajero"  required />
                </div>

                <div class="form-group">
                  <label for="direccion_mensajero">Direccion </label>
                  <input type="text" class="form-control" id="direccion_mensajero" name='direccion_mensajero' placeholder="Direccion mensajero"  required />
                </div>

                <div class="form-group">
                  <label for="telefono_mensajero">Telefono </label>
                  <input type="text" class="form-control" id="telefono_mensajero" name='telefono_mensajero' placeholder="Telefono mensajero"  required />
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarMantMensajero(formulario.id_mensajero.value,formulario.nombre_mensajero.value,formulario.direccion_mensajero.value,formulario.telefono_mensajero.value)">
                  Registrar Mensajero
                </button>
              </div>
 
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Registro de Mensajero</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                                X
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
