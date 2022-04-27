<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
include('../model/model_con.php');
//$texto = preg_replace('([^A-Za-z0-9 ])', ' ', $texto);

$ccosto_ori     =$_POST["ccosto_ori"];//preg_replace('([^A-Za-z0-9 ])', ' ', $_POST["ccosto_ori"]);
$ccosto_des     =$_POST["id_ccosto"];//preg_replace('([^A-Za-z0-9 ])', ' ', $_POST["id_ccosto"]);//ccosto_des
$destinatario   =preg_replace('([^A-Za-z0-9 ])', '', $_POST["destinatario"]);
$descripcion    =str_replace("'"," ",str_replace('"','',$_POST["descripcion"]));
//ultimos add
$tipo_envio     =preg_replace('([^A-Za-z0-9 ])', '', $_POST["tipo_envio"]);
$des_direccion  =$_POST["des_direccion"];
$id_cat         =$_POST["id_cat"];//preg_replace('([^A-Za-z0-9 ])', '', $_POST["id_cat"]);
$ccosto_nombre  =preg_replace('([^A-Za-z0-9 ])', '', $_POST["ccosto_nombre"]);
$agencia        =$_POST["agencia"];

$des_direccion=str_replace('"','',$des_direccion);
$des_direccion=str_replace("'", " ", $des_direccion);

$descripcion=str_replace('"','',$descripcion);
$descripcion=str_replace("'", " ", $descripcion);

$agencia=str_replace('"','',$agencia);
$agencia=str_replace("'", " ", $agencia);

$vineta=trim($_POST['vineta']);
$db=new model_con();

if($vineta==''){
$vineta= $db->consulta_correlativo();
}

if($ccosto_ori=='' || $ccosto_ori ==NULL){
    $retorno = "Centro costo origen esta vacio";
    $sql="";
}elseif(($ccosto_des=='' || $ccosto_des ==NULL) && $tipo_envio !='E'){
    $retorno = "Centro costo destino esta vacio<br>Env&iacute;o marcado como Interno";
    $sql="";
}elseif($destinatario=='' || $destinatario ==NULL){
    $retorno = array(
        'codigo'=> 409,
        'mensaje'=>"Destinatario esta vacio",
    );
    $sql="";
}elseif($descripcion=='' || $descripcion ==NULL){
    $retorno = array(
        'codigo'=> 409,
        'mensaje'=>"La descripcion esta vacia",
    );

    $sql="";
}elseif($id_cat=='' || $id_cat ==NULL){

    $retorno = array(
        'codigo'=> 409,
        'mensaje'=>"Ingrese una categoria valida, seleccione una de la lista",
    );


    $sql="";
}elseif($des_direccion=='' || $des_direccion ==NULL){

    $retorno = array(
        'codigo'=> 409,
        'mensaje'=>"Direcci&oacute;n destino esta vacia",
    );


    $sql="";
}elseif($vineta=='' || $vineta ==NULL){

    $retorno = array(
        'codigo'=> 409,
        'mensaje'=>"ingrese un numero de vi&ntilde;eta",
    );

}else{
    //Para efecto de envios EXTERNOS se colocara como ccosto_des = 1, el codigo 1 quedaria reservado para ccosto_externo

    if($tipo_envio=='E'){
        $ccosto_des=1;
    }else{
        $ccosto_des=$ccosto_des;
    }

    $con=$db->d_acuse($vineta,$tipo_envio,$destinatario,$ccosto_des,$ccosto_nombre,$des_direccion,$agencia,$descripcion,$id_cat);
    $sql=$db->registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta,$tipo_envio,$des_direccion,$id_cat);


    if (intval($sql)>0)
    {

        $retorno=array(
            'codigo'=>200,
            'mensaje'=>'Ingresado correctamente',
            'barra'=>$vineta,
        );
        //"200-Ingresado correctamente $con -".$ccosto_ori."-".$ccosto_des."-".$destinatario."-".$descripcion."-".$vineta."-".$con;;

    }else{

        $retorno = array(
            'codigo'=> 409,
            'mensaje'=>$sql,
        );
    }
}

echo json_encode($retorno);

//echo $retorno."-".$sql;


