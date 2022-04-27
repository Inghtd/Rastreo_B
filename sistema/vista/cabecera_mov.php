<?php
//$url="https://www.urbano.com.sv/";
require_once ("track/sistema/lib/ajax/xajax_core/xajax.inc.php");
//session_start();
$xajax = new xajax();

//$xajax->configure('debug',true);

$prefix="track/sistema/";

include($prefix.'prg/xajax_mov.php');


$xajax->registerFunction("mov");
$xajax->registerFunction("mov2");
$xajax->processRequest();


echo "<?xml version=\'1.0\' encoding=\'UTF-8\'?>";

$xajax->printJavascript($prefix.'lib/ajax/');

?>
<!DOCTYPE html">
<html>
 	<head>

<style type="text/css">
	@import url("track/sistema/css/form.css");
</style>

<style type="text/css">
	@import url("track/sistema/css/formulario.css");
</style>

<link href="textos.css" rel="stylesheet" type="text/css" />
<link href="tablas.css" rel="stylesheet" type="text/css" />
    </head>
<body style="background-color:#231f20;">
<script type='text/javascript' src='track/sistema/vista/lib/jquery.js'></script>
