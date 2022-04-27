<?php
//$url="https://www.urbano.com.sv/";
require_once ("lib/ajax/xajax_core/xajax.inc.php");
//session_start();
$xajax = new xajax();
//$xajax->configure('debug',true);
$prefix="";

include($prefix.'prg/xajax_mov.php');


$xajax->registerFunction("mov");
$xajax->processRequest();


echo "<?xml version=\'1.0\' encoding=\'UTF-8\'?>";

$xajax->printJavascript($prefix.'lib/ajax/');

?>
<!DOCTYPE html">
<html>
 	<head>

<style type="text/css">
	@import url("css/form.css");
</style>

<style type="text/css">
	@import url("css/formulario.css");
</style>

<link href="../../textos.css" rel="stylesheet" type="text/css" />
<link href="../css/tablas.css" rel="stylesheet" type="text/css" />
    </head>
<body style="background-color:#231f20;">
<script type='text/javascript' src='vista/lib/jquery.js'></script>