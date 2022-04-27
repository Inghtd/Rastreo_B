<?php
clearstatcache();
  include('funciones/cuadre.php');
  
  $x1 = new cuadre();
  
  $nivel=$_SESSION['nivel'];
  $cliente = $_SESSION['shi_codigo'];
  $par="!='1'";

  if($nivel==5){
    $par="='".$cliente."'";
  }

  //$data = $x1->orden_data($par);
    $f1=date('Y-m-d H:i:s');
    $f2=date('Y-m-d H:i:s');

  if(isset($_GET['f1'])){
    $f1=$_GET['f1'];
    $f2=$_GET['f2'];
    }
  
  $data = $x1->comparacion($f1,$f2);

  $pro = $x1->proceso_actual();

  //$scan=$x1->escaneo('A00770036E070058',1);

  $cnt=0;
  $table='';

  $tabla_e='';
  $tabla_a='';
  $agencia='';
  $cn=0;
  $cn_si=0;
  $cn_no=0;
  $ca=0;
  foreach ($data as $row){

    //print_r($row);
    $e=$row['bolsas'];
    $r=$row['bolsa_sc'];
    $cnt++;
    $css="table-success";
    
    if($row['chk_id']<=1){
      $css = "table-danger";
    }
    if($row['codigo_unico']==""){
      $css = "table-warning";
    }

    list($f,$h) = explode(" ",$row['fecha_datetime']);

    //if($row['chk_id']<$pro[1]){
      if($row['chk_id']<=1){
    $table.= '<tr id="falla" class="'.$css.'">
              <td>'.$cnt.'</td>
              <td>'.$row['barra'].'</td>
              <td>'.$row['origen'].'</td>
              <td>'.$row['agencia_nombre'].'</td>
              <td>'.$row['id_orden'].'</td>
              <td>'.$f.'</td>
              <td>'.$h.'</td>
              <td>'.$row['codigo_unico'].'</td>
              <td>'.$row['color_b'].'</td>
              <td>'.$row['tipo_b'].'</td>
              <td>'.$row['estado'].'</td>
              <td>'.$row['fecha_hora'].'</td>
              
          </tr>';
          $cn_no++;
    }else{

      $table_e.= '<tr id="ok" class="'.$css.'">
      <td>'.$cnt.'</td>
      <td>'.$row['barra'].'</td>
      <td>'.$row['origen'].'</td>
      <td>'.$row['agencia_nombre'].'</td>
      <td>'.$row['id_orden'].'</td>
      <td>'.$f.'</td>
      <td>'.$h.'</td>
      <td>'.$row['codigo_unico'].'</td>
      <td>'.$row['color_b'].'</td>
      <td>'.$row['tipo_b'].'</td>
      <td>'.$row['estado'].'</td>
      <td>'.$row['fecha_hora'].'</td>
      
  </tr>';
  $cn_si++;
    }

    if($agencia!=$row['agencia_nombre'] and $agencia!=''){
      $ca++;
      
      $tabla_a.='<tr>
      <td>'.$ca.'</td>
          <td>'.$agencia.'</td>
          <td>'.$cn.'</td>
          <td>'.$cn_si.'</td>
          <td>'.$cn_no.'</td>
        </tr>';

        //print_r($tabla_a)
        $agencia='';
        $cn=0;
        $cn_no=0;
        $cn_si=0;

        $agencia=$row['agencia_nombre'];
        $cn++;
        $cn_no++;
        $cn_si++;

    }else{
      $agencia=$row['agencia_nombre'];
      $cn++;
    }
    

          /*<td>
              <a href="index.php?prc=bolsa&accion=cuadre_detalle&id='.$row['id_cliente'].'&orden='.$row['orden'].'" class="btn btn-success">
              <i class="fa fa-edit fa-1x"></i>
              </a>
              </td> */

  }
 
  $detalle_b=$x1->reporte_agencias($f1,$f2);
  
  $tabla_bolsa_detalle='';
  $cn_tbd=0;
  $tt_noingresado=0;
  


  foreach($detalle_b as $row_bd){
    $cn_tbd++;
    $tabla_bolsa_detalle.='<tr><td>'.$cn_tbd.'</td>
    <td>'.$row_bd['id_agencia'].'</td>
    <td>'.$row_bd['agencia_nombre'].'</td>
    <td>'.$row_bd['total_ingreso'].'</td>
    <td>'.$row_bd['total_arribo'].'</td>
    <td>'.$row_bd['total_despacho'].'</td>
    <td>'.$row_bd['total_re_ingreso'].'</td>
    <td>'.$row_bd['total_Salida_agencia'].'</td>
    <td>'.$row_bd['Gris'].'</td>
    <td>'.$row_bd['roja'].'</td>
    <td>'.$row_bd['verde_l'].'</td>
    <td>'.$row_bd['negra'].'</td>
    <td>'.$row_bd['nr'].'</td>
    </tr>';
    $tt_noingresado=$row_bd['total_ingreso']+$tt_noingresado;
  }


  /*porcentaje de data*/

  $crudo=$x1->detalle_ejecutivo($f1,$f2);

  $falatante=0;
  $ingresado=0;
  $total_bolsas=0;
  $ingreso=0;
  $arribado=0;
  $despacho=0;
  $re_ingreso=0;
  $salida_age=0;
  $lona=0;
  $gris=0;
  $roja=0;
  $negra=0;
  $negra_rojo=0;

  $tabla_ejecutiva='';

  $tabla_ejecutiva_2='';

  foreach($crudo as $rwejc){

    $total_bolsas=$rwejc['total_b'];
    $ingreso=$rwejc['total_ingreso'];
    $arribado=$rwejc['total_arribo'];
    $despacho=$rwejc['total_despacho'];
    $re_ingreso=$rwejc['total_re_ingreso'];
    $salida_age=$rwejc['total_Salida_agencia'];
    $lona=$rwejc['verde_l'];
    $gris=$rwejc['Gris'];
    $roja=$rwejc['roja'];
    $azul=$rwejc['azul'];
    $negra=$rwejc['negra'];
    $negra_rojo=$rwejc['nr'];
    $leidas=$cnt;//$arribado+$despacho+$re_ingreso+$salida_age;
    $procesadas=$arribado+$despacho+$re_ingreso+$salida_age;

    $falatante=$x1->obtenerPorcentaje($ingreso,$cnt);
    $ingresado=$x1->obtenerPorcentaje($cnt,$cnt);

    $sub_azul=$x1->obtenerPorcentaje($azul,$leidas);
    $sub_gris=$x1->obtenerPorcentaje($gris,$leidas);
    $sub_negra=$x1->obtenerPorcentaje($negra,$leidas);
    $sub_ne_ro=$x1->obtenerPorcentaje($negra_rojo,$leidas);
    $sub_rojo=$x1->obtenerPorcentaje($roja,$leidas);
    $sub_lona=$x1->obtenerPorcentaje($lona,$leidas);
    $sub_total=$sub_azul+$sub_gris+$sub_negra+$sub_ne_ro+$sub_rojo+$sub_lona;
    $total=$azul+$gris+$negra+$negra_rojo+$roja+$lona;

    /*est atbala muestr aun breve resumen de la informaicon*/
    $tabla_ejecutiva.="<tr><td>Bolsas ingresadas</td><td>".$cnt."</td></tr>";
    $tabla_ejecutiva.="<tr><td>Bolsas Leidas</td><td>".$procesadas."</td></tr>";
    $tabla_ejecutiva.="<tr><td>Bolsas con Inconsistencia</td><td>".$procesadas-$cnt."</td></tr>";
    $tabla_ejecutiva.="<tr><td>Total</td><td>".$cnt."</td></tr>";

    $tabla_ejecutiva_2.="<tr><td>".$leidas."</td><td>Color de Bolsa</td><td>100%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$azul."</td><td>Azul</td><td>".$sub_azul."%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$gris."</td><td>Gris</td><td>".$sub_gris."%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$negra."</td><td>Negra</td><td>".$sub_negra."%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$negra_rojo."</td><td>Negro con Rojo</td><td>".$sub_ne_ro."%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$roja."</td><td>Roja</td><td>".$sub_rojo."%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$lona."</td><td>Verde de Lona</td><td>".$sub_lona."%</td></tr>";
    $tabla_ejecutiva_2.="<tr><td>".$total."</td><td>Efectividad</td><td>".$sub_total."%</td></tr>";
    

  }

  //$falatante=$x1->obtenerPorcentaje($tt_noingresado,$cnt);
  //$ingresado=$x1->obtenerPorcentaje($cnt-$tt_noingresado,$cnt);

  /** informaicon de envio de sobres por agencia.*/
  $ccostos_info=$x1->ccostos($f1,$f2);


  $table_ccosto='';
  $total_ccosto=0;
  $cc_info=array();
  $nombres = '';
  $valores;
  $contador = 0;

  foreach($ccostos_info as $rw_cc){
    //print_r($rw_cc);
      $total_ccosto=$total_ccosto+$rw_cc['envios_totales'];
      $cc_info[]=array($rw_cc);
  }

  $porcentaje_cc=0;
  foreach($cc_info as $rw_ccosto){
    //print_r($rw_ccosto);print_r("<br>");
    $porcentaje_cc=$x1->obtenerPorcentaje($rw_ccosto[0]['envios_totales'],$total_ccosto);
      $table_ccosto.="<tr><td>".$rw_ccosto[0]['id_ccosto'];
      $table_ccosto.="</td><td>".$rw_ccosto[0]['ccosto_codigo'];
      $table_ccosto.="</td><td>".$rw_ccosto[0]['ccosto_nombre'];
      $table_ccosto.="</td><td>".$rw_ccosto[0]['envios_totales'];
      $table_ccosto.="</td><td>".$porcentaje_cc." %</td></tr>";

    $nombres .= "'".$rw_ccosto[0]['ccosto_nombre']."', ";
    $valores .= $rw_ccosto[0]['envios_totales'].", ";
    $contador++;
  }
  $nombres = rtrim($nombres, ', ');
  $valores = rtrim($valores, ', ');

 $tt_cc =$x1->obtenerPorcentaje($total_ccosto,$total_ccosto);
  $table_ccosto.="<tr><td>0";
      $table_ccosto.="</td><td>";
      $table_ccosto.="</td><td>Total de bolsas";
      $table_ccosto.="</td><td>".$total_ccosto;
      $table_ccosto.="</td><td>".$tt_cc." %</td></tr>";

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

