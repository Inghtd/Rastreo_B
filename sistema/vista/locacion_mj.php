<?php
include("historico.php");

$nivel=$_SESSION['nivel'];




$x1= new historico_ingresos();

if(isset($_GET['f1'])){
  $f1=$_GET['f1'];
  $f2=$_GET['f2'];
}else{
  $f1=date('Y-m-d');
  $f2=date('Y-m-d');
}




  $x2=$x1->reporte_rutas();


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
          <h1>Rutas programadas automaticamente.</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->




    <div class="row"><div class="col-sm-12">
        <div id="load" class="alert alert-success" role="alert">
          <div class="text-center">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            Cargando informacion...
          </div>
        </div>

        <div class="row"><div class="col-sm-12">
            <div id="ok" class="alert alert-success ocultar" role="alert">
              Prosesando solicitud de arrivo(...)
            </div>







            <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
              <thead>
                <tr>
                  <th>n°</th>
                  <th>Ruta</th>
                </tr>
              </thead>

              <tbody>

                  <?php
                    $cnt=0;
                    foreach($x2 as $row) {
                      $cnt++;
                      $estado=" Desconocido.";
                      if($row->estado==1){
                        $estado=" Activa";
                      }else{
                        $estado=" Inactiva";
                      }
                      echo "</tr><td>".$cnt."</td>";
                      echo '<td>
                            <a href="index.php?prc=gps&accion=detalle_ruta&id='.$row->id_ruta.'&nmr='.$row->nombre_ruta.'">
                           <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                          <div class="info-box-content">
                          <span class="info-box-text">'.$row->nombre_ruta.'</span>
                              <span class="info-box-number"> Estado de la ruta'.$estado.'</span>
  
                              <div class="progress">
                              <div class="progress-bar" style="width: 50%"></div>
                               </div>
                             <span class="progress-description">
                                  '.$row->des_ruta.'
                                  </span>
                           </div>
                           <!-- /.info-box-content -->
                       </div></a></td></tr>';
                    }
                  ?>




              </tbody>

              <tfoot>
              <tr>
                <th>n°</th>
                <th>Ruta</th>
              </tr>
              </tfoot>
            </table>

            <div class="col-md-12 text-center">
              <ul class="pagination" id="developer_page"></ul>
            </div>
          </div>

        </div>



        <script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

        <script src="vista/plugins/jquery/jquery.min.js"></script>

        <script src="vista/DataTables/datatables.min.js"></script>

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


              //funcion par alos botones de exportacion...
              responsive: "true",
              "scrollX": true,
              //"scrollY": 400,
              "order": [[ 0, "desc" ]],
              dom: 'Bfrtilp',
              buttons:[
                {
                  extend    :   'excelHtml5',
                  text      :   '<i class="fas fa-file-excel fa-x2"></i>',
                  titleAttrs:   'Exportar a Excel',
                  className :   'btn btn-success'
                },
              ]

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
        <script src="vista/imagen_rp.js"></script>
