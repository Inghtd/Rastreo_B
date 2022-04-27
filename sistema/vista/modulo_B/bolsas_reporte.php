
<?php
try{
include('funciones/funciones.php');

$x1 = new funciones();

$data = $x1->list_bolsas();

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
          <h1>Reporte de ingresos </h1>
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



      <div class="row"><div class="col-sm-12">
          <div id="ok" class="alert alert-success ocultar" role="alert">
            Prosesando solicitud de arrivo(...)
          </div>

          <table id="bolsas" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

          <thead>
            <tr role="row">
              <th>
                n°</th>
              <th>
                Código único</th>
              <th>
                Agencia origen</th>
              <th>
                Destino</th>
              <th>
                Color</th>
              <!--th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Centro de Costo</th-->
                <th>
                Categoría</th>

                <th>
                Fecha</th>
             <th>Editar</th>
            </thead>
            <tbody >


            <?php
            $cn=0;
            foreach($data as $row){
              $cn++;
                echo "<tr>
                <td>".$cn."</td>
                <td>".$row['codigo_unico']."</td>
                <td>".$row['origen']."</td>
                <td>".$row['destino']."</td>
                <td>".$row['color_b']."</td>
                <td>".$row['categori_b']."</td>
                <td>".$row['fecha']."</td>
                <td><a class='btn btn-secondary' href='index.php?prc=bolsa&accion=edicion_bol&codigo_unico=".$row['codigo_unico']."'>Editar Bolsa</a></td>
              </tr>";
              }//fin validacion de estado

            


            ?>

            </tbody>
            <tfoot>
            <tr>
            <th>
                n°</th>
              <th>
              Código único</th>
              <th>
                Pertenese</th>
              <th>
                Destino</th>
              <th>
                Color</th>
            
              <th>
                Categoría</th>

                <th>
                Fecha</th>
                <th>Editar</th>
            </tfoot>

          </table>


        </div>

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
        $('#bolsas').DataTable( {
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
          initComplete: function () {
            this.api().columns(5).every( function () {
              var column = this;
              var select = $('<select><option value="">Tipo</option></select>')
                .appendTo( $(column.header()).empty() )
                .on( 'change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                  );

                  column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
                } );

              column.data().unique().sort().each( function ( d, j ) {
                select.append( '<option value="'+d+'">'+d+'</option>' )
              } );
            } );
          },

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


<?php
}catch(Exception $e){
  echo $e;
}
?>