<!--chart js-->
<script src="../sistema/lib/chart.js"></script>
<!--pdf-->
  <!-- <script src="vista/plugins/libs/html2pdf.bundle.min.js"></script>
  <script src="vista/plugins/libs/html2PDF.js"></script> -->

<script>

  let hoy = new Date();

</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1  class='btn-success'>Cuadre de Recepción de Agencia Proceso actual <?php print_r($pro[0]); echo " ingresados en fecha: ".$f1;?></h1>
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
<?php
 
 $f1=date("m/d/Y",strtotime($f1));
 $f2=date("m/d/Y",strtotime($f2));

    echo '<input type="text" name="daterange"  class="form-control float-right" value="'.$f1.' + - + '.$f2.'" />';

 
?>
<!--input type="text" name="daterange"  class="form-control float-right" value=document.write(hoy) + - + document.write(hoy)/-->
</div>


    <!--table id="test" border="1" style="text-align:center;" class="tablero">
    <thead>
      <tr>
        <th>Arribo</th>
        <th>Despacho</th>
        <th>Reingreso</th>
        <th>Despacho Agencia</th>
      </tr>
    </thead>
    <tbody>

    </tbody>

    </table-->
    <div class="form-group">
                <form id='formulario' method="post" name="formulario" action="index.php?prc=bolsa&accion=procesar_csv" target="_blank" enctype='multipart/form-data'>

                <br><br>
	                <input class='input' name='archivo' type='file' id='archivo'><br>
                    <input type='hidden' name='MAX_FILE_SIZE' value='100000000'>
                    <br>
                    <br>
                    <input class="btn btn-outline-dark " name='enviar' id='enviar' value='Cargar Base' type='submit'>
                
                </form>
                </div>
      
    <div>

    <br>
    <!--button id='btn1' class='btn btn-outline-dark'>no escaneados.</button-->
    <div class="row"><div class="col-sm-12">
          <div id="ok" class="alert alert-success ocultar" role="alert">
            Prosesando solicitud de arrivo(...)
          </div>
  
          <div class="row" >
    
      <div class="col-sm-12">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" onclick="ocultarGrafica();" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">No procesadas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" onclick="ocultarGrafica();" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Procesadas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" onclick="ocultarGrafica();" data-toggle="tab" href="#contact" role="tab" aria-controls="profile" aria-selected="false">Detalle Agencia</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="resumen-tab" onclick="ocultarGrafica();" data-toggle="tab" href="#resumen" role="tab" aria-controls="profile" aria-selected="false">Resumen Agencia</a>
  </li>

