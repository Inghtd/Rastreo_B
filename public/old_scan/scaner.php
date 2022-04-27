<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
header('Strict-Transport-Security: max-age=0;');
date_default_timezone_set('America/Guatemala');

$postdata = json_decode(file_get_contents("php://input"));

//registramos la informacion
$array=$postdata->tag_reads;



header('Content-Type: application/json');

include('db_funcion.php');

$x1 = new function_model();

$dd=$x1->proceso_actual();
$data="";

foreach($dd as $row){
    $proceso = $row['seq_ini'];//que proceso
    $num     = $row['seq_fin'];//numero
}


////////////////////////////////Log txt clase barrido//////////////////////////////////
$f_d=date('Y/m/d H:i:s');

$str = print_r(json_encode($postdata),true);
$archivo = fopen("tmp/datos_log".date("d-m-Y").".txt","a+");
fwrite($archivo,"escaneo realizado con proceso ".$proceso." inicio a las ".$f_d."\n");
fwrite($archivo,$str);
fclose($archivo);


///////////////////////////////////////////////////////////////////



$fecha_datetime	=date('Y/m/d H:i:s');
$barra='';
$cad="escaneo realizado con proceso ".$proceso." inicio a las ".$fecha_datetime."\n";
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

    
   $resultado=$x1->scaneo($barra,$num);
   $mj.=$barra."---".$resultado."<br>";
   $str = print_r($row,true);
    $cad=$cad."<".date('Y/m/d H:i:s')."> barra lectura n° ".$cnt."<------>".$barra." proceso <------>".$proceso."-".$num."\n<-Resultado->**".$resultado."**\n".$str."\n";
    $barra='';
    $hex='';
}

    
    ///////////////////////////////////Log txt clase procesado//////////////////////////////////////////

    $fch=date("d-m-Y");
    $crea = fopen("tmp/datos".$fch.".txt","a+");
    $fecha_datetime	=date('Y/m/d H:i:s');
    $cad=$cad."escaneo realizado con proceso ".$proceso." finalizo a las ".$fecha_datetime."\n";
    fwrite($crea,"cantidad de lecturas procesadas ".$cnt."\n");
    fwrite($crea,$cad);
    fclose($crea);
    ////////////////////////////////////////////////////////////////////////////
   if($resultado!=""){
    echo $mj;
   }else{
    echo "proceso de prueba";
   }

}else{
    echo "proceso detenido";
} 

?>