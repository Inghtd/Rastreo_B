<?php
include ('usr_mante_proc.php');
$x1 = new usuarios();

$id_usr=$_POST['id_usr'];
$usuario=$_POST['usuario'];
$nombre=$_POST['nombre'];
$ccosto=$_POST['costo'];
$perfil=$_POST['perfil'];

$string='';


if($nombre!=''){$string="usr_nombre='".$nombre."'";}
if($usuario!=''){$string=$string.", usr_cod='".$usuario."'";}
if($ccosto!=''){$string=$string.", id_ccosto=".$ccosto;}
if($perfil!=''){$string=$string.", nivel=".$perfil;
  switch ($perfil){
    case 1:
      $perfil='Administrador';
      break;
    case 2:
      $perfil='Soporte';
      break;
    case 3:
      $perfil='Agencia';
      break;
    case 4:
      $perfil='Mensajero';
      break;
  }
}

$resultado = $x1->editar($string,$id_usr,$nombre);

$data=array(
  'codigo'=>200,
  'nombre'=>$nombre,
  'ccosto'=>$ccosto,
  'perfil'=>$perfil,
  'mensaje'=>'actualizacion realizada exitosamente '
);

echo json_encode($data);
?>
