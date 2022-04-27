<?php

require_once ("lib/ajax/xajax_core/xajax.inc.php");
//session_start();
$xajax = new xajax();
if($_SESSION['cod_usuario']=='adm424'){
	//$xajax->configure('debug',true);
}
$xajax->registerFunction("cuenta");
$xajax->registerFunction("filtro");
$xajax->registerFunction("del_registro");
$xajax->registerFunction("valida_municipio");
$xajax->registerFunction("guarda_formato");
$xajax->registerFunction("coincidencias");
$xajax->registerFunction("rep_tigo_money");
$xajax->registerFunction("mov_data");
$xajax->registerFunction("mov_data_x_muni");
$xajax->registerFunction("rep_problema");
$xajax->registerFunction("rep_pdt_digi");
$xajax->registerFunction("mov_chk");
$xajax->registerFunction("list_muni_x_depto");
$xajax->registerFunction("coincidencia_x_muni");
$xajax->processRequest();


echo "<?xml version=\'1.0\' encoding=\'UTF-8\'?>";

$xajax->printJavascript('lib/ajax/');

?>
<!DOCTYPE html>
<html>
 	<head>

<link href="../../../textos.css" rel="stylesheet" type="text/css" />

<style type="text/css">
	@import url("css/form.css");
</style>

<style type="text/css">
	@import url("../css/formulario.css");
</style>

    </head>
<body style="background-color:#5D5D5D;">
<script type='text/javascript' src='lib/jquery.js'></script>