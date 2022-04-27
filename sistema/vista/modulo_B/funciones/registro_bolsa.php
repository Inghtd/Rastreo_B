<?php
include('funciones.php');
$x1 = new funciones();
$codigo=$_POST['codigo'];
$agencia=$_POST['agencia'];
$destino=$_POST['destino'];
$categoria=$_POST['categoria'];
$color=$_POST['color'];
$direcccion=null;

$existe=$x1->existencia_bolsa($codigo);

    if($existe>0){

        $retorno=array(
                'codigo'=>405,
                'mensaje'=>'El codigo de bolsa esta ingresado en el sistema, puede verificar en el reporte de bolsas ->'.$codigo
            );

        }else{

        $res = $x1->reg_bolsa($codigo,$agencia,$color,$destino,$direcccion,$categoria);


        $retorno=array(
            'codigo'=>200,
            'mensaje'=>'La Bolsa con codigo '.$codigo.' se registro correctamente'
            );
    }

//header('Content-Type: application/json');
echo json_encode($retorno);

?>