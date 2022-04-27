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

  .loading {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

/* Transparent Overlay */
.loading:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

    background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
}

.loading:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 150ms infinite linear;
    -moz-animation: spinner 150ms infinite linear;
    -ms-animation: spinner 150ms infinite linear;
    -o-animation: spinner 150ms infinite linear;
    animation: spinner 150ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@-moz-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@-o-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Formulario Registro de Bolsas - RG-B</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item active">Formulario Registro de Bolsas</li>
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
              <h3 class="card-title">Formulario Registro de Bolsas</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" id="formulario" name="formulario" method="post"><!--ExForm-->
              <div class="card-body">

<!-- /.primer y segundo texbox-->
              
                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="categoria" >Categoria de la Bolsa&nbsp; &nbsp; &nbsp;</label>
                                <select  class="form-control categoria" id="categoria" name="categoria"  onchange='' ></select>
                            </div>
                    </div>
                    <div class="form-group mb-2 col-md-2">
                    <label for="color" >Color de Bolsa &nbsp; &nbsp; &nbsp;</label>
                                <select  class="form-control color" id="color" name="color"  onchange='' ></select>
                            

                    </div>
                    <div class="form-group mb-4 col-md-4">
                        <label for="Agencia" >Agencia &nbsp; &nbsp; &nbsp;</label>
                        
                  <select  class="form-control id_agencia" id="id_agencia" name="id_agencia"  onchange='' ></select>
                  

                 
                    
                </div>
                  <!-- /.tercer texbox -->
                  
                      <div class="form-group mb-2 col-md-4">
                              <label for="Destino destino" >Destino &nbsp; &nbsp; &nbsp;</label>
                              <select  class="form-control destino" id="destino" name="destino"  onchange='' ></select>
                          </div>
                         

                          <div class="form-group mb-2 col-md-4">
                              <label for="Codigo destino" >Codigo &nbsp; &nbsp; &nbsp;</label>
                              <input type="text" class="form-control" name="codigo" id="codigo" placeholder="0000 0000 0000 0000">
                              </div>
                              
<br><br>

                <div class="form-inline col-md-12">
                <div class="col-md-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default" onclick="procesarbolsa(
                  formulario.categoria.value,
                  formulario.id_agencia.value,
                  formulario.destino.value,
                  formulario.codigo.value,
                  formulario.color.value
                )">Aceptar</button>
                </div>

                <div class="col-md-4">
                <button type="button" class="btn btn-danger">Cancelar</button>
                </div>


                <div class="col-md-4">
                
                <a type="button" class="btn btn-secondary" href="index.php?prc=bolsa&accion=reporte_bolsas">Reporte de Bolsas</a>
                </div>
                </div>
                </form>
  <!-- /.botones -->


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



  <BR><BR><BR><BR>
                <div class="col-md-12 col-sm-6 col-12">
                  <div class="info-box ">
                    <span class="info-box-icon bg-navy"><i class="far fa-envelope"></i></span>
                        <div class="info-box-content">
                          
                            <div class="form-group" id='msj_div'></div>
                         
                        </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
        
                </div>

                
                         
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
<script>
$('.id_agencia').select2({
      theme: "classic",
        placeholder: 'Agencia Origen',
        minimumInputLength: 2,
        ajax: {
            url: "../sistema/prg/selects/changeAgencia.php?id=1",
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

    $('.destino').select2({
      theme: "classic",
        placeholder: 'Agencia Destino',
        minimumInputLength: 2,
        ajax: {
            url: "../sistema/prg/selects/changeAgencia.php?id=1",
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

    $('.categoria').select2({
      theme: "classic",
        placeholder: 'Categoria de Bolsa',
        
        ajax: {
            url: "../sistema/prg/selects/categoria.php",
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

</script>



