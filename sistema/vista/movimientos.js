function buscarMovimientos(vineta)
{
    //console.log('aqui');    
    $("#hiddenform").css("display", "block");
    var datos_origen={
        "vineta":vineta
    };
    $.ajax({
        data:datos_origen,
        url:'../sistema/prg/gen_Movimientos.php',
        type: 'post',
        beforeSend: function(){
        },
        success: function (response){
            var str = response;
          document.getElementById('ok').classList.add('ocultar');
            $("#hiddenform").html(str)
        }
    })
}
