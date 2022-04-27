<?php

include ('menu.php');

//echo titulo("Carga archivo Para Generaci&oacute;n de Gu&iacute;as");



$tabla ="
		<tr>
            <td align='left' valign='top'  bgcolor='#F1F1F1'><p align='left' class='textogris1'>Bienvenido a la secci&oacute;n de Carga de Clientes<br />
                    <span class='textogris_bold'>Ingrese los datos en los campos de inter&eacute;s. </span></p>
                <table width='100%' border='0' cellspacing='0' cellpadding='1'>
                  <tr>
                    <td align='center'><table width='100%' border='0' cellpadding='1' cellspacing='1'>
                        <tr>

<tr><td>
<table align='center' border='0' width='1020' bgcolor='white'><tr><td>

<form method='post' action= 'paqueteria/clases/ajax/xls_to_pdf2.php' enctype='multipart/form-data' name='formulario1'>
<div>
<label class='textogris4'>Selecciona Archivo: </label>
<input name='archivo' type='file' id='archivo' />
</div>
<div><input type='submit' value='Enviar'/><div>
</form>

</td></tr></table>
";

$form ="<br /><div align='left' class='textogris'>
* El formato aceptado es xls <br />
* Solo se procesar&aacute; la hoja 1 del libro xls <br />
* Se necesita el formato de columnas correcto según <a href>archivo</a><br /></div>
";

$altura='100';

$titulo="<label class='textogris4'>Notas importantes</label>";

$inicHtml .=$tabla.div_oculto($altura,$titulo,$form);

echo $inicHtml."
</td></tr>
</table>";

include('pie.php');

?>
