<?php

  include('funciones/funciones.php');
  
  $x1 = new funciones();
  
  $nivel=$_SESSION['nivel'];
  $cliente = $_SESSION['shi_codigo'];
  $par="!='1'";

  if($nivel==5){
    $par="='".$cliente."'";
  }

  $f1='';
  $f2='';

  if(isset($_GET['f1'])){
  $f1=$_GET['f1'].' 00:00:00';
  $f2=$_GET['f2'].' 23:59:59';
  }
  //$data = $x1->orden_data($par);
  
  $data = $x1->reporte_hitorico($f1,$f2);

 
?>
<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }

.tablero{
  text-align: center;
  font-size: 35px;
}
.tablero td{
  font-size: 45px;
  color:blue;
}

</style>

<script src="../sistema/vista/plugins/jquery/jquery.min.js"></script>

<!-- daterange picker -->
<link rel="stylesheet" href="vista/plugins/daterangepicker/daterangepicker.css">
<!-- InputMask -->
<script src="vista/plugins/moment/moment.min.js"></script>
<script src="vista/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

<script src="vista/plugins/daterangepicker/daterangepicker.js"></script>

<script>

  let hoy = new Date();

</script>




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reporte de Cuadre historico.</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#"></a></li>
            <li class="breadcrumb-item active"></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->

    <div class="col-sm-12">
      <div class="input-group-prepend">

      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
      <input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/>
      </div>

      
    <div>

    <br>

    <div class="row"><div class="col-sm-12">
          <div id="ok" class="alert alert-success ocultar" role="alert">
            Prosesando solicitud de arrivo(...)
          </div>

          <table id="cuadre" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

        <thead>
        <tr role="row">
          <tr>
          <th>N°</th>
          <th>Barra</th>
          <th>Código</th>
          <th>Nombre Centro <br> de Costo</th>
          <th>N° de Orden</th>
          <th>Fecha y Hora<br> Ingreso</th>
          <th>Bolsas Enviadas</th>
          <th>Color</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>Fecha</th>
         
          </tr>
          </thead>
          <tbody>
          <?php
          $cnt=0;

            foreach ($data as $row){

              //print_r($row);
              $e=$row['bolsas'];
              $r=$row['bolsa_sc'];
              $cnt++;
              $css="table-success";
              
              if($row['estado']=="INGRESO"){
                $css = "table-danger";
              }
              if($row['codigo_unico']==""){
                $css = "table-warning";
              }


              echo '<tr class="'.$css.'">
                        <td>'.$cnt.'</td>
                        <td>'.$row['barra'].'</td>
                        <td>'.$row['cli_id'].'</td>
                        <td>'.$row['cli_direccion'].'</td>
                        <td>'.$row['orden'].'</td>
                        <td>'.$row['fecha'].'</td>
                        <td>'.$row['codigo_unico'].'</td>
                        <td>'.$row['color'].'</td>
                        <td>'.$row['descripcion'].'</td>
                        <td>'.$row['estado'].'</td>
                        <td>'.$row['fecha_datetime'].'</td>
                        
                    </tr>';

                    /*<td>
                        <a href="index.php?prc=bolsa&accion=cuadre_detalle&id='.$row['id_cliente'].'&orden='.$row['orden'].'" class="btn btn-success">
                        <i class="fa fa-edit fa-1x"></i>
                        </a>
                        </td> */

            }
          ?>
          </tbody>
            <tfoot>
          <tr>
          <th>N°</th>
          <th>Barra</th>
          <th>Código</th>
          <th>Nombre Centro <br> de Costo</th>
          <th>N° de Orden</th>
          <th>Fecha y Hora<br> Ingreso</th>
          <th>Bolsas Enviadas</th>
          <th>Color</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>Fecha</th>
          

          
          </tr>
            </tfoot>

          </table>

      </div>

    </div>
  </section>
</div>



<script src="../sistema/vista/DataTables/datatables.min.js"></script>



<!--buttons for exporting to excel, html5 and flash-->

<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/dataTables.buttons.min.js"></script>
<script src="../sistema/vista/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="../sistema/vista/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/buttons.colVis.min.js"></script>
<script src="../sistema/vista/DataTables/Buttons-1.6.5/js/buttons.html5.min.js"></script>
<script src="../sistema/vista/DataTables/Scroller-2.0.3/js/dataTables.scroller.min.js"></script>



<script>
     

      $(function() {
        $('input[name="daterange"]').daterangepicker({
          opens: 'left'
        }, function(start, end) {
          redireccionar(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'));
        });
      });
      function redireccionar(f1,f2){

        setTimeout(window.location='index.php?prc=bolsa&accion=reporte_historico&f1='+f1+'&f2='+f2,2);
        
      }

    </script>




<script>

      $(document).ready(function() {
        $('#cuadre').DataTable( {
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
              text      :   '<i class="fas fa-file-excel fa-2x"></i>',
              titleAttrs:   'Exportar a Excel',
              className :   'btn btn-success'
            },
          ] /**/

        } );
      } );
    </script>

<script>

</script>