<li class="nav-item">
    <a class="nav-link" id="ejecutivo-tab" onclick="ocultarGrafica();" data-toggle="tab" href="#ejecutivo" role="tab" aria-controls="profile" aria-selected="false">Resumen General</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="ccosto-tab"" data-toggle="tab" href="#ccosto" role="tab" aria-controls="profile" aria-selected="false">Resumen Sobres <br> centros de costo</a>
  </li>

</ul>


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


          <table id="cuadre" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

        <thead>
        <tr role="row">
          
          <th>N°</th>
          <th>Barra</th>
          <th>Código</th>
          <th>Nombre Centro <br> de Costo</th>
          <th>N° de Orden</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Bolsas Enviadas</th>
          <th>Color</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>Fecha</th>
         
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
          <th>Barra</th>
          <th>Código</th>
          <th>Nombre Centro <br> de Costo</th>
          <th>N° de Orden</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Bolsas Enviadas</th>
          <th>Color</th>
          <th>Descripcion</th>
          <th>Estado</th>
          <th>Fecha</th>
         
          </tr>
            </tfoot>

          </table>

       </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <table id="cuadre_e" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>
<tr role="row">
 
  <th>N°</th>
  <th>Barra</th>
  <th>Código</th>
  <th>Nombre Centro <br> de Costo</th>
  <th>N° de Orden</th>
  <th>Fecha</th>
  <th>Hora</th>
  <th>Bolsas Enviadas</th>
  <th>Color</th>
  <th>Descripcion</th>
  <th>Estado</th>
  <th>Fecha</th>
 
  </tr>
  </thead>
  <tbody>
  <?php

  echo $table_e;
 
  ?>
  </tbody>
    <tfoot>
    <tr>
 
 <th>N°</th>
 <th>Barra</th>
 <th>Código</th>
 <th>Nombre Centro <br> de Costo</th>
 <th>N° de Orden</th>
 <th>Fecha</th>
 <th>Hora</th>
 <th>Bolsas Enviadas</th>
 <th>Color</th>
 <th>Descripcion</th>
 <th>Estado</th>
 <th>Fecha</th>

 </tr>
    </tfoot>

  </table>
  </div>

  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

  <table id="cuadre_a" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>

  <tr>
 
  <th>N°</th>
  <th>Agencia</th>
  <th>Cantidad Total</th>
  <th>Cantidad escaneadas</th>
  <th>Cantidad no escaneadas</th>
 
  </tr>
  </thead>
  <tbody>
  <?php

  echo $tabla_a;
 
  ?>
  </tbody>
    <tfoot>
    <tr>
 
 <th>N°</th>
 <th>Agencia</th>
 <th>Cantidad Total</th>
 <th>Cantidad escaneadas</th>
 <th>Cantidad no escaneadas</th>

 </tr>
    </tfoot>

  </table>
  </div>


