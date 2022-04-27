<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

include ('vista/reporte_ingresos.php');
$x1 = new model_con();
$class='';
$mj="";
if(isset($_GET['id'])) {
  $id_costo = base64_decode($_GET['id']);

  $data=$x1->centroc($id_costo);

  foreach($data as $row){
    //print_r($row);

    $agencia  = $row->agencia_nombre;
    $nombre   = $row->ccosto_nombre;
    $codigo   = $row->ccosto_codigo;
    $direccion= $row->centro_direccion;
    $telefono = $row->ccosto_telefono;
    $class='mostrar';

  }
}
if(isset($_POST['id_cc'])){
    $id_c       =$_POST['id_cc'];
    $codigo     =$_POST['codigo_ccosto'];
    $agencia    =$_POST['id_agencia'];
    $nombre     =$_POST['nombre_ccosto'];
    $direccion  =$_POST['direccion_ccosto'];
    $telefono   =$_POST['telefono_ccosto'];

    $string='';
    if($codigo!=''){ $string= "ccosto_codigo='".$codigo."'";}
    if($agencia!=''){ $string=$string.", id_agencia=".$agencia;}
    if($nombre!=''){ $string=$string.", ccosto_nombre='".$nombre."'";}
    if($direccion!=''){ $string=$string.", centro_direccion='".$direccion."'";}
    if($telefono!=''){ $string=$string.", ccosto_telefono='".$telefono."'";}

    $x1->centroup($string,$id_c);
  $class='ocultar';
  $mj='<div class="alert alert-success" role="alert">
  Cambios efectuados exitosamente!!
</div><script>
    function redireccionar(){
      window.location.href = "index.php?prc=centro_costos&accion=centrocosto";
    }
     
    setTimeout("redireccionar()", 2000);
</script>';
}
?>
<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Editar Centro de costo.</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->



    <br>



    <div class="row">
      <div class="col-sm-12">

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- left column -->
              <?php
              if($mj!=""){
                echo $mj;
              }
              ?>
              <div class="col-md-12 <?php echo $class;?>">
                <!-- general form elements -->
                <div class="card card-orange">
                  <div class="card-header">
                    <h3 class="card-title">Formulario de Edicion de centro de Costo.</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" id="formulario" name="formulario" action="index.php?prc=centro_costos&accion=editarccosto" method="post">
                    <div class="card-body">

                      <div class="col-md-12 col-sm-6 col-12">

                        <!-- /.info-box -->
                      </div>
                      <input type="hidden" id="id_cc" name='id_cc' value="<?php echo $id_costo; ?>">


                      <div class="form-group">
                        <label for="id_agencia">Agencia Actual: <?php echo $agencia;?></label>
                        <?php echo select_agencias(); ?>
                      </div>

                      <div class="form-group">
                        <label for="codigo_ccosto">Codigo centro de costo</label>
                        <input autofocus type="text" class="form-control" id="codigo_ccosto" name='codigo_ccosto' placeholder="Codigo del centro costo" value="<?php echo $codigo;?>" required />
                      </div>

                      <div class="form-group">
                        <label for="nombre_ccosto">Nombre del centro costo</label>
                        <input type="text" class="form-control" id="nombre_ccosto" name='nombre_ccosto' placeholder="Nombre del centro costo" value="<?php echo $nombre;?>" required />
                      </div>

                      <div class="form-group">
                        <label for="direccion_ccosto">Direcci&oacute;n</label>
                        <input type="text" class="form-control" id="direccion_ccosto" name='direccion_ccosto' placeholder="Direcci&oacute;n de centro costo" value="<?php echo $direccion;?>" required />
                      </div>

                      <div class="form-group">
                        <label for="telefono_ccosto">Tel&eacute;fono</label>
                        <input type="text" class="form-control" id="telefono_ccosto" name="telefono_ccosto" placeholder="telefono" value="<?php echo $telefono;?>" >
                      </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <button id="submit" type="submit" class="btn btn-outline-dark ">
                              Aceptar
                      </button>
                    </div>

                    <div class="modal fade" id="modal-default">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Registro de centro de costo</h4>
                            <button type="submit" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body" id="respuesta">
                            kghjgjhg
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    </div>
