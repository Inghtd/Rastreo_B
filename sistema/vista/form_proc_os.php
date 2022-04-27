<?php 
include ("model/model_tab.php");
$db=new model_tab();

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Orden de Servicio </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de orden de servicio</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-orange">
      
            <!-- /.card-header -->
            <!-- form start -->
            <!--FORM-->
              <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Envio</th>
                                <th>Obs.</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Destinatario</th>
                                <th>Fecha Hora</th>
                                <th>Usuario</th>  
                                <th>Opciones</th>      
                            </tr>
                        </thead>
                        <tbody id="developers">
                        <?php 
                            $id_ccosto = $_SESSION['ccosto'];
                            $id_usr    = $_SESSION['cod_user'];
                            $cliente = $_SESSION['shi_codigo'];
                            $nivel=$_SESSION['nivel'];

                            if($nivel==5 or $nivel==1){
                              //**esta nos devuelve todas las encomiendas d ela agencia. */
                              $sql=$db->consulta_vineta_tb_agencia($id_ccosto,$id_usr);
                            }else{
                              /**esta solo las del usuario espesifico. */
                            $sql=$db->consulta_vineta_tb($id_ccosto,$id_usr);
                            }


                            while ($row=$sql->fetch(PDO::FETCH_NUM))
                            { 
                        ?>
                                <tr>
                                    <td><?php echo $row[9]; ?></td>
                                    <td><?php echo $row[10]; ?></td>
                                    <td><?php echo "<b>A:</b> ".$row[2]."<br> <b>CC:</b>".$row[1]." ".$row[3]; ?></td>
                                    <td><?php echo "<b>A:</b> ".$row[5]."<br> <b>CC:</b>".$row[4]." ".$row[6]; ?></td>
                                    <td><?php echo $row[11]; ?></td>
                                    <td><?php echo $row[8]; ?></td>
                                    <td><?php echo $row[7]; ?></td>
                                    <td>
                                    <form role="form" id="formulario_<?php echo $row[0];?>" name="formulario_<?php echo $row[0];?>" method="post">
                                        <div  id="div_<?php echo $row[0];?>" name="div_<?php echo $row[0];?>">
                                             <!--div_<?php echo $row[0];?>-->
                                            <input type="hidden" id="id_vineta" name='id_vineta' value="<?php echo $row[0];?>">

                                            <input type="button" class="btn btn-danger" value="Borrar" onclick="delRegistro(formulario_<?php echo $row[0];?>.id_vineta.value)" />
                                        </div>
                                    </form>
                                                            <!--edicion de los acuses-->
                                                            <br>
                                    <form role="form" id="for_<?php echo $row[0];?>" name="for<?php echo $row[0];?>" method="post" action="index.php?prc=guia&accion=edt">
                                        <div  id="div_<?php echo $row[0];?>" name="div_<?php echo $row[0];?>">
                                             <!--div_<?php echo $row[0];?>-->
                                            <input type="hidden" id="barra" name='barra' value="<?php echo $row[9];?>">

                                            <input type="submit" class="btn btn-success" value="Editar"  />
                                        </div>
                                    </form>
                                    </td>
                                </tr>
                         <?php   
                            } 
                            if($nivel==5 or $nivel==1){
                              $data = $db->consulta_vineta_bolsas($cliente);
                              echo "<tr><td colspan='8'><h2>Bolsas preparadas</h2></td></tr>";


                              foreach($data as $rw){

                                  echo "<tr>";
                                  echo "<td>".$rw['barra']."</td>";
                                  echo "<td>".$rw['descripcion']."</td>";
                                  echo "<td>".$rw['cli_id']." - ".$rw['cli_direccion']."</td>";
                                  echo "<td>".$rw['agencia_codigo']." - ".$rw['agencia_nombre']."</td>";
                                  echo "<td>".$rw['fecha']."</td>";
                                  echo "<td colspan='3'>".$rw['codigo_unico']."</td>";
                                  echo "</tr>";

                              }


                            }
                         ?>
                        </tbody>
                    </table>
                    <?php
                    if($nivel==5 or $nivel==1){
                       //$data = $db->consulta_vineta_bolsas($id_ccosto,$id_usr, $cliente);
                    ?>
                    <br>
                    
                    <table>

                    <?php
                        
                    ?>

                    </table>
                    <?php
                    }
                    ?>
                    <div class="col-md-12 text-center">
                        <ul class="pagination" id="developer_page"></ul>
                    </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
              <form role="form" id="formulario" name="formulario" method="post">
              
                <input type="hidden" id="id_cli" name='id_cli' value="<?php echo $_SESSION['shi_codigo']; ?>">
                <input type="hidden" id="id_ccosto" name='id_ccosto' value="<?php echo $id_ccosto;?>">
                <?php session_start();
                      $lvl=$_SESSION['nivel'];
                            if( $lvl=='2' or $lvl=='3'){
                ?>


                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarOS(formulario.id_cli.value,
                                            formulario.id_ccosto.value,
                                            '0')">
                                            Procesar Orden 
                </button>

                  <?php
                            } elseif($lvl=='1' or $lvl=='5'){
                                ?>

                        <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarOS(formulario.id_cli.value,
                                            formulario.id_ccosto.value,
                                            '1')">
                                            Procesar Ordenes y Bolsas
                        </button>
                      <?php
                            }

                            ?>

                  
                </form>
              </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Creacion de Orden</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="respuesta">
                                
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="recargarTab()">Cerrar</button>
                      <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
             <!--FORM-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->
<script src="vista/funciones.js"></script>

<script>
   function cargar_push_form(){

$.ajax({
  async:true,
  type:"POST",
  url:"index.php?prc=proc&accion=http_push",
  success:function(response){
    var str = JSON.parse(response);
    console.log(str);
    if(str.cnt==0){
      $('#cnt').html('');
      $('#cnt').html("pendientes: "+str.cnt);
        $('#cnt').addClass('badge badge-success');
    }else{
    $('#cnt').html('');
    $('#cnt').html("pendientes: "+str.cnt);
    $('#cnt').addClass('badge badge-danger');
    }
  }
});
}
</script>