<div class="tab-pane fade" id="resumen" role="tabpanel" aria-labelledby="resumen-tab">

<table id="cuadre_dba" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>
  <tr role="row">
  <th>N°</th>
  <th>id_agencia</th>
  <th>Nombre de la Agencia</th>
  <th>Bolsas Ingreso</th>
  <th>Bolsas Arribo</th>
  <th>Bolsas Despacho</th>
  <th>Bolsas Re-ingreso</th>
  <th>Bolsas Salida Agencia</th>
  <th>Gris</th>
  <th>Roja</th>
  <th>Verde de Lona</th>
  <th>Negra</th>
  <th>Negra con Rojo</th>
  </tr>
  </thead>
  <tbody>
  <?php

  echo $tabla_bolsa_detalle;
 
  ?>
  </tbody>
    <tfoot>
    <tr role="row">

 
<th>N°</th>
<th>id_agencia</th>
<th>Nombre de la Agencia</th>
<th>Bolsas Ingreso</th>
<th>Bolsas Arribo</th>
<th>Bolsas Despacho</th>
<th>Bolsas Re-ingreso</th>
<th>Bolsas Salida Agencia</th>
<th>Gris</th>
<th>Roja</th>
<th>Verde de Lona</th>
<th>Negra</th>
<th>Negra con Rojo</th>
</tr>
    </tfoot>

  </table>

</div>

 

