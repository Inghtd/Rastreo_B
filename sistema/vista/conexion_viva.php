<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

date_default_timezone_set ( 'America/Guatemala');

ini_set("date.timezone", 'America/Guatemala');

include("historico.php");

$x1= new historico_ingresos();



/*
   $host="13.90.202.204";
    $port=20205;
    set_time_limit(0);

    $sock = socket_create(AF_INET,SOCK_STREAM,0) or die("no se pudo crear soket\n");
    $result = socket_bind($sock,$host,$port) or die("no se pudo crear el bind el socket.\n");

    $result = socket_listen($sock,3) or die("no se pudo escuchar.\n");
    echo "Se escucha la conexion";

    class push
    {
        function readline()
        {
            return rtrim(fgets((STDIN)));
        }
    }

    do{
        $accept = socket_accept($sock) or die("no se resivio la conexion entrante○\n");
        $msg = socket_read($accept, 1024) or die("no peudes leer el input\n");

        $msg = trim($msg);
        echo "cliente dice:\t".$msg."\n\n";

        $line = new chat();
        echo "enter reply: \t";
        $reply = $line->readline();

        socket_write($accept,$reply,strlen($reply)) or die("no se pudo escribir el output\n");
    }while(true);

    socket_close($accept,$sock);
    */
    $cnt=$x1->push_info();
    $respuesta=array(
        'codigo'=> 200,
        'cnt'=>$cnt,
    );


    echo json_encode($respuesta);
?>