<?php 
include ("model/model_tab.php");
$db=new model_tab();

?>
<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.ui.js"></script>
<link rel="stylesheet" href="lib/jquery.ui.css">

<!--colocamos la informacion de select2-->

<link href="vista/select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="vista/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Despacho de Bolsa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Despacho de Bolsa</li>
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
            <div class="card-header">
              <h3 class="card-title">Formulario de Despacho de Bolsa!!</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post"><!--ExForm-->
              <div class="card-body">
              <div class="form-group">
                  <label for="comentario">Comentario</label>
                  <input type="text" class="form-control" id="comentario" name='comentario' autocomplete="off" placeholder="comentario"  \>
                </div>

                <div class="form-group mb-2 col-md-2">
                    <label for="color" >Color de Bolsa &nbsp; &nbsp; &nbsp;</label>
                                <select  class="form-control color" id="color" name="color"  onchange='' ></select>
                            

                    </div>

                <div class="form-group">
                  <label for="vineta">Codigo de Bolsa</label>
                  <select class="form-control vineta" id="vineta" name='vineta' onchange='' placeholder="vi&ntilde;eta"  \></select>
                </div>

                    <!-- /.card-body -->

        
                <button id="submitBtn" type="button" class="btn btn-outline-dark " data-toggle="modal" data-target="#modal-default"
                        onclick="procesarBolsa(formulario.vineta.value,formulario.comentario.value)">
                  Despachar
                </button>
              </div>
</form>    
                    <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Ingreso de Env&iacute;o</h4>
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
                         
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
        
                </div>
                <!-- /.card-body -->
                <!--
                <div class="card-footer">
                    <button type="button" class="btn btn-outline-dark" >
                    Procesar Ingreso
                    </button>
                </div>
                -->
            </div><!--ExForm-->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>
<!-- ajax call -->

<script src="../sistema/vista/modulo_B/funciones/funciones_b.js"></script>
<script src="../vista/funciones.js"></script>

<script src="../sistema/vista/modulo_B/funciones/funciones_b.js"></script>
<script src="../vista/funciones.js"></script>
<script>

    $('.color').select2({
      theme: "classic",
        placeholder: 'Color de Bolsa',
        
        ajax: {
            url: "../sistema/prg/selects/color.php",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

    $('.color').on('select2:select',function(e){
      console.log(e.params.data);
      var data = e.params.data;
      var str = data.id;

      $('#vineta').html('');

      console.log(str);
     
      $.ajax({
        data:{"q":str},
        url:"../sistema/prg/selects/lista_bolsas_d.php",
        type:'get',
        beforeSend: function(){},
        success: function(response){
          var str1 = JSON.parse(response);
           console.log(str1);
          var id      = str1.id;
          var nombre  = str1.nombre;
          var bolsa   = '';

          for(var x=0; x<str1.length;x++){

              bolsa = bolsa + '<option value="'+str1[x].id+'">'+str1[x].nombre+'</option>';

          }

          $('#vineta').html(bolsa);
         
     
        }

      });
        
     
      

     
    });
</script>
