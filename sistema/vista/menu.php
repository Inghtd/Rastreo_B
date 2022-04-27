<?php
$shi_codigo=$_SESSION['shi_codigo'];
$shi_nombre=strtoupper($_SESSION['cod_usuario']);

date_default_timezone_set('America/El_Salvador');
$nivel=$_SESSION['nivel'];

?>

<!--Menu Procesos-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-ellipsis-h"></i>
    <p>
      Procesos
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=guia&accion=ingreso'>
        <i class="far fa-circle nav-icon"></i>
        <p>Registro de Sobres</p>
      </a>
    </li>

    <?php
    if($nivel==5 or $nivel==6){
    ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
    ?>
   
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=bolsa&accion=dp_bolsa'>
        <i class="far fa-circle nav-icon"></i>
        <p>Despacho de Bolsa</p>
      </a>
    </li>

    <?php
            }
    ?>



    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=os'>
        <i class="far fa-circle nav-icon"></i>
        <p>Orden de Servicio <span id="cnt"></span></p>
      </a>
    </li>
    <?php
    if($nivel>2){
    ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
    }else{

 
    ?>


    <li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=scan_proceso&acc=0'>
          <i class="far fa-circle nav-icon"></i>
          <p>Procesar Bolsas</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=xls_bolsa'>
          <i class="far fa-circle nav-icon"></i>
          <p>Excel Bolsas</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=bolsas_agencia'>
          <i class="far fa-circle nav-icon"></i>
          <p>Bolsas por Agencia</p>
        </a>
      </li>


    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=ar'>
        <i class="far fa-circle nav-icon"></i>
        <p>Arribo - AR</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=ld'>
        <i class="far fa-circle nav-icon"></i>
        <p>Salida a Ruta - LD</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=dl'>
        <i class="far fa-circle nav-icon"></i>
        <p>Entregas - DL</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=dv'>
        <i class="far fa-circle nav-icon"></i>
        <p>Devoluciones - DV</p>
      </a>
    </li>

  
    <?php
      ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
    }
    ?>


<?php
      ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
      if($nivel!=5){
    ?>

<li class="nav-item">
      <a class="nav-link" href='index.php?prc=proc&accion=carga_xls'>
        <i class="far fa-circle nav-icon"></i>
        <p>Carga Base Envios</p>
      </a>
    </li>

    <?php
      ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
    }
    ?>




  </ul>
</li>



<!--Menu Consultas-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon fas fa-search "></i>
    <p>
      Consultas
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=movimientos'>
        <i class="far fa-circle nav-icon"></i>
        <p>Consulta de movimientos</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=bolsa&accion=recepcion'>
        <i class="far fa-circle nav-icon"></i>
        <p>Consulta de Entregas</p>
      </a>
    </li>


  </ul>
</li>
<!--Menu Reportes-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon far fa-copy"></i>
    <p>
      Reportes e Informes
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=repor_ingresos1'>
        <i class="far fa-circle nav-icon"></i>
        <p>Reporte de ingresos</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=reportehistorico'>
        <i class="far fa-circle nav-icon"></i>
        <p>Reporte de ingresos historico</p>
      </a>
    </li>

    <?php
    if($nivel>2){
      ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
    }else{


    ?>

<li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=cuadre_bolsas'>
          <i class="far fa-circle nav-icon"></i>
          <p>Reporte Cuadre de Bolsas</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=cuadre_n'>
          <i class="far fa-circle nav-icon"></i>
          <p>Reporte Cuadre de Bolsas Neo</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=salida_agencia'>
          <i class="far fa-circle nav-icon"></i>
          <p>Reporte Cuadre de Bolsas <br> Despachadas desde Agencia.</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=bolsa&accion=reporte_historico'>
          <i class="far fa-circle nav-icon"></i>
          <p>Reporte Cuadre de Bolsas <br> Historico.</p>
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=rep_usuario&accion=usuarios'>
          <i class="far fa-circle nav-icon"></i>
          <p>Reporte general de Usuarios</p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=centro_costos&accion=centrocosto'>
          <i class="far fa-circle nav-icon"></i>
          <p>Reporte de Centros de Costos</p>
        </a>
      </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=informe1'>
        <i class="far fa-circle nav-icon"></i>
        <p>Informe general</p>
      </a>
    </li>


    <?php
      ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
    }

    ?>

  </ul>
