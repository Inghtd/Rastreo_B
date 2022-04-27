<?php

//$id_cleinte = $_GET['id'];
//$orden = $_GET['orden'];
  include('funciones/funciones.php');
  
  $x1 = new funciones();
  
if(isset($_POST['barra'])){

  $barra  = $_POST['barra'];
  $coment = $_POST['coment'];

  $x1->reportar_orden($barra,$coment);
  
}

if(isset($_POST['vinetas'])){

  //print_r($_POST['vinetas']);

  if(isset($_POST['td'])){
    $x1->up_envios();
  }else{
    
    
  }

  $vineta=$_POST['vinetas'];

  foreach($vineta as $barra){
    $comentario='Envío resivido exitosamente';
    //print "------------------------------------".$barra;
    $x1->reportar_orden($barra,$coment);

    }
  

}

if(isset($_POST['confirmar'])){

  $x1->up_envios_b();

}




if(isset($_POST['bolsas']))

  Echo "----------------------------------------------------------------";
  $orden = $x1->ordenes_usr();
  //Echo "----------------------------------------------------------------".$orden;
  $bolsa = $x1->bolsas_dp();
  
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
          <h1>Recepcion de encomiendas</h1>
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
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Recepcion de Ordenes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Recepcion de Bolsas</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <br>
  <form name="todos" method="post" action="">
    <button type="submit" class="btn btn-success" value='guias' name="aceptar">Aceptar</button>
    <br>
  <br>
  <table id="example" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
  <thead>
          <tr>
          
          <th><input type="checkbox" id="td" name="td" value="todos">N°</th>
          <th>Barra</th>
          <th>Remitente</th>
          <th>Descripcion del envío</th>
          <th>Estado</th>
          <th>Fecha y hora</th>
          <th>proceso</th>
          </tr>
          </thead>
    <?php
    $cnt=0;
   
  foreach($orden as $ord){
      
                    $cnt++;
                    //print_r($bls);
                    echo '<tr class="'.$css.'">
                    <td><input type="checkbox" id="vinetas" name="vinetas[]" value="'.$ord['barra'].'">'.$cnt.'</td>
                    <td>'.$ord['barra'].'</td>
                    <td>'.$ord['remitente'].'</td>
                    <td>'.$ord['comentario'].'</td>
                    <td>'.$ord['descripcion'].'</td>
                    <td>'.$ord['fecha_date'].'</td>
                    <td>';
                    ?>
                    <form name="reportar" method="post" action="">
                    <button type='button' data-toggle="modal" data-target="#modal-default-<?php echo $ord["barra"]; ?>" class='btn btn-danger' id='vineta' name='vineta' autocomplete='off'  placeholder='vi&ntilde;eta' onclick='("<?php echo $ord["barra"]; ?>");recargar("<?php echo $cn;?>");' >
                    <i class='fas fa-flag fa-2x'></i></button>
                    </form>
                    <div class="modal fade" id="modal-default-<?php echo $ord["barra"]; ?>">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Reportar la Orden <?php echo $ord["barra"]; ?></h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body" id="respuesta">

                                          <form name="form-<?php echo $ord["barra"];?>" method="post" action="index.php?prc=bolsa&accion=recepcion">

                                          <input type="hidden" name="barra" id="barra" value="<?php echo $ord["barra"]; ?>">
                                          <textarea id="coment" name="coment" rows="2" cols="50">
                                          Describa el inconveniente...
                                          </textarea>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-primary" >Guardar</button>
                                        </form>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>

                                          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>


                    </td>
                </tr>
              <?php
                }

                ?>
  <tfoot>
  <tr>
  <th>N°</th>
          <th>Barra</th>
          <th>Remitente</th>
          <th>Descripcion del envío</th>
          <th>Estado</th>
          <th>Fecha y hora</th>
          <th>proceso</th>
  </tfoot>
  </table>
  </form>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

  
  <form name="todos" method="post" action="">
    <button type="submit" class="btn btn-success" value='guias' name="confirmar">Aceptar Todos</button>
  </form>
  <br>

  <table id="example2" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example2_info">
  <thead>
          <tr>
          <th>N°</th>
          <th>Código único </th>
          <th>Barra</th>
          <th>Número de orden</th>
          <th>Descripción</th>
          <th>Estado</th>
          <th>Fecha y Hora</th>
          <th>proceso</th>
          <th></th>
          </tr>
          </thead>

    <?php
    $cnt=0;
    
  foreach($bolsa as $bo){
                    $cnt++;
                    //print_r($gi);
                    echo '<tr class="'.$css.'">
                    <td>'.$cnt.'</td>
                    <td>'.$bo['codigo_unico'].'</td>
                    <td>'.$bo['barra'].'</td>
                    <td>'.$bo['numero_orden'].'</td>
                    <td>'.$bo['descripcion'].'</td>
                    <td>'.$bo['estado'].'</td>
                    <td>'.$bo['fecha_hora'].'</td>';
                    ?>
                    <td>
                    <button type='button' data-toggle="modal" data-target="#modal-default-<?php echo $bo["barra"]; ?>" class='btn btn-danger' id='vineta' name='vineta' autocomplete='off'  placeholder='vi&ntilde;eta' onclick='("<?php echo $ord["barra"]; ?>");recargar("<?php echo $cn;?>");' >
                    <i class='fas fa-flag fa-2x'></i></button>

                    <div class="modal fade" id="modal-default-<?php echo $bo["barra"]; ?>">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Reportar la Orden <?php echo $bo["barra"]; ?></h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body" id="respuesta">

                                          <form name="form-<?php echo $bo["barra"];?>" method="post" action="index.php?prc=bolsa&accion=recepcion">

                                          <input type="hidden" name="barra" id="barra" value="<?php echo $bo["barra"]; ?>">
                                          <textarea id="coment" name="coment" rows="2" cols="50">
                                          Describa el inconveniente...
                                          </textarea>

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-primary" >Guardar</button>
                                        </form>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar</button>

                                          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>


                    </td>
                    
                </tr>
              <?php
                }

                ?>
<tfoot>
<tr>
          <th>N°</th>
          <th>Código único </th>
          <th>Barra</th>
          <th>numero_orden</th>
          <th>Descripción</th>
          <th>Estado</th>
          <th>Fecha y Hora</th>
          <th>proceso</th>
          <th></th>
          </tr>
  </tfoot>
</table>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...3</div>
</div>


<div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Ingreso de Bolsa</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body" id="respuesta">

                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
                                          <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
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

<script src="../sistema/vista/modulo_B/funciones/funciones_b.js"></script>

<script>

  $(document).ready(function() {
    $('#example').DataTable( {
      "paging":   false,
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


<script>

  $(document).ready(function() {
    $('#example2').DataTable( {
      "paging":   false,
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

<script>
      $(function(){
        $('#td').change(function() {
          $('input[type=checkbox]').prop('checked', $(this).is(':checked'));
        });
      });
    </script>