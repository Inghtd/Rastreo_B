<?php
session_start();
 ini_set ("display_errors","1" );
 error_reporting(E_ALL);

class sis
{

public function index()
{

if(!empty($_SESSION['cod_usuario']))
{

include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_sis.php');
$cab=new model_sis();



echo "Bienvenido";

include('vista/pie.php');

}
}

public function res_gui()
{
if(!empty($_SESSION['cod_usuario']))
{

include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_sis.php');
$cab=new model_sis();



echo "Hola Mundo";

include('vista/pie.php');

}
}




}
?>