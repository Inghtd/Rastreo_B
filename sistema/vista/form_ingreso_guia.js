function procesarformulario(ccosto_ori,ccosto_des,destinatario,descripcion,vineta){
  ccosto_ori=removeSpecials(ccosto_ori);
  ccosto_des=removeSpecials(ccosto_ori);
  destinatario =removeSpecials(ccosto_ori);
  descripcion =removeSpecials(ccosto_ori);
  vineta=removeSpecials(ccosto_ori);

  var datos_origen={
    "ccosto_ori":ccosto_ori,
    "ccosto_des":ccosto_des,
    "destinatario":destinatario,
    "descripcion":descripcion,
    "vineta":vineta
  };
  $.ajax({
    data:datos_origen,
    url:'../sistema/prg/ingreso_guia.php',
    type: 'post',
    beforeSend: function(){
      //$("#respuesta").html("procesando");
    },
    success: function (response){
      var str = response;
      var res = str.split("-");
      if(res[0]==200)
      {
        $("#respuesta").html(res[1]);
      }else
      {
        $("#respuesta").html("Error form_ingreso_guia<p> "+res[0]+res[1]+"</p>");
      }
    }
  })
}


function limpiesa($cad){
  var outString = sourceString.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');

  for (var i = 0; i < specialChars.length; i++) {
    stringToReplace = stringToReplace .replace(new RegExp("\\" + specialChars[i], 'gi'), '');
  }
}

  function removeSpecials(str)
  {
    var lower = str.toLowerCase();
    var upper = str.toUpperCase();
    var res = "";
    for(var i=0; i<lower.length; ++i) {
      if(lower[i] != upper[i] || lower[i].trim() === '') res += str[i]; }
    return res;
  }




