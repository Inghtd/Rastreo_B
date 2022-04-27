<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Arribo de Env&iacute;os - AR</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de recepci&oacute;n de env&iacute;os</li>
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
              <h3 class="card-title">Formulario de Ingreso de env&iacute;os</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div role="form" id="formulario" name="formulario" method="post"><!--ExForm-->
              <div class="card-body">


                <div class="form-group">
                  <label for="vineta">Vi&ntilde;eta</label>
                  <input type="text" class="form-control" id="vineta" name='vineta' autocomplete="off" autofocus placeholder="vi&ntilde;eta" onchange="procesarAR(this.value)" \>
                </div>


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

<script src="vista/funciones.js"></script>