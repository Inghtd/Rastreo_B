<script type="text/javascript" src="lib/jquery.js"></script>
<script type="text/javascript" src="lib/jquery.ui.js"></script>
<link rel="stylesheet" href="lib/jquery.ui.css">

<!--colocamos la informacion de select2-->

<link href="vista/select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="vista/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- Script

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

<!-- jQuery UI -->
<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->

<style type="text/css">
  .ocultar{
    display: none;

  }

  .mostrar{
    display:block;
  }
</style>


<script>
  $( function() {

    // Single Select
    $( "#destinatario" ).autocomplete({
      source: function( request, response ) {
        // Fetch data
        $.ajax({
          url: "destinatario.php",
          type: 'post',
          dataType: "json",
          data: {
            search: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      select: function (event, ui) {
        // Set selection
        $('#destinatario').val(ui.item.label); // display the selected text
        $('#cod_destinatario1').val(ui.item.value); // save selected id to input
        $('#id_ccosto1').val(ui.item.id_ccosto); // save selected id to input
        $('#ccosto_nombre1').val(ui.item.ccosto_nombre); // save selected id to input
        $('#des_direccion1').val(ui.item.ccosto_direccion); // save selected id to input
        $('#agencia').val(ui.item.agencia); // save selected id to input
        $('#ccosto1').val(ui.item.ccosto); // save selected id to input
        return false;
      }
    });
  });
  function split( val ) {
    return val.split( /,\s*/ );
  }
  function extractLast( term ) {
    return split( term ).pop();
  }
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Ingreso de Env&iacute;os</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario de ingreso de env&iacute;os</li>
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
              <h3 class="card-title">Formulario de Ingreso de env&iacute;os</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post">
              <div class="card-body">

                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Remitente: <?php echo $_SESSION['usr_nom'];?></span>
                      <span class="info-box-text">Centro de Costo: <?php echo $_SESSION['ccosto_codigo']." ".$_SESSION['ccosto_nombre'];?></span>
                      <span class="info-box-text">Centro de Costo id: <?php echo $_SESSION['ccosto'];?></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                  <input type="hidden" id="ccosto_ori" name='ccosto_ori' value="<?php echo $_SESSION['ccosto']; ?>">

                <div class="form-group">
                  <br>
                  <input type='text' id='cod_destinatario' readonly class="form-control" value="" />
                  <label for="tipo_envio">Tipo env&iacute;o</label>
                  <select name='tipo_envio' id='tipo_envio' class="form-control" >
                    <option value='I'>INTERNO</option>
                    <option value='E'>EXTERNO</option>
                  </select>
                </div>

                <div>

                <div class="form-group">
                  <span>Nombre Destinatario:</span> 
                  <button type="button"  class="btn btn-info btn-xs" id="bt1" onclick="habilitar('nd','usr_cod1','destinatario1')">Edici&oacute;n</button>
                  <br>
                  
                  <?php //echo  select_usuario()?>
                  <div id="usr_cod1" class="" style="padding-top: 5px;">
                  <select  class="js-example-basic-single js-states form-control usr_cod" id="usr_cod" name="usr_cod"  onchange='changeUsuario()' ></select> 
                  </div>

                  <div id="destinatario1" class="ocultar">
                  <span><input type='text' id='destinatario' class="form-control" placeholder="Nombre Destinatario"></span>
                  </div>


                </div>

                <div class="form-group">
                  <label for="id_ccosto">Departamento Destino</label>
                  <!--input type="text" id="id_ccosto" name="id_ccosto"  class="form-control" onchange='changeCCostoDes()'-->
                  <!--?php echo select_ccosto_simple(); ?-->
                  
                  <select  class="form-control id_ccosto" id="id_ccosto" name="id_ccosto"  ></select>
                </div>

                <!--esto es el centro de codigo del centro de costo destino -->

                <div class="form-group" style="display: none">
                  <label for="id_ccosto">Nombre Departamento Destino</label>
                  <input type="text" id="ccosto_nombre" name="ccosto_nombre" class="form-control" >
                </div>

                <!--esto es el nombre del centro de costo destino -->

                <div class="form-group">
                  <label for="des_direccion">Direcci&oacute;n</label>
                  <input type="text" class="form-control" id="des_direccion" name='des_direccion' placeholder="Direccion del destinatario">
                </div>

                
                <div class="form-group">
                  <label for="agencia">Agencia o Edificio</label> 
                  <button type="button"  class="btn btn-info btn-xs" id="bt1" onclick="habilitar('ae','id_agencia1','agencia1')">Edici&oacute;n</button>

                  <div class="" id="id_agencia1">
                  <select  class="js-example-basic-single js-states form-control id_agencia" id="id_agencia" name="id_agencia"  onchange='changeUsuario()' ></select>
                  </div>

                  <div class="ocultar" id="agencia1">
                  <input type="text" class="form-control" id="agencia" name='agencia' placeholder="Agencia" >
                  </div>

                </div>

                <div class="form-group">

                  <label for="descripcion">Descripci&oacute;n del env&iacute;o</label>
                  <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripci&oacute;n">

                </div>

                <div class="form-group">
                  <label for="id_cat">Categoria del env&iacute;o</label>
                  <?php echo select_categoria(); ?>
                </div>

                <div class="form-group">
                  <label for="vineta">Vi&ntilde;eta</label>
                  <input type="text" class="form-control" id="vineta" name='vineta' placeholder="vi&ntilde;eta"  autocomplete="off">

                  <div role="form" id="form" name="form" method="post">
                    <div class="card-footer">
                      <button id="boton_v" type="button" class="btn btn-outline-dark" onclick="generarVinetas()">
                      Generar Vi&ntilde;eta
                      </button>   <div id="div_msj">  </div>
                    </div>
                  </div>
                </div>
                <!---->
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#modal-default"
                        onclick="procesarformulario(formulario.ccosto_ori.value,
                                                    formulario.id_ccosto.value,
                                                    formulario.destinatario.value,
                                                    formulario.descripcion.value,
                                                    formulario.tipo_envio.value,
                                                    formulario.des_direccion.value,
                                                    formulario.id_cat.value,
                                                    formulario.ccosto_nombre.value,
                                                    formulario.agencia.value,
                                                    formulario.vineta.value
                                                );">
                  Registrar Env&iacute;o
                </button>
              </div>

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
            </form>
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

$('.id_ccosto').select2({
  theme: "classic",
        placeholder: 'Departamento Destino',
        minimumInputLength: 4,
        ajax: {
            url: "../sistema/prg/selects/changeCCosto.php",
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

    $('.usr_cod').select2({
      theme: "classic",
        placeholder: 'Usurio Destinatario',
        minimumInputLength: 4,
        ajax: {
            url: "../sistema/prg/selects/changeUsuario.php",
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

    $('.usr_cod').on('select2:select',function(e){
      var data = e.params.data;
      var str = data.text;
      var usr= str.split("-");
      console.log(str[0]);
      
      $.ajax({
        data:{"q":usr[0]},
        url:"../sistema/prg/selects/ingresoAuto.php",
        type:'get',
        beforeSend: function(){},
        success: function(response){
          var str1 = JSON.parse(response);
          var dt =str1[0];
          console.log(dt['nombrec']);
          var nombre= data.id;
          var costo = data.ida;
      console.log('si es este'+usr[0]);
          //destinatario
          document.getElementById('destinatario').value= dt['id'];
      //centro de costo nombre
      $('#id_ccosto').html('<option value="'+dt['idc']+'">'+dt['nombrec']+'</option>');
      //direcicon destino 
      document.getElementById('des_direccion').value= dt['direccion'];
      //nombre d ela agencia.
      $('#id_agencia').html('<option value="'+dt['ida']+'">'+dt['nombrea']+'</option>');
      document.getElementById('agencia').value= dt['ida'];
      ///$('#').html('<option id_agenciaalue="'+data+'">'+data+'</option>')
        }

      });
        
     
      

     
    });


    
    $('.id_agencia').select2({
      theme: "classic",
        placeholder: 'Agencia Destino',
        minimumInputLength: 3,
        ajax: {
            url: "../sistema/prg/selects/changeAgencia.php",
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
    $('.id_agencia').on('select2:select',function(e){
      var data = e.params.data;
      var nombre= data.id;
      console.log(nombre);
      $('#agencia').val(nombre);
    });

  var cnt=1;

  function habilitar(chk,comb,tex){

      //var x = document.getElementById(chk).checked; 
      
      
      if(cnt==1){
        cnt++;
        console.log(cnt);
        console.log('mostrar: '+tex);
        console.log('ocultar: '+comb);
      document.getElementById(tex).classList.remove('ocultar');
      document.getElementById(comb).classList.add('ocultar');
          
      }else{
        cnt=1;
        console.log(cnt);
        console.log('mostrar: '+comb);
        console.log('ocultar: '+tex);
        document.getElementById(tex).classList.add('ocultar');
        document.getElementById(comb).classList.remove('ocultar');
      }

  }


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