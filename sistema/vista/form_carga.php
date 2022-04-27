<?php
include("reporte_ingresos.php");

$x1= new model_con();

$x2=$x1->reporte_n();

//print_r($x2);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
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
<table id="table_id" class="display" border="1">
    <thead>
    <tr>
        <th>Transaccion</th>
        <th>Remitente</th>
        <th>destinatario</th>
        <th>zona</th>
        <th>Centro de Costo</th>
        <th>Categoria</th>
        <th>Estado</th>
        <th>mensajero</th>
        <th>consulta</th>
        <th>reimprecion</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($x2 as $row){
            echo "<tr><td>".$row->barra."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->destinatario."</td>
                    <td>".$row->direccion."</td>
                     <td>".$row->centro_costo."</td>
                    <td>".$row->categoria."</td>
                    <td>".$row->estado."</td>
                    <td>".$row->mensajero."</td>
                    <td>Consulta</td>
                    <td><a href='#'>Reimprecion</a></td>

</tr>";
    }
    ?>
    </tbody>
</table>
    <script>$(document).ready( function () {
        $('#table_id').DataTable();
      } );
    </script>


    <!-- jQuery -->
    <script src="vista/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="vista/dist/js/adminlte.min.js"></script>


</body>
</html>
