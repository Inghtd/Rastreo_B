function procesarbolsa(categoria,agencia,destino,codigo,color){

    var datos_origen={
        "categoria":categoria,
        "agencia":agencia,
        "destino":destino,
        "codigo":codigo,
        "color":color
      };
     
      $.ajax({
          data:datos_origen,
          url:'../sistema/vista/modulo_B/funciones/registro_bolsa.php',
          type: 'post',
          beforeSend:function(){

          },
          success: function(response){
              var str = JSON.parse(response);

             //console.log(str.mensaje);

             if(str.codigo==200)
             {
                 //respuesta satisfactoria
               $('#respuesta').html('<div class="alert alert-success"><b>'+str.mensaje +'.</b></div>');
             }else
             {
  
              $('#respuesta').html('<div class="alert alert-danger"><b>'+str.mensaje +'.</b></div>');
                 //respuesta de error
               
               
             }

          }
      });/**/
}

function procesarBolsa(barra,comentario){
    
    var datos_origen={
        "barra": barra,
        "comentario":comentario
    }

    $.ajax({
        data:datos_origen,
        url:'../sistema/vista/modulo_B/funciones/os_bolsa.php',
        type: 'post',
        beforeSend:function(){

        },
        success: function(response){
            var str = JSON.parse(response);

           console.log(str.mensaje);

           if(str.codigo==200)
           {
               //respuesta satisfactoria
             $('#respuesta').html('<div class="alert alert-success"><b>'+str.mensjae +'.</b></div>');
           }else
           {

            $('#respuesta').html('<div class="alert alert-danger"><b>'+str.mensjae +'.</b></div>');
               //respuesta de error
             
             
           }
        
           

        }

    });
}

function procesar_ordenes(){
    var datos_origen={
        "barra": barra,
        "comentario":comentario,
        "proceso": proceso
    }

    $.ajax({
        data:datos_origen,
        url:'../sistema/vista/modulo_B/funciones/procesos.php',
        type: 'post',
        beforeSend:function(){

        },
        success: function(response){

            var str = JSON.parse(response);

        }
    });

}

function procesar_bolsas(){

    
}


function reportar(barra,comentario){

    console.log(barra);
    console.log(comentario);
    /*
    var datos_origen={
        "barra": barra,
        "comentario":comentario,
        "proceso": proceso
    }

    $.ajax({
        data:datos_origen,
        url:'../sistema/vista/modulo_B/funciones/procesos.php',
        type: 'post',
        beforeSend:function(){

        },
        success: function(response){

            var str = JSON.parse(response);

        }
    });*/

}