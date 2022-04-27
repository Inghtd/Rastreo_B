<?php
@session_start();
$usr=$_SESSION['cod_usuario'];
//$usr="enviagt";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cambio de contraseña</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../../sistema/vista/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../../sistema/vista/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../../sistema/vista/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script>
    function comprobarClave(){
    clave1 = document.getElementById('c1');
    clave2 = document.getElementById('c2');

        if(clave1.value != clave2.value){
            document.getElementById("error").classList.add("mostrar");
            return false;
        }
        else{

            document.getElementById("error").classList.remove("mostrar");

            document.getElementById("ok").classList.remove("ocultar");

            document.getElementById("login").disabled = true;

            setTimeout(function () {
                document.f1.submit();
            },3000);

            return true;
        }
    /*if (clave1 == clave2)
       alert("Las dos claves son iguales...\nRealizaríamos las acciones del caso positivo")
       return true
    else
       alert("Las dos claves son distintas...\nRealizaríamos las acciones del caso negativo")
       return false*/
}
</script>

<style type="text/css">
 .ocultar{
     display: none;

 }

 .mostrar{
     display:block;
 }
</style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Env&iacute;a</b> de Guatemala
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese la nueva contraseña</p>

      <!--alertas-->
      <div id="error" class="alert alert-danger ocultar" role="alert">
          ¡Las contraseñas no coinciden, vuelva e intente nuevamente!
      </div>
      <div id="ok" class="alert alert-success ocultar" role="alert">
          La contraseña coinciden! (Procesando cambio de contraseña...)
      </div>

      <!--formulario de cambio-->
      <form action="{{ asset('/api/cambiopass') }}" method="post" name="f1" id="formchange" onsubmit="comprobarClave(); return false">
          <input type="hidden" value="<?php echo $usr;?>" name="usr">
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="clave1" id="c1" placeholder="nueva contraseña">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="clave2" id="c2" placeholder="confirmar">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="login">Aceptar</button>
            <button type="submit" class="btn btn-primary btn-block" >Cancelar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../../sistema/vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../../istema/vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../../sistema/vista/dist/js/adminlte.min.js"></script>

</body>
</html>
