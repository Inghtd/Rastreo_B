<?php
include("reporte_ingresos.php");

$x1= new model_con();



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
          <h1>Cuadre de  </h1>
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


        <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
          <thead>
          <tr>
          <th>N°</th>
          <th>Codigo</th>
          <th>Nombre Centro <br> de Costo</th>
          <th>Direccion Centro <br> de Costo</th>
          <th>Encomiendas Enviadas </th>
          <th>Encomiendas Recividas</th>
          <th>Detalle</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $cnt=0;

            foreach ($data as $row){
              $e=rand(1,30);
              $r=rand(1,30);
              $cnt++;
              $css="";
              
              if($e>$r){
                $css = "alert alert-danger";
              }
              echo '<tr class="'.$css.'">
                        <td>'.$cnt.'</td>
                        <td>'.$row->ccosto_codigo.'</td>
                        <td>'.$row->ccosto_nombre.'</td>
                        <td>'.$row->centro_direccion.'</td>
                        <td>'.$e.'</td>
                        <td>'.$r.'</td>
                        <td>
                        <a href="index.php?prc=centro_costos&accion=editarccosto&id='.base64_encode($row->id_ccosto).'" class="btn btn-success">
                        <i class="fa fa-edit fa-2x"></i>
                        </a>
                        </td>
                    </tr>';

            }
          ?>
          </tbody>
          <tfoot>
          <tr>
            <th>N°</th>
            <th>Codigo</th>
            <th>Nombre Centro <br> de Costo</th>
            <th>Direccion Centro <br> de Costo</th>
            <th>Editar</th>
          </tr>
          </tfoot>
        </table>


      </div>

    </div>
  </section>
</div>

<script src="vista/plugins/jquery/jquery.min.js"></script>

<script src="vista/DataTables/datatables.min.js"></script>



<!--buttons for exporting to excel, html5 and flash-->

<script src="vista/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script src="DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
<script src="DataTables/Buttons-1.6.5/js/buttons.colVis.min.js"></script>
<script src="DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script src="DataTables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>



<!--script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script-->


<script>

  $(document).ready(function() {
    $('#example').DataTable( {
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
