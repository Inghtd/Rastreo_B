<?php
/*
ini_set ("display_errors","1" );
error_reporting(E_ALL);
*/
try{
include("reporte_ingresos.php");

$x1= new model_con();
//109412
$nivel=$_SESSION['nivel'];

if(isset($_GET['f1'])){
  $f1=$_GET['f1']." 00:00:00";
  $f2=$_GET['f2']." 23:59:59";
}else{
  $f2=date('Y-m-d')." 23:59:59";
  $f1=date('Y-m-d')." 00:00:00";
}

if($nivel>2){
  $x2 = $x1->reporte_n2();
}else {
  $x2 = $x1->reporte_n($f1,$f2);
}

//print_r($x2);
include ("model/model_tab.php");
$db=new model_tab();
?>

<!-- jQuery -->
<script src="vista/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vista/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="vista/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="vista/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="vista/dist/js/demo.js"></script>-->
<!-- daterange picker -->
<link rel="stylesheet" href="vista/plugins/daterangepicker/daterangepicker.css">
<!-- InputMask -->
<script src="vista/plugins/moment/moment.min.js"></script>
<script src="vista/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

<script>

  let hoy = new Date();

</script>


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


    <label>Selecciona el periodo: <?php echo $f1."-".$f2?></label>
    <div class="input-group-prepend">

      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
      <input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/>
    </div>
    <br>
    <br>



      <div class="row"><div class="col-sm-12">
          <div id="ok" class="alert alert-success ocultar" role="alert">
            Prosesando solicitud de arrivo(...)
          </div>

          <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

            <thead>
            <tr role="row">
              <th>
                Transaccion</th>
              <th>
                Remitente</th>
              <th>
                Departamento</th>
              <th>
                Destinatario</th>
              <th>
                Direcci&oacute;n</th>
              <!--th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">
                Centro de Costo</th-->
              <th>
                Comentario</th>
              <th>
                Estado</th>
              <?php
              if($nivel>2){

              }else{
              ?>
              <th>
                Mensajero</th>
              <th>
                Arribar</th>
              <?php

              }
              ?>

              <th>
                Reimpresi&oacute;n</th>
            </tr>
            </thead>
            <tbody >

            <?php
            $cn=0;
            foreach($x2 as $row){
              $cn++;
              if($row->mensajero==""){
                  $msj="<a href='index.php?prc=proc&accion=ld&br=$row->barra' target='_blank' ><i class='fas fa-people-carry fa-2x'></i></a>";
              }else{
                $msj=$row->mensajero;
              }

            if($nivel>2) {
              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->remitente_dep."</td>
                    <td>".$row->destinatario."</td>
                    
                    <td>".$row->direccion."</td>
                     
                    <td>".$row->comentario."</td>
                    <td>".$row->estado."</td>
                    <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'><i class='fas fa-print fa-2x'></i></a></td>

                    </tr>";

            }else{
              if($row->estado=="ARRIBO" or $row->estado=="INGRESO"){
              echo "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>".$row->barra."</td>
                    <td>".$row->remitente."</td>
                    <td>".$row->remitente_dep."</td>
                    <td>".$row->destinatario."</td>
                    
                    <td>".$row->direccion."</td>
                     
                    <td>".$row->comentario."</td>
                    <td>".$row->estado."</td>
                    <td>".$msj


                ."</td>
                    <td>
                    <div id='ok".$cn."' class='alert alert-success ocultar' role='alert'>
                            Prosesando solicitud de arrivo(...)
                        </div>";
                        ?>
                    <button type='button' class='btn btn-link' id='vineta' name='vineta' autocomplete='off'  placeholder='vi&ntilde;eta' onclick='procesarAR("<?php echo $row->barra;?>");recargar("<?php echo $cn;?>");' >
                      <i class='fas fa-inbox fa-2x'></i></button>
                    
                    <script src='vista/funciones.js'></script>
                    <script>
                        function recargar(c){
                            $('p').show();
                            document.getElementById('ok'+c).classList.remove('ocultar');
                            setTimeout('document.location.reload()',3000);
                    }
                    </script>
                <?php

                echo"    </td>
                    <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'><i class='fas fa-print fa-2x'></i></a></td>

            </tr>";
              }//fin validacion de estado

              }


            }
            ?>

            </tbody>
            <tfoot>
            <tr>
              <th>Transaccion</th>
              <th>Remitente</th>
              <th>Departamento</th>
              <th>Destinatario</th>
              <th>Direcci&oacute;n</th>
              <th>Comentario</th>
              <th>Estado</th>
              <?php
              if($nivel>2){

              }else{
              ?>
              <th>Mensajero</th>
              <th>Arribar</th>
              <?php
              }
              ?>
              <th>Reimpresi&oacute;n</th>
            </tr>
            </tfoot>

          </table>


        </div>

      </div>


      <script>
      $(document).ready(function () {
        //showGraph();
      });


      $(function() {
        $('input[name="daterange"]').daterangepicker({
          opens: 'left'
        }, function(start, end) {
          redireccionar(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
        });
      });
      function redireccionar(f1,f2){

        setTimeout(window.location='index.php?prc=repor_ingresos1&f1='+f1+'&f2='+f2,2);
      }

    </script>

    <script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

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
          initComplete: function () {
            this.api().columns(6).every( function () {
              var column = this;
              var select = $('<select><option value="">Estado</option></select>')
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