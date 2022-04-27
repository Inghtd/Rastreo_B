<?php 

?>

<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }
</style>

<div class="col-md-12">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Movimientos Corrientes.</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Movimientos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">


          <div class="col-md-6"></div>
          <div class="col-md-6">
          <button id="ok" class="btn btn-primary ocultar">
            <span class="spinner-border spinner-border-sm"></span>
            Cargando Informacion...
          </button>
          </div>


          <div class="col-md-6">
            <form id="buscar" name="buscar" method="post" onsubmit="return false">
              <div class="input-group">
                <input type="search" id='vineta' class="form-control form-control-lg" placeholder="Consulta el env&iacute;o aqu&iacute;" autocomplete="off">
                <div class="input-group-append">
                  <button type="button" id="myBtn" class="btn btn-lg btn-default" onclick="buscarMovimientos(buscar.vineta.value);cargar();">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <p></p>
    <div id="content">
      <!--Toda la data Aca-->
    </div>
    <!--Hidden Form-->
    <div id="hiddenform" style="display: none;">
      <!--Toda la data Aca-->
    </div>
   <!-- /.Hidden Form-->
  </div>
  <!-- /.content-wrapper -->
</div>
<script>
  var input = document.getElementById("vineta");
  input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      cargar();
      document.getElementById("myBtn").click();
    }
  });

  function cargar(){
    document.getElementById('ok').classList.remove('ocultar');
  }
</script>

<script src="vista/movimientos.js"></script>
