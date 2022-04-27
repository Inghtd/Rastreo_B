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
            <div class="card-header">
              <h3 class="card-title">Formulario de carga de base</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div role="form" id="formulario" name="formulario" method="post"><!--ExForm-->
              <div class="card-body">


                <div class="form-group">
                <form id='formulario' method="post" name="formulario" action="index.php?prc=proc&accion=proc_carga_xls" target='_blank' enctype='multipart/form-data'>
	                <input class='input' name='archivo' type='file' id='archivo'><br>
                    <input type='hidden' name='MAX_FILE_SIZE' value='100000000'>
                    <br>
                    <br>
                    <input class="btn btn-outline-dark " name='enviar' id='enviar' value='Cargar Base' type='submit'>
                
                </form>
                </div>

                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-file"></i></span>
                        <div class="info-box-content">
                        <a href="vista/formatos/base.xlsx" download="base">Descargar Plantilla Base Carga</a>
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
<script src="vista/funciones.js"></script>