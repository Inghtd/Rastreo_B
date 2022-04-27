console.log('object');

document.querySelector('bton').addEventListener('click', guia());

function guia(ccosto_ori,
  id_ccosto,
  destinatario,
  descripcion,
  tipo_envio,
  des_direccion,
  id_cat,
  ccosto_nombre,
  agencia){
  console.log('dentro de lafuncion'+id_ccosto);

  ccosto_ori=removeSpecials(ccosto_ori);
  ccosto_des=removeSpecials(ccosto_ori);
  destinatario =removeSpecials(ccosto_ori);
  descripcion =removeSpecials(ccosto_ori);
  vineta=removeSpecials(ccosto_ori);

  var datos_origen=
    "ccosto_ori="+ccosto_ori+"&"+
    "ccosto_des="+ccosto_des+"&"+
    "destinatario="+destinatario+"&"+
    "descripcion="+descripcion+"&"+
    "vineta="+vineta;


  const xhttp= new XMLHttpRequest();

  xhttp.open('POST','../sistema/prg/ingreso_guia.php', true);

  xhttp.send(datos_origen);

  xhttp.onreadystatechange = function (){
    if(this.readyState ==4 && this.status==200){

      console.log(this.responseText);

      let datos = JSON.parse(this.responseText);

      console.log(datos.comentario);



    }
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

function envio_data(ccosto_ori,
                    id_ccosto,
                    destinatario,
                    descripcion,
                    tipo_envio,
                    des_direccion,
                    id_cat,
                    ccosto_nombre,
                    agencia){

}
