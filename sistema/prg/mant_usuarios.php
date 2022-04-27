<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include('../model/model_con.php');
//$usr_cod    = $_POST["usr_cod"];
$usr_cod2   = $_POST["usr_cod2"];
$usr_nombre = $_POST["usr_nombre"];
$usr_pass   = $_POST["usr_pass"];
$id_ccosto  = $_POST["id_ccosto"];
$perfil     = $_POST["perfil"];
$shiper     = $_POST["agencia"];

$db = new model_con();

//consulta existe usuario...
$existe = $db->consulta_usuario($usr_cod2);

if($shiper!=""){
    //echo "problemas ---".$shiper." ---";
}else{
    //echo "esta vacio el shiper ---".$shiper." ---";
$shiper='1';
}

if($existe > 0){
    $retorno = "Codigo de usuario ya existe en base";
    $sql="";
}elseif($usr_cod2=='' || $usr_cod2 ==NULL){
    $retorno = "Codigo de usuario esta vacio";
    $sql="";
}elseif($usr_nombre=='' || $usr_nombre ==NULL){
    $retorno = "Nombre de usuario esta vacio";
    $sql="";
}elseif($usr_pass=='' || $usr_pass ==NULL){
    $retorno = "Contrase&ntilde;a de usuario esta vacio";
    $sql="";
}elseif($id_ccosto=='' || $id_ccosto ==NULL){
    $retorno = "El centro de costo esta vacio";
    $sql="";
}elseif($perfil=='' || $perfil ==NULL){
    $retorno = "El perfil esta vacio";
    $sql="";
}else{

 
            $sql = $db->ing_usuario($usr_cod2,$usr_nombre,$usr_pass,$id_ccosto,$perfil,$shiper);

            if($sql=='Insertado'){
                $retorno = "200-".$sql."-".$usr_cod2;

            }else{
                $retorno = "400-Error en mant_usuario : ".$sql;
            }
   
}
echo $retorno."-".$sql;
?>