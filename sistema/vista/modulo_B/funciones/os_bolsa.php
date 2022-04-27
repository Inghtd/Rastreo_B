<?php

include('funciones.php');
$x1 = new funciones();

$barra = $_POST['barra'];
$comentario = $_POST['comentario'];

$res=0;

$res = $x1->OS_bolsa($barra,$comentario);

$datos=[];
    if($res==0){

        $datos=array(
                'codigo'    => "200",
                'mensjae'   => "se registro la bolsa correctamente. -->" .$barra
        );
    }else{
        $datos=array(
            'codigo'    => "400",
            'mensjae'   => "la bolsa no se pudo registrar ya esta ingresada. -->".$barra
    );
    }

echo json_encode($datos);
?>