<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

if(isset($_POST['clave2'])){
  $newpass=$_POST['clave2'];
  $usr=$_POST['usr'];


 include ('vista/usr_mante_proc.php');
  $x1=new usuarios();
  $x1->password($newpass,$usr);
  ?>
  <script>
        window.location.replace("../index.php");
    </script>
  <?php
}
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
  <link rel="stylesheet" href="../sistema/vista/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../sistema/vista/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../sistema/vista/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.ui.js"></script>
<link rel="stylesheet" href="lib/jquery.ui.css">

  <script>
    function validar() {

      valor1 = document.getElementById("c1").value;
      valor2 = document.getElementById("c2").value;
      //errorclave2


      if (valor1 == null || valor1.length == 0 || /^\s+$/.test(valor1)) {
        document.getElementById("errorclave1").classList.add("mostrar");
        return false;
      }else if(valor2 == null || valor2.length == 0 || /^\s+$/.test(valor2)){
        document.getElementById("errorclave1").classList.remove("mostrar");
        document.getElementById("errorclave2").classList.add("mostrar");
      }else{
        document.getElementById("errorclave1").classList.remove("mostrar");
        document.getElementById("errorclave2").classList.remove("mostrar");

        comprobarClave();
      }



    }
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

        //document.getElementById("login").disabled = true;

        setTimeout(function () {
          document.f1.submit();
        },3000);

        return true;
      }

    }
  </script>

  <style type="text/css">
    .ocultar{
      display: none;

    }

    .mostrar{
      display:block;
    }

    .alert{
      font-size: 15px !important;
    }
  </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
   Cambio de contrase&ntilde;a de usuarios
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <?php
    if(isset($_GET['usr'])){
    $usr    = base64_decode($_GET['usr']);


    ?>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Ingrese la nueva contrase&ntilde;a para el usuario <strong><?php echo $usr;?></strong></p>

      <!--alertas
      <div id="error" class="alert alert-danger ocultar" role="alert">
        ¡Las contraseñas no coinciden, vuelva e intente nuevamente!
      </div>
      <div id="ok" class="alert alert-success ocultar" role="alert">
        La contraseña coinciden! (Procesando cambio de contraseña...)
      </div>-->

      <!--formulario de cambio--><h1>
      <form action="index.php?prc=rep_usuario&accion=cambiar" method="post" name="f1" id="formchange" onsubmit="validarL();">
        <input type="hidden" value="<?php echo $usr;?>" name="usr">
        <div class="input-group mb-3">

          <input type="password" class="form-control" name="clave1" id="c1" placeholder="nueva contrase&ntilde;a" required maxlength="16">
          <span id="passstrength"></span>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div id="mensaje" class="alert ocultar" role="alert"></div>

        <div id="errorclave1" class="alert alert-danger ocultar" role="alert">
          ¡el campo no pude estar vacio!
        </div>


        <div class="input-group mb-3">
          <input type="password" class="form-control" name="clave2" id="c2" placeholder="confirmar contrase&ntilde;a" maxlength="16">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div id="errorclave2" class="alert alert-danger ocultar" role="alert">
          ¡el campo no pude estar vacio!
        </div>

        <div class="row">
          <div class="col-4">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="cch" disabled>Aceptar</button>

          </div>
          <!-- /.col -->
        </div>
      </form>
            <?php
                  }else{
              ?>
      <div  class="alert alert-success " role="alert">
                    <p class="login-box-msg">cambio efectuado exitosamente.</p>
                    <!--informacion de sistema-->
      </div>
                    <?php
                  }
                    ?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->






<script>

$('#c2').keyup(function(e){
  var clave1 = document.getElementById("c1").value;
  document.getElementById("mensaje").classList.remove("ocultar");
  document.getElementById("mensaje").classList.remove("alert-success");
  document.getElementById("mensaje").classList.remove("alert-danger");


  if(clave1 != $(this).val()){
            document.getElementById("mensaje").classList.add("alert-danger");
            
            $('#mensaje').html('No coinciden');

  }else if(clave1 === $(this).val()){
              document.getElementById("mensaje").classList.add("alert-success");

            $('#mensaje').html('Las contraseñas son iguales');
            $("#cch").removeAttr("disabled");
  }
});


$('#c1').keyup(function(e) {
     var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var enoughRegex = new RegExp("(?=.{6,}).*", "g");

              $('#mensaje').html('');
              document.getElementById("mensaje").classList.remove("alert-success");
              document.getElementById("mensaje").classList.remove("alert-warning");
              document.getElementById("mensaje").classList.remove("alert-primary");
              document.getElementById("mensaje").classList.remove("alert-danger");
              document.getElementById("mensaje").classList.remove("ocultar");

     if (false == enoughRegex.test($(this).val())) {
            document.getElementById("mensaje").classList.add("alert-primary");
             $('#mensaje').html('Ingrese mas caracteres.');

     } else if (strongRegex.test($(this).val())) {
              document.getElementById("mensaje").classList.add("alert-success");

              $('#mensaje').html('Fuerte!');

     } else if (mediumRegex.test($(this).val())) {
              document.getElementById("mensaje").classList.add("alert-warning");
              
             $('#mensaje').html('Media!');
             
     } else {
              document.getElementById("mensaje").classList.add("alert-danger");

             $('#mensaje').html('Débil!');
     }
     return true;
});

</script>
<!-- jQuery -->
<script src="../sistema/vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../sistema/vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../sistema/vista/dist/js/adminlte.min.js"></script>

</body>
</html>
