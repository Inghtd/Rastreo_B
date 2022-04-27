<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reporte de Bolsas </h1>
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