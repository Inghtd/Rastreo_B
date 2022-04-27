<?php
//session_destroy();

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
    clave1 = document.f1.clave1.value
    clave2 = document.f1.clave2.value

    if (clave1 == clave2)
       alert("Las dos claves son iguales...\nRealizaríamos las acciones del caso positivo")
    else
       alert("Las dos claves son distintas...\nRealizaríamos las acciones del caso negativo")
} 
</script>


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Env&iacute;a</b> de Guatemala
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
<?php
if($resultado==1){?>
      <p class="login-box-msg">cambio efectuado exitosamente.</p>
      <?php
}
if($resultado==0){?>
 <p class="login-box-msg">no se realizo ningun cambio.</p>
    <?php
}


    header("Status: 301 Moved Permanently");
    header("Location: https://rastreoenvia.azurewebsites.net/");
    exit;
    ?>

</body>
</html>