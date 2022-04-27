<?php
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
/*
try{
include('db_extend.php');
$b=$_GET['b'];
$x1=new model_con();
//$sql = "SHOW TABLES FROM rastreo";
//$sql = "select * from agencia";
//$sql = "select * from categoria";
//$sql = "select * from centro_costo where id_ccosto=381";
//$sql = "select * from chk_id";
//$sql = "select * from cliente";
//$sql = "select * from correlativo";
//$sql = "select id_envio from manifiesto_linea";
//$sql = "select * from manifiesto";
//$sql = "select * from guia";
//$sql = "select * from mensajero";
//$sql = "select * from recurso";
//$sql = "select * from movimiento" ;
//$sql = "select * from orden";
//$sql = "select * from recurso";
//$sql = "select * from usuario";
//$sql = "select * from zona";

//$sql="SELECT g.* FROM rastreo.guia g INNER JOIN rastreo.orden o ON g.id_orden=o.id_orden WHERE g.barra='' AND o.cli_codigo='1' AND g.estado=4";


/*
$sql="select tipo,imagen from recurso where char1='100095' and estado=4";
$data = $x1->consul($sql);






foreach($data as $d){
    $resul=$d->imagen;
}

echo json_encode($data);
} catch(Exception $e) //capturamos un posible error
{
  //mostramos el texto del error al usuario	  
  //echo "Error " . $e;
  $respuesta=array(
    'codigo'=> 502,
    'mensaje'=>" A ocurrido un error critico: ".$e,
    'SQL'=>$sql
);
  echo json_encode($respuesta);
}*/
$descripcion="Comentarle que el password para la BD en el
 servidor 40.69.185.239 es diferente, ya que esta se genera
  por cada creación de VM, pueden visualizar las credenciales 
  ingresando al servidor a través de SSH y luego ejecutar 
  el siguiente comando:
  ";
$carcteres= strlen($descripcion);
$descripcion=substr($descripcion, 0, 100);
$caracteres_despues= strlen($descripcion);
echo "cadena: ".$descripcion."<br> Cantidad de caracteres totales: ".$carcteres."<br> Caracteres despues de recorte: ".$caracteres_despues;
?>