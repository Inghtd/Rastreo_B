<?php

include("usr_mante_proc.php");

$x1 = new usuarios();

if(isset($_POST['barra'])){

    $barra=$_POST['barra'];
    $respuesta=$x1->desbloquerar($barra);

    if($respuesta==1){

        $data=array(
            "status"=>200,
            "barra"=>$barra
        );

        echo json_encode($data);
    }else{
        $data=array(
            "status"=>400,
            "barra"=>$barra
        );
    }
}

?>