<div class="tab-pane fade" id="ejecutivo" role="tabpanel" aria-labelledby="ejecutivo-tab">

  <table id="cuadre_ejecutivo" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>

  <tr>
 
  <th>Estatus</th>
  <th>cantidad</th>
  </tr>
  </thead>
  <tbody>
  <?php

  echo $tabla_ejecutiva;
 
  ?>
  </tbody>
    <tfoot>
  <tr>
  <th>Estatus</th>
  <th>cantidad</th>
  </tr>
    </tfoot>

  </table>


  <table id="cuadre_ejecutivo_2" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>

  <tr>
 
  <th>Cantidad leida</th>
  <th>Estado del articulo</th>
  <th>porcentaje sobre efectividad</th>
  </tr>
  </thead>
  <tbody>
  <?php

  echo $tabla_ejecutiva_2;
 
  ?>
  </tbody>
    <tfoot>
  <tr>
  <th>Cantidad leida</th>
  <th>Estado del articulo</th>
  <th>porcentaje sobre efectividad</th>
  </tr>
    </tfoot>

  </table>



  </div>


  <div class="tab-pane fade" id="ccosto" role="tabpanel" aria-labelledby="ccosto-tab">

<table id="ccosto_tb" class="table table-hover table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">

<thead>
  <tr role="row">
  <th>id_costo</th>
  <th>Centro de Costo</th>
  <th>Nombre Centro de Costo</th>
  <th>Envíos Totales</th>
  <th>Porcentaje</th>
  </tr>
  </thead>
  <tbody>
  <?php

  echo $table_ccosto;
 
  ?>
  </tbody>
    <tfoot>
    <tr role="row">
 
  <th>id_costo</th>
  <th>Centro de Costo</th>
  <th>Nombre Centro de Costo</th>
  <th>Envíos Totales</th>
  <th>Porcentaje</th>
  </tr>
    </tfoot>

  </table>
</div>

  </div>
  <div class="row d-none" id="cont-myChart" >
    <div class="row"><h5>Reporte de Centros de Costos</h5></div>
    <!-- <div class="col-1 d-flex justify-center align-items-center">
        <button class="btn btn-primary rounded-circle" id="anterior" onclick="anterior()" style="height: 50px; width: 50px;"><i class="fas fa-caret-left " style="font-size: 35px;"></i></button>
    </div>
    <div class="col-10" id="contenedor-chartjs">
        <div class="chartBox">
            <canvas id="myChart"></canvas>
        </div>
        <input type="range" class="col-12 form-range" min="0" max="100" id="bar-range" value="0">
    </div>
    <div class="col-1 d-flex justify-center align-items-center">
        <button class="btn btn-primary rounded-circle" id="siguiente" onclick="siguiente()" style="height: 50px; width: 50px;"><i class="fas fa-caret-right" style="font-size: 35px;"></i></button>
    </div> -->

    <div class="scroll-auto" style="height: 600px; width: 100%; overflow-y:scroll;">
      <div class="chartBox">
          <canvas id="myChart" height="2000"></canvas>
      </div>
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

        setTimeout(window.location='index.php?prc=bolsa&accion=cuadre_n&f1='+f1+'&f2='+f2,2);
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

      $(document).ready(function() {
        $('#cuadre_e').DataTable( {
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

      $(document).ready(function() {
        $('#cuadre_a').DataTable( {
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

      $(document).ready(function() {
        $('#cuadre_dba').DataTable( {
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

      $(document).ready(function() {
        $('#ccosto_tb6').DataTable( {
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
            {
              extend    :   'pdfHtml5',
              text      :   '<i class="fas fa-file-pdf fa-2x"></i>',
              titleAttrs:   'Exportar a PDF',
              className :   'btn btn-danger'
            },
          ] /**/

        } );
      } );
</script>



<?php 
      
    function colors_rand($cantidad){
        $colors = '';

        for ($i = 1; $i <= $cantidad; $i++) {
            $colors .= sprintf("'#%06X'", mt_rand(0, 0xFFFFFF));

            if ($i != $cantidad) {
            $colors .= ', ';
            }
        }

        return $colors;
    }
    
    ?>

    <script>
        const labels = [<?php echo $nombres; ?>];
        const colors = [<?php echo colors_rand($contador); ?>];
        const numbers = [<?php echo $valores; ?>];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Envíos',
                backgroundColor: colors,
                data: numbers,
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
              indexAxis: 'y',
            }
        };
    </script>

    <script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

   

<script>
  let ccostoTab = document.getElementById('ccosto-tab'); 
  let grafica = document.getElementById('cont-myChart');

  ccostoTab.addEventListener('click', (e) => {
    grafica.classList.remove('d-none');
  });


  function ocultarGrafica(){
    grafica.classList.add('d-none');
  }
</script>