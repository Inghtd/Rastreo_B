<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
header('Strict-Transport-Security: max-age=0;');
date_default_timezone_set('America/Guatemala');

$postdata = json_decode(file_get_contents("php://input"));

//registramos la informacion
$array=$postdata->tag_reads;

/*
$str = print_r($postdata,true);
$archivo = fopen("tmp/datos".time().".txt","w+");
fwrite($archivo,$str);
*/

header('Content-Type: application/json');

include('db_funcion.php');

$x1 = new function_model();

$dd=$x1->proceso_actual();
$data="";

foreach($dd as $row){
    $proceso = $row['seq_ini'];//que proceso
    $num     = $row['seq_fin'];//numero
}

$barra='';
$cad="";
$mj='';
$cnt=0;
if($num!=5){
   
foreach($array as $row){
  $cnt++;
    $hex=$row->epc;

    
    //echo $barra;

    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $barra .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    $hex=substr($barra, 0, 16);

   ///log de procesos realizados lecturas de todo lo que ingresa y es leido por las antenas.

   $resultado=$x1->scaneo($barra,$num);

   $log=$x1->log_bd($barra,$proceso,$resultado);
   
  /* $mj.=$barra."---".$resultado."<br>";
   $str = print_r($row,true);
    $cad=$cad."<".date('Y/m/d H:i:s')."> barra lectura <------>".$barra." proceso <------>".$proceso."-".$num."\n<-Resultado->**".$resultado."**\n".$str."\n";
    */$barra='';
    $hex='';
}

    
    //echo $cad;

   /* $fch=date("d-m-Y");
    $crea = fopen("tmp/datos".$fch.".txt","a+");
    //fwrite($crea,"cantidad de lecturas procesadas".$cnt."\n");
    fwrite($crea,$cad);
    fclose($crea);*/
    
   if($resultado!=""){
    echo $mj;
   }else{
    echo "proceso de prueba";
   }

}else{
    echo "proceso detenido";
} 

?>