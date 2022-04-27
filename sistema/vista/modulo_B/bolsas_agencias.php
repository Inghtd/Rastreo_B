<?php

  include('funciones/funciones.php');
  
  $x1 = new funciones();


  $data_agencia = $x1->reporte_agencias();

  $table='';
  $cn=0;
  foreach($data_agencia as $row){
    $cn++;

    $table.="<tr>
                <td>".$cn."</td>
                <td>".$row['id_agencia']."</td>
                <td>".$row['agencia_nombre']."</td>
                <td>".$row['total_b']."</td>
                <td>".$row['total_ingreso']."</td>
                <td>".$row['total_arribo']."</td>
                <td>".$row['total_despacho']."</td>
                <td>".$row['total_re_ingreso']."</td>
              
                </tr>";
                //  <td>".$row['total_Salida_agencia']."</td>

  }

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
          <h1>Cuadre de Recepción de Agencia </h1>
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

<!--span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
<input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/-->
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
          <th>ID de Agencia</th>
          <th>Nombre de Agencia</th>
          <th>Total de Bolsas</th>
          <th>Bolsas en estado Ingreso</th>
          <th>Bolsas en estado Arribo</th>
          <th>Bolsas en estado Despacho</th>
          <th>Bolsas en estado Re-Ingreso</th>
          <!--th>Bolsas en estado Salida Agencia</th-->
          </tr>
          </thead>
          <tbody>
          <?php

          echo $table;
         
          ?>
          </tbody>
            <tfoot>
          <tr>
          <th>N°</th>
          <th>ID de Agencia</th>
          <th>Nombre de Agencia</th>
          <th>Total de Bolsas</th>
          <th>Bolsas en estado Ingreso</th>
          <th>Bolsas en estado Arribo</th>
          <th>Bolsas en estado Despacho</th>
          <th>Bolsas en estado Re-Ingreso</th>
          <!--th>Bolsas en estado Salida Agencia</th-->
          

          
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

        setTimeout(window.location='index.php?prc=bolsa&accion=salida_agencia&f1='+f1+'&f2='+f2,2);
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

$(document).ready(function(){
  
  $.ajax({
          url : '../sistema/prg/selects/info_bolsa.php',
          dataType: "text",
          success : function(data){
                    var str = JSON.parse(data);
                    console.log(str);

                   $("#test>tbody").append("<tr><td>"+ str.Ingreso +"/"+str.Arribo+"</td><td>"+ str.Ingreso+"/"+str.Despacho+"</td><td>"+ str.Ingreso+"/"+str.Reingreso+"</td><td>"+ str.Ingreso+"/"+str.Salida_agencia+"</td></h3></tr>");
                  //adding row to end and start
                  //$("#test>tbody").prepend("<tr><td>Test Row Prepend</td></tr>");
                }
              }
            );
 });

 setInterval('contador()',1000);

 function contador(){
  $.ajax({
          url : '../sistema/prg/selects/info_bolsa.php',
          dataType: "text",
          success : function(data){
                    var str = JSON.parse(data);
                    console.log(str);
                    $("#test>tbody").html('');
                   $("#test>tbody").append("<tr><td>"+ str.Ingreso +"/"+str.Arribo+"</td><td>"+ str.Ingreso+"/"+str.Despacho+"</td><td>"+ str.Ingreso+"/"+str.Reingreso+"</td><td>"+ str.Ingreso+"/"+str.Salida_agencia+"</td></h3></tr>");
                  //adding row to end and start
                  //$("#test>tbody").prepend("<tr><td>Test Row Prepend</td></tr>");
                }
              }
            );

 }

</script>
