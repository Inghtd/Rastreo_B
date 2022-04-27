function solicitar_imagen(barra){
  document.getElementById('carga').classList.remove('ocultar');
  $("#imagen").html('');
  var dtorigen = {'barra':barra};
  $.ajax({
    data: dtorigen,
    url:'vista/img_reporte.php',
    type:'post',
    success:function (response){
      var img = JSON.parse(response);

      if(img.codigo==200){ //codigo satisfactorio//
        document.getElementById('carga').classList.add('ocultar');
        $("#imagen").html('<img src="data:image/jpeg;base64,'+img.imagen+'" style="width:150%;" >');

      }else{ //codigo de error//
        document.getElementById('carga').classList.add('ocultar');
        $("#imagen").html('<div class="alert alert-danger" role="alert">' + img.imagen + '</div>');
      }
    }

  });
}

function actualizar(usr_usuario,usr_nombre,id_ccosto,perfil,id){
  document.getElementById('formulario').classList.add('ocultar');
  document.getElementById('carga').classList.remove('ocultar');
  var datos = {
    'usuario':usr_usuario,
    'nombre':usr_nombre,
    'costo':id_ccosto,
    'perfil':perfil,
    'id_usr':id
  }
  $.ajax({
    data: datos,
    url:'vista/actualizar_usr.php',
    type:'post',
    success:function (response) {
      var usr = JSON.parse(response);

      if(usr.codigo==200){
        document.getElementById('carga').classList.add('ocultar');
        $("#respuesta").html('<br><br><div class="alert alert-success" role="alert">' +
          usr.mensaje +
          '</div>');
      }else{
        document.getElementById('carga').classList.add('ocultar');
        $("#respuesta").html('<br><br><div class="alert alert-secondary" role="alert">' +
          usr.mensaje +
          '</div>');
      }
    }
  });
}
