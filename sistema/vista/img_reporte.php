<?php
include ('historico.php');
//$barra=base64_decode($_GET['b']);
$barra=$_POST['barra'];
$x1=new historico_ingresos();
$img=$x1->get_img($barra);
if($img!=""){
$data=array(
  'codigo'=>200,
  'imagen'=>$img
);
}else{
  $data=array(
    'codigo'=>400,
    'imagen'=>'Imagen no encontrada'
  );
}
echo json_encode($data);
?>
