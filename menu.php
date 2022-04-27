<?php

// ini_set ("display_errors","1" );
// error_reporting(E_ALL);

require_once ("lib/ajax/xajax_core/xajax.inc.php");
require_once ("class/ajax/funciones.php");

$xajax = new xajax();
$xajax->registerFunction("valida_usuario");
$xajax->configure('debug',true);

$xajax->processRequest();


echo "<?xml version=\'1.0\' encoding=\'UTF-8\'?>";

		$xajax->printJavascript('lib/ajax/');


?>
<link href="../textos.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='css/tab.css' type='text/css' media='screen' />
<script type='text/javascript' src='lib/jquery.js'></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script src="lib/beauty.js" type="text/javascript" ></script>

<body style="background-color:#5D5D5D;">


<table align="center" width="1024" border="0" cellspacing="0" cellpadding="1" bgcolor='white' bordercolor='#C0C0C0'> 
  <tr><td>
<table width='100%' border='0' >
	<td colspan='1' height='21'><img src="../images/default_r2_c2.gif" alt="" name="default_r2_c2" width="225" height="83" border="0" id="default_r2_c2" /></td>
                 <td height="21" align="right" valign='bottom'><img src="<?php echo "../titulos/Salvador.gif";?>" alt="" name="default_r4_c19" width="191" height="21" border="0" id="default_r4_c19" /></td>

</table>
	</td></tr>
  </tr>
  <tr>
	<td width="100%" bgcolor='#4D4D4D' height='30' align='center'><span class="Texblanco_Bold22">Bienvenido Cliente</span></td>
  </tr>

  </tr>

<tr>
	<td width="100%" bgcolor='#C80000'><a class="Texblanco_Bold22" href="#">

<div id='menu'>

<table border='0' align='left' cellspacing=0 cellpadding=0 width='1024' bgcolor='#F1F1F1'>
<tr>
<td align='center' colspan='2'>
<div id='mensaje'><br></div>
</td>
</tr>
<td><div id='form' align='center'>
<form id='formulario' method="post" name="formulario">
Usuario:<input type='text' id='usr' name='usr'><br>
Contrase&ntilde;a:<input type='password' id='pass' name='pass'><br>
<input type='button' value='ingresar al sistema' onclick="xajax_valida_usuario(xajax.getFormValues('formulario'))"></form>
</div>
<br>
<br>
</td></tr>
</table>
</div>
</a>
</td>
</tr>
<table width="1024" border="0" cellspacing="0" cellpadding="0" align='center'>
  <tr>
    <td width="63" height="28"><img src="../images/bo.jpg" alt="" name="default_r34_c2" width="63" height="28" border="0" id="default_r34_c2" /></td>
    <td align="center" background="../images/default_r34_c24.jpg" class="rollblanco">:: Urbano El Salvador  :: &bull; :: 2236-1700 - 22361717 :: &bull; :: cotizaciones@urbano.com.sv :: </td>
    <td width="50" height="28"><img src="../images/default_r34_c27.jpg" alt="" name="default_r34_c27" width="50" height="28" border="0" id="default_r34_c27" /></td>
  </tr>
</table>

</body>
</html>