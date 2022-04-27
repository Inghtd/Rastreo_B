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



if($nivel>2){
  $x2=$x1->reporte_h2($f1,$f2);
}else {
  $x2=$x1->reporte_h($f1,$f2);
}

//print_r($x2);
include ("model/model_tab.php");
$db=new model_tab();

$tabla='';
$cn=0;
          foreach($x2 as $row){
            $cn++;
            if($row->mensajero==""){
              $msj="<a href='index.php?prc=proc&accion=ld&br=$row->barra' target='_blank' ><i class='fas fa-people-carry fa-2x'></i></a>";
            }else{
              $msj=$row->mensajero;
            }

            $imagen=$row->ge;

            if($imagen==1 or $imagen==2 or $imagen==3){
              $img='<i class="fas fa-eye-slash fa-2x"></i>';
            } else{
              $img='<button type="button" class="btn btn-success btn-sm openBtn" data-toggle="modal" data-target="#myModal" style="width:auto;" onclick="solicitar_imagen('.$row->barra.')">
                    <i class="fas fa-file-image fa-2x"></i></button>
                    ';
            }


          if($nivel>2){
            $tabla.= "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>" . $row->barra . "</td>
                    
                    <td>" . $row->remitente    . "</td>
                    <td>" . $row->remitente_dep. "</td>
                    <td>" . $row->fecha        . "</td>
                    <td>" . $row->destinatario . "</td>
                    <td>" . $row->direccion    . "</td>
                     
                    <td>" . $row->comentario    . "</td>
                    <td>" . $row->estado       . "</td>
                    <td>" . $row->mensajero    . "</td>
                    <td>" . $img               . "</td>
                    <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'><i class='fas fa-print fa-2x'></i></a></td></tr>";

          }else {

            $tabla.= "<tr role='row' class='odd'>
                    <td class='dtr-control sorting_1' tabindex='0'>" . $row->barra . "</td>
                    
                    <td>" . $row->remitente . "</td>
                    <td>" . $row->remitente_dep . "</td>
                    <td>" . $row->fecha . "</td>
                    <td>" . $row->destinatario . "</td>
                    <td>" . $row->direccion . "</td>
                     
                    <td>" . $row->comentario . "</td>
                    <td>" . $row->estado. "</td>
                    <td>" . $msj. "</td>
                    <td>".$img."</td>
                    
                    <td>
                    <div id='ok" . $cn . "' class='alert alert-success ocultar' role='alert'>
                            Prosesando solicitud de arrivo(...)
                            </div>";
                          
                            $tabla.= " <button type='button' class='btn btn-link' id='vineta' name='vineta' autocomplete='off'  placeholder='vi&ntilde;eta' onclick='procesarAR(\"".$row->barra."\");recargar(\"".$cn."\");' >
                          <i class='fas fa-inbox fa-2x'></i></button>
                        
                        <script src='vista/funciones.js'></script>
                        <script>
                            function recargar(c){
                                $('p').show();
                                document.getElementById('ok'+c).classList.remove('ocultar');
                                setTimeout('document.location.reload()',3000);
                        }
                        </script>";
                    
    
                    $tabla.="    </td>
                        <td><a href='prg/generaAcuse.php?v=$row->barra' target='_blank'><i class='fas fa-print fa-2x'></i></a></td>
    
                </tr>";
          }//fin validacion de estado
          }



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
          <h1>Reporte de ingresos historico </h1>
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

    <a href="vista/<?php echo "excel_masivo.php?f1=".$f1."&f2=".$f2;?>" target="_blank" class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></a><br><br>

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
          <tr role="row">
            <th>
              Transaccion</th>
            <th class="sorting" >
              Remitente</th>
            <th>
            Departamento</th>
            <th>
              Fecha</th>
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

            <th>
              Mensajero</th>
            <th>
              Imagen</th>

            <?php
            if($nivel>2){

            }else{
            ?>
              <th>
              Arribar</th>
            <?php
            }
            ?>
            <th>
              Reimpresi&oacute;n</th>
          </tr>
          </thead>
          <tbody id="developers">

          <?php
          echo $tabla;
          ?>

          </tbody>
          <tfoot>
          <tr>
            <th rowspan="1" colspan="1">Transaccion</th>
            
            <th rowspan="1" colspan="1">Remitente</th>
            <th rowspan="1" colspan="1">Departamento</th>
            <th rowspan="1" colspan="1">Fecha</th>
            <th rowspan="1" colspan="1">Destinatario</th>
            <th rowspan="1" colspan="1">Direcci&oacute;n</th>
            <!--th rowspan="1" colspan="1">Centro de Costo</th-->
            <th rowspan="1" colspan="1">Comentario</th>
            <th rowspan="1" colspan="1">Estado</th>
            <th rowspan="1" colspan="1">Mensajero</th>
            <th rowspan="1" colspan="1">Imagen</th>
            <?php
            if($nivel>2){

            }else{
            ?>
            <th rowspan="1" colspan="1">Arribar</th>
            <?php
            }
            ?>
            <th rowspan="1" colspan="1">Reimpresi&oacute;n</th>
          </tr>
          </tfoot>

        </table>

        <div class="col-md-12 text-center">
          <ul class="pagination" id="developer_page"></ul>
        </div>
      </div>

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