</li>

<?php
if($nivel>2){
  ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
  ?>
 <li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon far fa-edit"></i>
    <p>
      Mantenimiento
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
  <li class="nav-item dropdown">
        <a class="nav-link"  href="<?php 
        
        echo "index.php?prc=rep_usuario&accion=cambiar&usr='".base64_encode($_SESSION['cod_usuario'])."'";
        
        ?>">
          <i class="fas fa-edit mr-2"></i>
          <p>cambio de contraseña</p>
        </a>
      </li>

    

  </ul>
</li>


<?php

}else{


?>

  <!--Menu Mantenimientos-->
  <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-cogs"></i>
      <p>
        Masivos
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>

    <ul class="nav nav-treeview">

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=control_guia&accion=guias'>
          <i class="fas fa-cog nav-icon"></i>
          <p>Reasignacion de Mensajero</p>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href='index.php?prc=control_guia&accion=g_asignacion_m'>
          <i class="fas fa-users-cog nav-icon"></i>
          <p>Asignacion de Mensajero</p>
        </a>
      </li>

    </ul>
  </li>



<!--Menu Mantenimientos-->
<li class="nav-item has-treeview">
  <a href="#" class="nav-link">
    <i class="nav-icon far fa-edit"></i>
    <p>
      Mantenimiento
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=agencias'>
        <i class="far fa-circle nav-icon"></i>
        <p>Agencias</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=ccostos'>
        <i class="far fa-circle nav-icon"></i>
        <p>Centros de Costos</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=zonas'>
        <i class="far fa-circle nav-icon"></i>
        <p>Zonas</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=mensajero'>
        <i class="far fa-circle nav-icon"></i>
        <p>Mensajeros</p>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=mant&accion=usuarios'>
        <i class="far fa-circle nav-icon"></i>
        <p>Usuarios</p>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href='index.php?prc=bolsa&accion=registro_bolsa'>
        <i class="far fa-circle nav-icon"></i>
        <p>Registro de Bolsas</p>
      </a>
    </li>

  </ul>
</li>


<?php

  ////////////////////////////////////////////////WARNING/////////////////////////////////////////////////////////////
}


?>


<script language="javascript">
  var dt = new Date();

var timestamp=`${
  dt.getFullYear().toString().padStart(4, '0')}-${
    (dt.getMonth()+1).toString().padStart(2, '0')}-${
    dt.getDate().toString().padStart(2, '0')} ${
    dt.getHours().toString().padStart(2, '0')}:${
    dt.getMinutes().toString().padStart(2, '0')}:${
    dt.getSeconds().toString().padStart(2, '0')}`;

  //console.log(timestamp);

  function cargar_push(){

    $.ajax({
      async:true,
      type:"POST",
      url:"index.php?prc=proc&accion=http_push",
      success:function(response){

        var str = JSON.parse(response);
        if(str.cnt==0){
        $('#cnt').html("pendientes: "+str.cnt);
        $('#cnt').addClass('badge badge-success');
        }else{
          $('#cnt').html("pendientes: "+str.cnt);
        $('#cnt').addClass('badge badge-danger');
        }
      }
    });
  }

/*$(document).ready(function(){
  cargar_push();

$.ajax({
        async:true,
        type: "POST",
        url:"index.php?prc=proc&accion=http_push?time1="+timestamp,
        data: {"timestamp":timestamp},
        dataType: "html",
        success: function(data){
          var json = JSON.parse(data);
          console.log(json);
          timestamp=json.timestamp;
          if($timestamp == null){

          }
          else{
            $.ajax({
              sync:true,
        type: "POST",
        url:"index.php?prc=proc&accion=http_push",
        data: {"time":timestamp},
        dataType: "html",
        success: function(data){
          var json = JSON.parse(data);
          console.log(json);
        }
            });
          }
          setTimeout('cargar_push()',1000);
          timestamp=json.timestamp;
        }

    });

});*/

</script>





