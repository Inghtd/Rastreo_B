<?php
/*
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);*/


include ('vista/control_gs.php');

$x1= new control_gs();

$guias_ruta=$x1->get_guia();

$mensajeros=$x1->get_mensajero();

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
          <h1>Confirmación de entregas </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->


    <!--label>Selecciona el periodo: <?php //echo $f1."-".$f2?></label-->
    <div class="input-group-prepend ocultar">

      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
      <input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/>
    </div>
    <br>


    <div class="row"><div class="col-sm-12">

        <?php

        if(!empty($_POST['barra']) and isset($_POST['mensajero'])){
          $barra=$_POST['barra'];
          $mensajero=$_POST['mensajero'];

          //print_r($barra);
          //print_r($mensajero);
            $i=count($barra);
            $cnt=0;
            while ($cnt<$i){

              //print $barra[$cnt]."<br>";
              $v=$barra[$cnt];
              $cnt++;
              $manifiesto=$x1->gui_mj($v,$mensajero);

            }

          print '<div class="alert alert-success" role="alert">
                       se relaizo la reasignacion de la mensajeria exitosamente!!
                      </div>
                      <script>
                      function redir(){
                          window.location="index.php?prc=control_guia&accion=guias";
                      }
                      setTimeout("redir()",3000);
                            </script>';

        }else{
        ?>

        <div id="load" class="alert alert-success" role="alert">
          <div class="text-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            Cargando informacion...
          </div>
        </div>


        <form name="cambiomj" action="index.php?prc=control_guia&accion=guias" method="post">
        <div class="row">
          <div class="col">


            <div class="container">
              <div class="row align-items-center">
                <div class="col">

                  <div class="form-group">
                  <label for="id_zona"></label>

                </div>

              </div>

                <div class="col">
                    <button class="btn btn-success" type="button" onclick="mostrar('guias','mensajeros')">Aceptar</button>
                    <button class="btn btn-danger" type="button" onclick="mostrar('mensajeros','guias')">Reportar</button>
                    <!--button class="btn btn-success" type="submit" >Procesar</button-->
                  <br>
                </div>

                <div class="col"><br></div>


              </div>

            </div>


            </div>

          <

          <div id="guias" class="col-sm-12">
            <table id="guias" class="table table-hover table-bordered table-striped dataTable dtr-inline display" role="grid" aria-describedby="example1_info">
              <thead>
              <tr>

              <th>Barra</th>
              <th>Remitente</th>
              <th>Dep. Remitente</th>
              <!--th>Destinatario</th>
                <th>Dep. Destinatario</th-->
                <th>Fecha</th>
              <th>Mensajero</th>
              <!--th>direccion</th-->
              </tr>
              </thead>


              <tbody>
                    <?PHP
                          foreach ($guias_ruta as $row){

                            echo '<tr>';
                            echo '';
                            echo '<td><lavel><input type="checkbox" name="barra[]" value="'.$row->idPedido.'">'.$row->idPedido.'</lavel></td>';
                            echo '<td>'.$row->nombre_remitente.'</td>';
                              echo '<td>'.$row->dep_remitente.'</td>';
                            //echo '<td>'.$row->name.'</td>';
                            //echo '<td>'.$row->centro_costo.'</td>';

                            //echo '<td>'.$row->dep_remitente.'</td>';
                            echo '<td>'.$row->createdAt.'</td>';

                            echo '<td>'.$row->mensajero.'</td>';
                            //echo '<td>'.$row->direccion.'</td>';

                          }
                    ?>

              </tbody>

              <tfoot>
              <tr>

                <th>Barra</th>
                <th>remitente</th>
                <th>departamento</th>
                <!--th>destinatario</th-->
                <th>fecha</th>
                <th>Mensajero</th>
                <!--th>direccion</th-->


              </tr>
              </tfoot>
            </table>

          </div>
          <div class="container">
        <div class="row">

          <div id="mensajeros" class="ocultar  col-sm-12">
          <table id="mensajeros" class="table table-hover table-bordered table-striped dataTable dtr-inline display" role="grid" aria-describedby="example1_info">
            <thead>
            <tr>

              <th>n°</th>
              <th>nombre</th>
              <th>numero</th>



            </tr>
            </thead>

            <tbody>

            <?php
            //print_r($mensajeros);
              foreach ($mensajeros as $row1){
                echo '<tr>';
                echo '<td><lavel><input type="radio" name="mensajero" value="'.$row1->id_mensajero.'">'.$row1->id_mensajero.'</lavel></td>';
                echo '<td>'.$row1->nombre.'</td>';
                echo '<td>'.$row1->usr_cod.'</td>';
                echo '</tr>';
              }

            ?>

            </tbody>
            <tfoot>

            <th>n°</th>
            <th>nombre</th>
            <th>numero</th>

            </tfoot>

          </table>
          </div>
        </div>
          </div>


            <div class="col-md-12 text-center">
              <ul class="pagination" id="developer_page"></ul>
            </div>
          </div>
        <?php
        }
        ?>


        </form>

        </div>

        <!--------------------------------------Waning-------------------------------->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Imagen de Recolección</h4>
              </div>

              <div class="text-center ocultar text-primary" id="carga">
                <div class="spinner-border" role="status">
                  <span class="sr-only">Loading...</span>
                </div>  Cargando Imagen...

              </div>
              <div class="modal-body" id="imagen">
                <img id="myImg" alt="Entrega Efectiva" style="width:150%;" >
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <script>
          function imagen(barra) {
            console.log('vista/img_reporte.php?b='+barra);
            $('#myModal').HTML="";
            $('.modal-body').load('vista/img_reporte.php?b='+barra,function () {
              $('#myModal').modal({show:true});
            });
          }
        </script>
        <!--------------------------------------Waning-------------------------------->


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

            setTimeout(window.location='index.php?prc=reportehistorico&f1='+f1+'&f2='+f2,2);
          }

        </script>

        <script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

        <script src="vista/plugins/jquery/jquery.min.js"></script>

        <script src="vista/DataTables/datatables.min.js"></script>

        <script>

          $(document).ready(function() {
            $('table.display').DataTable( {
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
              /*initComplete: function () {
                this.api().columns(7).every( function () {
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
              },*/

              //funcion par alos botones de exportacion...
              responsive: "true",
              "scrollX": "true",
              //"scrollY": 400,
              "order": [[ 0, "desc" ]],
              //dom: 'Bfrtilp',
              /*buttons:[
                {
                  extend    :   'excelHtml5',
                  text      :   '<i class="fas fa-file-excel fa-x2"></i>',
                  titleAttrs:   'Exportar a Excel',
                  className :   'btn btn-success'
                },
              ]*/

            } );
          } );
        </script>
        <?php

        echo '<script>
                          $(function() {
                            document.getElementById("load").classList.add("ocultar");
                            //console.log("entra")
                          });
                      </script>';

        ?>
      <script>
        function mostrar(ocultar,mostrar){
          //lo que ocultamos
          document.getElementById(ocultar).classList.add("ocultar");
          document.getElementById(ocultar).classList.remove("mostrar");
          //lo que mostramos
          document.getElementById(mostrar).classList.remove("ocultar");
          document.getElementById(mostrar).classList.add("mostrar");
        }

      </script>
        <script src="vista/imagen_rp.js"></script>
