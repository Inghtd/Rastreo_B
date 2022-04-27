<?php

$id_cleinte = $_GET['id'];
$orden = $_GET['orden'];

echo "---------------------------------------------------".$_GET['id']."---------".$_GET['orden'];
  include('funciones/funciones.php');
  
  $x1 = new funciones();
  
  $data = $x1->orden_data_detalle($id_cleinte,$orden);
  
  foreach ($data as $row){

    $bolsa=$row['bolsas'];
    $guia=$row['guias'];
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
          <h1>Cuadre de Orden N° <?php echo $orden;?> </h1>
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



    <div class="row" >
    
      <div class="col-sm-12">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bolsas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Ordenes</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

  <table id="detalle" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>
<tr role="row">
          
          <th>N°</th>
          <th>Código Único</th>
          <th>Barra</th>
          <th>Número de Orden</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>fecha y hora</th>
          </tr>
          </thead>
    <?php
    $cnt=0;
  foreach($bolsa as $bls){
                    $cnt++;
                    //print_r($bls);
                    echo '<tr class="'.$css.'">
                    <td>'.$cnt.'</td>
                    <td>'.$bls['codigo_unico'].'</td>
                    <td>'.$bls['barra'].'</td>
                    <td>'.$bls['numero_orden'].'</td>
                    <td>'.$bls['descripcion'].'</td>
                    <td>'.$bls['estado'].'</td>
                    <td>'.$bls['fecha_hora'].'</td>
                </tr>';

                }

                ?>
  <tfoot>
  <tr>
          
          <th>N°</th>
          <th>Código Único</th>
          <th>Barra</th>
          <th>Número de Orden</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>fecha y hora</th>
          </tr>
  </tfoot>
  </table>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

  <table id="example2" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
  <thead>
<tr>
         
          <th>N°</th>
          <th>id_guia</th>
          <th>Barra</th>
          <th>Remitente</th>
          <th>Destinatario</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>fecha y hora</th>
          </tr>
          </thead>

    <?php
    $cnt=0;
    
  foreach($guia as $gi){
                    $cnt++;
                    //print_r($gi);
                    echo '<tr class="'.$css.'">
                    <td>'.$cnt.'</td>
                    <td>'.$gi['id_guia'].'</td>
                    <td>'.$gi['barra'].'</td>
                    <td>'.$gi['remitente'].'</td>
                    <td>'.$gi['destinatario'].'</td>
                    <td>'.$gi['coment'].'</td>
                    <td>'.$gi['descripcion'].'</td>
                    <td>'.$gi['fecha_Datetime'].'</td>
                </tr>';

                }

?>
<tfoot>
  <tr>
    <th>N°</th>
    <th>id_guia</th>
    <th>Barra</th>
    <th>Remitente</th>
    <th>Destinatario</th>
    <th>Descripcion</th>
    <th>Estado</th>
    <th>fecha y hora</th>
  </tr>
</tfoot>
</table>
  </div>

  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...3</div>
</div>



  </section>
</div>

<script src="../sistema/vista/plugins/jquery/jquery.min.js"></script>

<script src="../sistema/vista/DataTables/datatables.min.js"></script>



<!--buttons for exporting to excel, html5 and flash-->

<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script src="../sistema/vista/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../sistema/vista/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/buttons.colVis.min.js"></script>
<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script src="../sistema/vista/DataTables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>



<!--script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script-->


<script>

  $(document).ready(function() {
    $('#detalle').DataTable( {
      //traduccion de la libreria al español
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      //funcion para poder selecionar el estado de forma dinamica.


      //funcion par alos botones de exportacion...
      responsive: "true",
      "scrollX": true,
      //"scrollY": 400,
      "order": [[ 0, "desc" ]],
      dom: 'Bfrtilp',
      buttons:[
        {
          extend    :   'excelHtml5',
          text      :   '<i class="fas fa-file-excel fa-2x"></i>',
          titleAttrs:   'Exportar a Excel',
          className :   'btn btn-success'
        },
      ] /**/

    } );
  } );


  $(document).ready(function() {
    $('#example2').DataTable( {
      //traduccion de la libreria al español
      language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      },
      //funcion para poder selecionar el estado de forma dinamica.


      //funcion par alos botones de exportacion...
      responsive: "true",
      "scrollX": true,
      //"scrollY": 400,
      "order": [[ 0, "desc" ]],
      dom: 'Bfrtilp',
      buttons:[
        {
          extend    :   'excelHtml5',
          text      :   '<i class="fas fa-file-excel fa-2x"></i>',
          titleAttrs:   'Exportar a Excel',
          className :   'btn btn-success'
        },
      ] /**/

    } );
  } );
</script>