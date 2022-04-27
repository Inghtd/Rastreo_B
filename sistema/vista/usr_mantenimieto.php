<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['id'])){
  $id=$_POST['id'];
  $nombre=$_POST['nombre'];
  $usr=$_POST['usr'];
  $ccosto=$_POST['ccosto'];
  $perfil=$_POST['perfil'];

}
?>

<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.ui.js"></script>
<link rel="stylesheet" href="lib/jquery.ui.css">

<!--colocamos la informacion de select2-->

<link href="vista/select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="vista/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>

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
          <h1>Mantenimiento de Usuarios</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de usuarios</li>
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
              <h3 class="card-title">Formulario de Actualización de Datos Personales </h3>
            </div>
            <!-- /.card-header -->
            <div class="text-center ocultar text-primary" id="carga">
              <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
              </div>  Prosesando la informacion...
            </div>

            <!-- form start -->
            <form role="form"  name="formulario" method="post">


                <div class="col-md-12 col-sm-6 col-12" id="respuesta">

                  <!-- /.info-box -->
                </div>
              <div class="card-body" id="formulario" >
                <!--
                <div class="form-group">
                  <label for="usr_cod">Codigo</label>
                  <?php //echo select_usuario(); ?>
                </div>
                -->
                <div class="form-group">
                  <label for="usr_cod2">Usuario </label>
                  <input autofocus type="text" maxlength='16' class="form-control" id="usr_cod2" name='usr_cod2' placeholder="Usuario"  value="<?php echo $usr;?>" required />
                </div>

                <!--div class="form-group">
                  <label for="usr_pass">Contrase&ntilde;a </label>
                  <input type="password" class="form-control" id="usr_pass" name='usr_pass' placeholder="Contraseña"  required />
                </div-->

                <div class="form-group">
                  <label for="usr_nombre">Nombre Usuario </label>
                  <input type="text" class="form-control" id="usr_nombre" name='usr_nombre' placeholder="Nombre Usuario"  value="<?php echo $nombre;?>" required />
                </div>

                <div class="form-group">
                  <label for="id_ccosto">Centro de Costo Actual: <?php echo $ccosto; ?></label>
                  <select  class="js-example-basic-single js-states form-control id_ccosto" id="id_ccosto" name="id_agencia"  onchange='changeUsuario()' ></select>
                  </div>

                <div class="form-group">
                  <label for="perfil">Perfil Actual: <?php echo $perfil; ?></label>
                  <select name='perfil' id='perfil' class="form-control">
                    <option value=''>-</option>
                    <option value='1'>Administrador</option>
                        <option value='2'>Soporte</option>
                        <option value='3'>Central</option>
                        <option value='5'>Encargado Agencia</option>
                        <option value='6'>Asesor Integral Agencia</option>
                  </select>
                </div>
            <input type="hidden" name="id_usr" id="id_usr" value="<?php echo $id;?>">
                <div class="card-footer">
                  <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                          onclick="actualizar( formulario.usr_cod2.value,
                                                       formulario.usr_nombre.value,
                                                       formulario.id_ccosto.value,
                                                       formulario.perfil.value,
                                                       formulario.id_usr.value
                                                       )">
                    Actualizar usuario
                  </button>
                </div>

                <!--div-- class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Registro de Usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="respuesta">
                        X
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <--<button type="button" class="btn btn-primary">Save changes</button>-->
                      <!--/div>
                    </div>
                    <-- /.modal-content -->
                  <!--/div>
                  <-- /.modal-dialog -->
                <!--/div-->
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->
<script src="vista/imagen_rp.js"></script>


<script>
     $('.id_ccosto').select2({
      theme: "classic",
        placeholder: 'Agencia Destino',
        minimumInputLength: 3,
        ajax: {
            url: "../sistema/prg/selects/changeCcosto.php",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>
