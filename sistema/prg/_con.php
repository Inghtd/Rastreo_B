<?php
session_start();

// ini_set ("display_errors","1" );
// error_reporting(E_ALL);
class con
{

public function opciones()
{
if(!empty($_SESSION['cod_usuario']))
{
$bd=Db::getInstance();

include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');
include('../class/db.php');

$cab=new model_con();
$mys= new Db();
$stmt=$cab->cabecera();

$reailp=$cab->realip();
?>

<style type="text/css">
@import url("../css/tablas.css");
</style>

<table id="box-table-a">

	<?php
	// $listado es una variable asignada desde el controlador ItemsController.
	while($item = $cab->fetch($stmt))
	{

	echo '<tr>';

			foreach($item as $key=>$value) {
				echo '<th scope="col">'.$value.'</th>';
			}

	echo '</tr>';
	}
	?>

</table>

<?php
include('vista/pie.php');
}
else
{
echo "Debes iniciar session";
}
return true;
}


public function formulario()
{
/*ini_set ("display_errors","1" );
error_reporting(E_ALL);*/
include('../class/db.php');

$mys= new Db();
		if(!empty($_SESSION['cod_usuario']))
		{
		$bd=dbp::getInstance();

		include('vista/cabecera.php');
		include('vista/menu.php');
		include('model/model_con.php');
		$cab=new model_con();
		$reailp=$cab->realip();
//echo $reailp."<br>";
	//$reailp="192.168.20.0";
if($reailp=="190.57.70.69")
{


$producto="
<tr>
	<td><span class='textogris4'>Sucursal Origen : </span>
		<input type='hidden' name='producto' id='producto' value='10'><span class='textogris4'>".$cab->describe_producto(10)."</span>
	</td>
	<td rowspan='3'>
		
		<img src='vista/imgs/smile.png' alt='' name='urbano' width='200' border='0' id='urbano' />
		
	</td>
</tr>
";
	

}elseif($reailp=="190.57.73.178")
{
$producto="<tr>
	<td><span class='textogris4'>Sucursal Origen : </span>
		<input type='hidden' name='producto' id='producto' value='11'><span class='textogris4'>".$cab->describe_producto(11)."</span>
		</td>
		<td rowspan='3'>
			
			<img src='vista/imgs/smile.png' alt='' name='urbano' width='200' border='0' id='urbano' />
			
		</td>
	</tr>
			";

}else
{


$producto ="
<tr>
	<td><span class='textogris4'>Producto o tipo &nbsp;:</span>
		<input type='hidden' name='producto' id='producto' value='10'>
		
";
$producto.=$cab->select_producto();
$producto.="</td>
<td rowspan='3'>	
	<img src='vista/imgs/smile.png' alt='' name='urbano' width='200' border='0' id='urbano' />
	
		</td>
</tr>";

$msq=new model_con();
$cmy=$msq->conectam();
$opcion=$msq->formato_impresion($shi_codigo);

if($opcion=="guia_carta_2_copias")
{

if(($cab->consultar_guias_facturacion())==0)
{
$producto ="Los Correlativos de Guias Facturaci&oacute;n se han agotado, solicita a Finazas la asignaci&oacute;n de nuevos correlativos al 2236-1742";
}

}

if($opcion=="0")
{
if($shi_codigo=='0005980')
{
$select_tipo_impresion=$msq->select_tipo_impresion();
}
//echo "-";
}


/*	ini_set ("display_errors","1" );
	error_reporting(E_ALL);*/


//$producto="<input type='hidden' name='producto' id='producto' value='0'>";
}

		?>
			<style type="text/css">
				@import url("css/form.css");
			</style>

			<style type="text/css">
				@import url("../css/formulario.css");
			</style>
<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}


function valida_envia(){


seguro = document.getElementsByName("seguro");

var seleccionado = false;
for(var i=0; i<seguro.length; i++) {
if(seguro[i].checked) {
seleccionado = true;
break;
}
}

if(!seleccionado) {
alert("El seguro debe definirse ")
return false;
}

if (document.formulario.cli_codigo.value.length==0){
alert("Tiene que escribir la cuenta ")
document.formulario.cli_codigo.focus()
return 0;
}

if (document.formulario.nom_remitente.value.length==0){
alert("Tiene que escribir el nombre")
document.formulario.nom_remitente.focus()
return 0;
}

if (document.formulario.dir_remitente.value.length==0){
alert("Tiene que escribir la direccion")
document.formulario.dir_remitente.focus()
return 0;
}

if (document.formulario.municipio.value.length==0){
alert("Tiene que definir el municipio")
document.formulario.municipio.focus()
return 0;
}

for(j=0; j <document.formulario.seguro.length; j++){
if(document.formulario.seguro[j].checked){
valorSeleccionado = document.formulario.seguro[j].value;
}
}

// if(valorSeleccionado==1)
// {

if (document.formulario.monto.value.length==0){
document.formulario.monto.focus()
alert("Tiene que definir el monto del envío")
return 0;
}



if (document.formulario.doc.value.length==0){
alert("Tiene que escribir el documento asociado ")
document.formulario.doc.focus()
return 0;
}

if (document.formulario.mun_id.value==0){
alert("El municipio no es valido")
document.formulario.municipio.focus()
return 0;
}





alert("El formulario se ha procesado Satisfactoriamente");
document.formulario.submit();
document.formulario.referencia.value="";
document.formulario.cli_codigo.value="";
document.formulario.nom_remitente.value="";
document.formulario.municipio.value="";
document.formulario.mun_id.value="0";
document.formulario.dir_remitente.value="";
document.formulario.tel_remitente.value="";
document.formulario.observaciones.value="";
document.formulario.monto.value="";
document.formulario.doc.value="";
document.formulario.empresa.value="";
document.formulario.seguro.value();
document.formulario.referencia.focus();
									     
}
// function onchange_cliente(cuenta)
// {
// document.formulario.cli_codigo.value=cuenta;
// return;
// }

function limpia2()
{
document.formulario.dir_remitente.select();
return;
}

</script>
<body onload="document.formulario.referencia.focus();">
 	<?php
// 	     echo $cab->asignar_guias_facturacion();
 	?>

		<tr>
		<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Generaci&oacute;n de Gu&iacute;as de Env&iacute;os<br />
                <span class='textogris_bold'>Ingrese los datos conocidos en los campos de inter&eacute;s. </span></p></td>
		<tr><td bgcolor='#434343'><br>
                <table width='100%' border='0' cellspacing='0' cellpadding='1' >
                  <tr>

<div id="formulario">
<form id='formulario' method="post" name="formulario" action="../class/procesa_pdf.php" target='_blank'>
<table border='0' align='center' bgcolor='#F1F1F1' cellpadding='1' cellspacing='0'>
</tr>
<td colspan='6' height='30'  align="center" style='background:url(vista/imgs/grad1.png) repeat-x;' ></td>
</td>
</tr>

<?php
     echo $producto
?>

<tr>

<td>
	<span class='textogris4'>Referencia Env&iacute;o :</span><input type="text" name="referencia" id="referencia" size="20" maxlength="12" class="input" onkeyup="this.value=this.value.toUpperCase();" value="" onkeypress="return pulsar(event)" OnBlur="onchange_cliente(this.value)"><span class='textogris1'>Se utiliza como referencia &uacute;nica del env&iacute;o, si est&aacute; vac&iacute;o el sistema lo genera</span><input type='hidden' name='ref_id' id='ref_id' value='0'>
</td>

</tr>
<tr>
<td colspan='4'><span class='textogris4'>Cliente o cuenta &nbsp;:</span><input type='text' name='cli_codigo' id='cli_codigo' size='20' maxlength='24' class='input' value='' onBlur="xajax_cuenta(this.value)" onkeypress='return pulsar(event)'></td>
</tr>

<tr>
<td colspan='4'><span class='textogris4'>Nombre Contacto:</span><input type='text' name='nom_remitente' id='nom_remitente' size='50' maxlength='50' class='input' onkeyup="this.value=this.value.toUpperCase();" value='' onkeypress='return pulsar(event)'></td>
</tr>
<tr>
<td colspan='4'><span class='textogris4'>Direcci&oacute;n:</span>
</td>
</tr>
<tr>
<td colspan='4'><textarea name='dir_remitente' id='dir_remitente' maxlength='255' class='input' cols='100' rows='3' onfocus="limpia2()" onkeyup="this.value=this.value.toUpperCase();"></textarea><br>
</td>
</tr>

<tr>
	<td colspan="4"><span class='textogris4'>Municipio :</span><input type='text' id='municipio' name='municipio' class='input' onkeyup="this.value=this.value.toUpperCase();" OnBlur="xajax_valida_municipio(this.value)" ><input type='hidden' id='mun_id' name='mun_id' value='0'>
			<div id='div_municipio'></div>
</td>
</tr>

<!-- php echo $cab->municipio_t(); ?>-->

<tr>
<td colspan='4'><span class='textogris4'>Tel&eacute;fonos :</span><input type='text' name='tel_remitente' id='tel_remitente' size='19' maxlength='140' class='input' onkeyup="this.value=this.value.toUpperCase();" onkeypress='return pulsar(event)'></td>
</tr>

<tr>
<td colspan='4'><span class='textogris4'>Cantidad : </span><input type='text' name='cantidad' id='cantidad' size='5' maxlength='5' class='input' value="1" onkeypress='return pulsar(event)'></td>
</tr>

<tr>
<td colspan='4'><span class='textogris4'>Peso(lbs)  :</span><input type='text' name='peso' id='peso' size='5' maxlength='5' class='input' value="0.00" onkeypress='return pulsar(event)'></td>
</tr>

<tr>
<td colspan='4'><span class='textogris4'>Observaciones :</span></td>
</tr>

<tr>
<td colspan='4'><textarea rows="3" cols="100" name='observaciones' id='observaciones' maxlength='255' class='input' onkeyup="this.value=this.value.toUpperCase();" onfocus="limpia()"></textarea></td>
</tr>

<tr>
<td><span class='textogris4'>Seguro: <input type='radio' id='seguro' name='seguro' value='0' checked='true'>NO <input type='radio' id='seguro' name='seguro' value='1'>SI</span>
			<span class='textogris4'>&nbsp;&nbsp;&nbsp;&nbsp;Monto: </span><input type='text' name='monto' id='monto' size='10' maxlength='10' class='input' value="0.00">
<span class='textogris4'>Documento: </span><input type='text' name='doc' id='doc' size='10' maxlength='20' class='input' onkeyup="this.value=this.value.toUpperCase();" onkeypress='return pulsar(event)'>
</td>
<td colspan="3"> </td>
</tr>

<tr>
<td colspan='4'></td>
</tr>
<tr>
<tr>
<td colspan='6' height='25' align="center" ><input type='button' class="boton_submit" value='Registrar Env&iacute;o' name='enviar' onclick="valida_envia()">
<input type='reset' class="boton_submit" value='Limpiar Formulario' name='limpiar'>
</td>
</td>
</tr>
<td colspan='6' height='40'  align="center" style='background:url(vista/imgs/grad2.png) repeat-x;'></td>
</td>
</tr>
</table>
<br>
<script type='text/javascript' src='lib/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script type="text/javascript">
  $().ready(function() {
    $("#cli_codigo").autocomplete("prg/autocompletado/clientes.php", {
      width: 650,
      matchContains: true,
      selectFirst: false
    });
  });

  $().ready(function() {
  $("#municipio").autocomplete("prg/autocompletado/municipio.php", {
  width: 650,
  matchContains: true,
  selectFirst: false
  });
  });
</script>

		<?php
		include('vista/pie.php');
		}
		else
		{
			echo "Debes iniciar session";
		}
		return true;
		
		
}


public function form_reporte()
{
include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');

?>
			<style type="text/css">
				@import url("../css/formulario.css");
			</style>

<script LANGUAGE="JavaScript">
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=800,height=600');");
}
</script>

		<tr>
	        <td align='left' valign='top'  bgcolor='#F1F1F1'><p align='left' class='textogris1'>Bienvenido a la secci&oacute;n de Reportes Generales<br />
                <span class='textogris_bold'>Ingrese los datos conocidos en los campos de inter&eacute;s. </span></p>
                <table width='100%' border='0' cellspacing='0' cellpadding='1'>
                  <tr>
                    <td align='center'><table width='100%' border='0' cellpadding='1' cellspacing='1'>
                        <tr>

<tr><td align="left" valign="top" class="textogris_bold2">
 <table cellspacing="1" bgcolor="#CCCCCC" cellpadding="2">
<tr bgcolor="#FFFFFF">
<td width='400'>

<div method='post' action='' name='formulario1' id='formulario' >
<div>
<label class='textorojo_bold'><span class='item'>Procesado desde : </span><?php echo "<div>".procFecIni()."</div>"; ?></label>
</div>

<div>
<label class='textorojo_bold'><span class='item'>Procesado Hasta :&nbsp;</span>
<?php echo "<div>".procFecFin()."</div>"; ?></label>
</div>

<div>
<label class='textorojo_bold'><span class='item'>Producto:</span>
<?php echo "<div>".select_producto_total()."</div>"; ?>
</label>
</div>

<br>

<div>
<span class='item'>
<input type='button' value='Generar Reporte de Resutados' id='filtro' class='boton_submit' OnClick="xajax_filtro(xajax.getFormValues('formulario'))" />
</span>
<div>
</form>

</td>
 <td width='608'>
<div id='enlaces'></div>
</td>
</tr>

</table>
</td>
</tr>


<tr>
<td colspan='2' bgcolor='F1F1F1'>

				<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
				<tr>
				<td height='550' bgcolor='#ffffff'>


<div id='div_mov' >
<img src='vista/imgs/smile.png' >
</div>
<!--<div id="map" style="width: 470px; height: 370px"></div>-->
</td>
</tr>
</table>


</td>
</tr>
<!--<tr>
	<td width="100%" bgcolor='white' height='30'><a class='textogris'>Exportar Datos</a></td>
  </tr>
-->
</table>

</td></tr>
</table>


<?php
		include('vista/pie.php');
}

public function prn()
{
/*ini_set ("display_errors","1" );
error_reporting(E_ALL);*/
//include('vista/cabecera.php');
//include('vista/menu.php');
prn_guia();
//include('vista/pie.php');
}



public function cons_qr()
{
/*
ini_set ("display_errors","1" );
error_reporting(E_ALL);
*/
session_start();
include('vista/cabecera_mov.php');
include('vista/banner.php');
include('prg/movimientos.php');

$mov= new movimientos();

$key=$_REQUEST['key'];

$llave=base64_decode($key);

$trozo_guia=explode("=",$llave);

//prc=con&accion=cons_qr&gui=5000447&ref=BBNH148201
$part1=explode("&",$trozo[3]);
$gui=$part1[0];

$part2=$trozo[4];
$part2=explode("&",$trozo[4]);
$ref=$part2[0];


if($_SESSION['shi_codigo']!="")
{
echo "consulta cliente";
}else
{
echo $mov->consulta_qr($ref,$gui);
}



include('vista/pie.php');
}

public function cons_cli()
{
/*
ini_set ("display_errors","1" );
error_reporting(E_ALL);*/

session_start();
//include('vista/cabecera_mov.php');
include('vista/cabecera_cli.php');
include('vista/menu.php');
include('prg/movimientos.php');

$mov= new movimientos();

$gui=$_REQUEST['g'];
$ref=$_REQUEST['r'];

echo $mov->consulta_cli($ref,$gui);

include('vista/pie.php');
}

public function test_uex()
{
ini_set ("display_errors","1" );
error_reporting(E_ALL);
$shi_codigo=$_SESSION['shi_codigo'];
$usuario=$_SESSION['cod_usuario'];
$recolector="paqueteria";
//include('vista/cabecera_mov.php');
include('vista/cabecera_cli.php');
include('vista/menu.php');
require_once('../lib/fpdf16/qrcode/qrcode.class.php');
include('../sistema/model/model_con.php');
include('../lib/fpdf16/fpdf.php');
//include('guiapdf.php');
$cab=new model_con();

$gui='5000819';//$_REQUEST['g'];
$ref='890863FCD';//$_REQUEST['r'];


$stmt=$cab->detalle_cuenta($ref);

while($row = $cab->fetch($stmt))
{
$id_detalle		=utf8_decode($row[0]);
$referencia		=utf8_decode($row[1]);
$barra			=utf8_decode($row[2]);
$tipo_envio		=utf8_decode($row[3]);
$remitente		=utf8_decode($row[4]);
$nom_remitente		=utf8_decode($row[5]);
$dir_remitente		=utf8_decode($row[6]);
$cod_municipio_ori	=utf8_decode($row[7]);
$tel_remitente		=utf8_decode($row[8]);
$destinatario		=utf8_decode($row[9]);
$nom_destinatario	=utf8_decode($row[10]);
$dir_destinatario	=utf8_decode($row[11]);
$cod_municipio_des	=utf8_decode($row[12]);
$tel_destinatario	=utf8_decode($row[13]);
$cantidad		=utf8_decode($row[14]);
$observaciones		=utf8_decode($row[15]);
$seguro			=utf8_decode($row[16]);
$fecha_envio		=utf8_decode($row[17]);
$usuario		=utf8_decode($row[18]);
$hora			=utf8_decode($row[19]);
$tiempo			=utf8_decode($row[20]);
$real_ip		=utf8_decode($row[21]);
$monto			=round($row[22],2);
$tipo			=utf8_decode($row[23]);
$doc			=utf8_decode($row[24]);
$emp_remitente		=utf8_decode($row[26]);
$emp_destinatario	=utf8_decode($row[27]);

if($seguro=='1')
{
$seguro="SI";
}else
{
$seguro="NO";
}

}

$ciclo=date('dmY');

$trozo=substr($doc,0,3);
$tipo_documento=$trozo[0];
//echo $ccf->genera_ccf($gui,$ref);
$guia_facturacion=$cab->asignar_guias_facturacion();
$id_bitacora	=$cab->solicitud_recoleccion($gui,$ref);
$orden=$cab->crea_os_counter($id_bitacora,$shi_codigo);
$recolector="123";

echo "Bitacora :".$id_bitacora." - Orden :".$orden;
$ciclo=date('dmY');
$insert_guia_u20=$cab->insert_guia($guia_facturacion,1,$usuario,$recolector,$observaciones,$shi_codigo,"SE",$ciclo,$id_bitacora);
//echo $insert_guia_u20."<br>";
$ingreso_counter=$cab->registro_counter($guia_facturacion,$doc,$nom_destinatario,$tel_destinatario,$destinatario,"E","123",$shi_codigo,$monto,$usuario,$tipo_documento,"",$cantidad);

include('vista/pie.php');
}

public function ccf_cli()
{

//   ini_set ("display_errors","1" );
//   error_reporting(E_ALL);

//include('vista/cabecera_mov.php');
//include('vista/cabecera_cli.php');
//include('vista/menu.php');
include('../sistema/model/model_con.php');
require_once('../lib/fpdf16/qrcode/qrcode.class.php');
include('../lib/fpdf16/fpdf.php');
include('guiapdf.php');

$ccf= new PDF('P','mm',array(215.9,215.9));

$gui=$_REQUEST['g'];
$ref=$_REQUEST['r'];

$ccf->AddPage();

$ccf->ccf_matricial1($ref,$gui);
$ccf->Output($gui.".pdf","D");


}

public function datos_ccf()
{

$shi_codigo=$_SESSION['shi_codigo'];
$usuario=$_SESSION['cod_usuario'];
//include('vista/cabecera_mov.php');
include('vista/cabecera_cli.php');
include('vista/menu.php');
require_once('../lib/fpdf16/qrcode/qrcode.class.php');
include('../sistema/model/model_con.php');
include('../lib/fpdf16/fpdf.php');
//include('guiapdf.php');
// $gui="5001262";
// $ref='4E29B1C1B';//$_REQUEST['r'];



$cab=new model_con();

$gui=$_REQUEST['g'];
$ref=$_REQUEST['r'];


$stmt=$cab->detalle_cuenta($ref);
	
	while($row = $cab->fetch($stmt))
	{
		$id_detalle		=utf8_decode($row[0]);
		$referencia		=utf8_decode($row[1]);
		$barra			=utf8_decode($row[2]);
		$tipo_envio		=utf8_decode($row[3]);
		$remitente		=utf8_decode($row[4]);
		$nom_remitente		=utf8_decode($row[5]);
		$dir_remitente		=utf8_decode($row[6]);
		$cod_municipio_ori	=utf8_decode($row[7]);
		$tel_remitente		=utf8_decode($row[8]);
		$destinatario		=utf8_decode($row[9]);
		$nom_destinatario	=utf8_decode($row[10]);
		$dir_destinatario	=utf8_decode($row[11]);
		$cod_municipio_des	=utf8_decode($row[12]);
		$tel_destinatario	=utf8_decode($row[13]);
		$cantidad		=utf8_decode($row[14]);
		$observaciones		=utf8_decode($row[15]);
		$seguro			=utf8_decode($row[16]);
		$fecha_envio		=utf8_decode($row[17]);
		$usuario		=utf8_decode($row[18]);
		$hora			=utf8_decode($row[19]);
		$tiempo			=utf8_decode($row[20]);
		$real_ip		=utf8_decode($row[21]);
		$monto			=round($row[22],2);
		$tipo			=utf8_decode($row[23]);
		$doc			=utf8_decode($row[24]);
		$emp_remitente		=utf8_decode($row[26]);
		$emp_destinatario	=utf8_decode($row[27]);
		
		if($seguro=='1')
		{
			$seguro="SI";
		}else
		{
			$seguro="NO";
		}
	
	}


	$datos_fiscales=$cab->select_datos_fiscales($gui);
	
	$id_registro       =$datos_fiscales[0];
	//$barra             =$datos_fiscales[1];
	$guia_facturacion  =$datos_fiscales[2];
	$destinatario	   =$datos_fiscales[3];
	$registro          =$datos_fiscales[4];
	$nit               =$datos_fiscales[5];
	$giro              =$datos_fiscales[6];
	$tipo_doc          =$datos_fiscales[7];



	
	
$ciclo=date('dmY');

?>
<script type='javascript'>
	function valida_envia()
	{
	document.formulario.submit();
	}
</script>

	<body onload="document.formulario.referencia.focus();">
	<tr>
	<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Generaci&oacute;n de Documentos Fiscales<br />
	<span class='textogris_bold'>Ingrese los datos conocidos en los campos de inter&eacute;s. </span></p></td>
	<tr><td bgcolor='#434343'><br>
	<table width='100%' border='0' cellspacing='0' cellpadding='1' >
	<tr>
	<div id="form">
	<form id='formulario' method="post" name="formulario" action="../class/procesa_ccf.php" target='_blank'>
	<table border='0' align='center' bgcolor='#F1F1F1' cellpadding='1' cellspacing='0'>
	</tr>
	<td colspan='6' height='30'  align="center" style='background:url(vista/imgs/grad1.png) repeat-x;' ></td></td>
	</tr>
	<tr>
	<td>
	<span class='textogris4'>Barra:</span><input type="text" name="barra" id="barra" size="20" maxlength="12" class="input" value="<?php echo $barra; ?>" readonly='true'><input type='hidden' name='ref_id' id='ref_id' value='0' readonly='true'></td>
	</tr>
	<tr>
	<td>
	<span class='textogris4'>Referencia Env&iacute;o :</span><input type="text" name="referencia" id="referencia" size="20" maxlength="12" class="input" value="<?php echo $ref; ?>" readonly='true'><input type='hidden' name='ref_id' id='ref_id' value='0'></td>
	</tr>
	<tr>
	<td colspan='4'><span class='textogris4'>Cliente o cuenta &nbsp;:</span><input type='text' name='cli_codigo' id='cli_codigo' size='20' maxlength='24' class='input' value='<?php echo $destinatario; ?>' readonly='true' onBlur="xajax_cuenta(this.value)" onkeypress='return pulsar(event)' readonly='true'></td>
	</tr>
	<tr>
		<td colspan='4'><span class='textogris4'>Nombre Contacto:</span><input type='text' name='nom_remitente' id='nom_remitente' size='50' maxlength='50' class='input' onkeyup="this.value=this.value.toUpperCase();" value='<?php echo $nom_destinatario ?>' onkeypress='return pulsar(event)' readonly='true'></td>
	</tr>
	
	<tr>
		<td colspan='4'><span class='textogris4'>Registro Fiscal: </span><input type='text' name='registro_fiscal' id='registro_fiscal' size='50' maxlength='25' class='input' value="<?php echo $registro; ?>" onkeypress='return pulsar(event)'></td>
	</tr>

	<tr>
		<td colspan='4'><span class='textogris4'>Giro : </span><input type='text' name='giro' id='giro' size='50' maxlength='150' class='input' value="<?php echo $giro; ?>" onkeypress='return pulsar(event)' ></td>
	</tr>


	<tr>
		<td colspan='4'><span class='textogris4'>NIT : </span><input type='text' name='nit' id='nit' size='50' maxlength='15' class='input' value="<?php echo $nit; ?>" onkeypress='return pulsar(event)'></td>
	</tr>


	<tr>
		<td colspan='4'><span class='textogris4'>Condiciones de Pago : <input type='radio' name='opciones_pago' id='opciones_pago' value='CON' checked='true'>Contado
		<input type='radio' name='opciones_pago' id='opciones_pago' value='CRE'>Cr&eacute;dito</span>
		</td>
	</tr>

	<tr>
	<td colspan='4'>
	<span class='textogris4'>Documento a Generar : <input type='radio' name='tipo_documento' id='tipo_documento' value='CCF' checked='true'>Cr&eacute;dito Fiscal
					<input type='radio' name='tipo_documento' id='tipo_documento' value='FAC' >Factura
					<input type='radio' name='tipo_documento' id='tipo_documento' value='FEX'>Exportaci&oacute;n
					</span>
				</td>
	</tr>
	<tr>
		<td colspan='4'><span class='textogris4'>Documento : </span><input type='text' name='documento' id='documento' size='50' maxlength='15' class='input' value="1" onkeypress='return pulsar(event)'></td>
		</tr>
 

	<tr>
	<td colspan='4'></td>
	</tr>
	<tr>
	<tr>
	<td colspan='6' height='25' align="center" ><input type='submit' class="boton_submit" value='Registrar Env&iacute;o' name='enviar'>
	<input type='reset' class="boton_submit" value='Limpiar Formulario' name='limpiar'></form></td>
	</td>
	</tr>
	<td colspan='6' height='40'  align="center" style='background:url(vista/imgs/grad2.png) repeat-x;'></td>
	</td>
	</tr>
	</table>
	<br>
<?php
include('vista/pie.php');

}
public function cli()
{
include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');

?>
<tr>
<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Carga de Clientes por Archivo<br />
<span class='textogris_bold'>Selecciona el archivo xls en la casilla de archivo. </span></p></td>
<tr><td bgcolor='#434343'>
<table width='100%' border='0' cellspacing='0' cellpadding='1' >
<tr>

	<form id='formulario' method="post" name="formulario" action="https://www.urbano.com.sv/track/sistema/index.php?prc=con&accion=carga" target='_blank' enctype='multipart/form-data'>
<td colspan='6' height='30'  align="center" bgcolor='silver'>
<div id="formulario">
	<input class='input' name='archivo' type='file' id='archivo'><br>
	<input class='boton_submit' name='enviar' id='enviar' value='Cargar Clientes' type='submit'>
</div>
</td>
</tr>
<tr>
<td bgcolor='#F1F1F1'><span class='textogris4'>
</span>
</td>
</tr>
</td>
</tr>

<?php
include('vista/pie.php');
}





public function form_carga_acuse()
{
include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');
//   ini_set ("display_errors","1" );
//   error_reporting(E_ALL);


ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','10000');
ini_set('max_input_time','10000');
?>
<tr>
<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Carga de Clientes por Archivo<br />
<span class='textogris_bold'>Selecciona el archivo xls en la casilla de archivo. </span></p></td>
<tr><td bgcolor='#434343'>
<table width='100%' border='0' cellspacing='0' cellpadding='1' >
<tr>
<td colspan='6' height='30'  align="center" bgcolor='silver'>
<div id="formulario">
	<form id='formulario' method="post" name="formulario" action="https://www.urbano.com.sv/track/sistema/index.php?prc=con&accion=carga_acuse" target='_blank' enctype='multipart/form-data'>
	<input class='input' name='archivo' type='file' id='archivo'><br>
	<input type='hidden' name='MAX_FILE_SIZE' value='100000000'>
	<input class='boton_submit' name='enviar' id='enviar' value='Cargar Clientes' type='submit'>
</div>
</td>
</tr>
<tr>
<td bgcolor='#F1F1F1'><span class='textogris4'>

</span>
</td>
</tr>
</td>
</tr>

<?php
include('vista/pie.php');
}


public function carga_acuse()
{
//     ini_set ("display_errors","1" );
//     error_reporting(E_ALL);

//session_start();



include('model/model_con.php');
$cab=new model_con();

//echo "Hola Mundo";
$ruta="/tmp/";
date_default_timezone_set('America/El_Salvador');
$archivo_nombre= $ruta.$_FILES["archivo"]["name"];
$archivo_peso= $_FILES["archivo"]["size"];
$archivo_temporal= $_FILES["archivo"]["tmp_name"];
$shi_codigo=$_SESSION['shi_codigo'];
$usr_codigo=$_SESSION['cod_usuario'];
$imagen="";

$ext  = $archivo_nombre;
$exten = explode(".", $ext);
//echo $exten[0]; // nombre_archivo
//echo $exten[1]; // extension
$gestor = @fopen($archivo_nombre, "r");

if ($gestor) {

    while (($cols = fgetcsv($gestor, 10000, chr(9))) !== FALSE) {
        foreach( $cols as $key => $val ) {
            $cols[$key] = trim( $cols[$key] );
            $cols[$key] = preg_replace("/^\"(.*)\"$/sim", "", $cols[$key]);
        }


$id_acuse             =$cols[1];
$gui_llave            ="";
$id_sucursal          =$cols[0];
//fecha                date                                    yes
//$imagen               ="";
$estado               ="ING";
$shi_codigo           =$_SESSION['shi_codigo'];
$usuario              =$_SESSION['cod_usuario'];
$aud_fecha_proc       =date('d-m-Y');
$hora                 =date('H:i:s');



$txn=substr($id_acuse,0,2);
$anio=substr($id_acuse,2,2);
$mes=substr($id_acuse,4,2);
$dia=substr($id_acuse,6,2);
$sub=explode(".",$id_acuse);
$hora_acuse=substr($sub[1],0,2).":".substr($sub[1],2,2);
$serie=$sub[2];
$fecha=$dia.$mes."20".$anio;


$time=$dia."-".$mes."-20".$anio." ".$hora;
//echo $time."<br>";
$tiempo_proc=strtotime($time);


$insert="insert into data_acuse values('$id_acuse', '$gui_llave', '$id_sucursal', '$fecha', '$imagen', '$estado', '$shi_codigo', '$usuario', '$aud_fecha_proc', '$hora', '$txn', '$hora_acuse', '$serie', '$tiempo_proc')";


$try1=$cab->consultar($insert);
	if($try1)
	{
	$inserts++;
	}
//echo $insert."<br>";
    }

}


include('vista/cabecera.php');
include('vista/menu.php');

?>
<tr>
	<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Carga de Clientes por Archivo<br />
			<span class='textogris_bold'>Selecciona el archivo xls en la casilla de archivo. </span></p></td>
	<tr>
		<td bgcolor='#434343'>
			<table width='100%' border='0' cellspacing='0' cellpadding='1' >
				<tr>
					<td colspan='6' height='30'  align="center" bgcolor='silver'>
					<div id="formulario">
					Archivo Cargado Satisfactoriamente.<?php echo $inserts; ?>
					</div>
					</td>
				</tr>
			</table>

		</td>
	</tr>
	</td>
</tr>
<?php

include('vista/pie.php');
}



public function carga()
{
//   ini_set ("display_errors","1" );
//   error_reporting(E_ALL);

session_start();

require('../../Connections/con.php');



$ruta="/tmp/";
date_default_timezone_set('America/El_Salvador');
$archivo_nombre= $_FILES["archivo"]["name"];
$archivo_peso= $_FILES["archivo"]["size"];
$archivo_temporal= $_FILES["archivo"]["tmp_name"];
$shi_codigo=$_SESSION['shi_codigo'];
$usr_codigo=$_SESSION['cod_usuario'];

if (copy($archivo_temporal,$ruta.$archivo_nombre)){
//echo "Archivo subido $archivo_temporal = $archivo_nombre = $archivo_peso";
}else{
//echo "Error al subir el archivo ".$ruta.$archivo_nombre." ";
}

$ext  = $archivo_nombre;
$exten = explode(".", $ext);
//echo $exten[0]; // nombre_archivo
//echo $exten[1]; // extension

if ($exten[1] =='xls')
{

//echo "<br>archivo cargado es xls<br>";
		
		require('../../sistema/lib/xls/reader.php');
		
		$excel_reader = new Spreadsheet_Excel_Reader();
		$excel_reader->read($ruta.$archivo_nombre);
		$excel_reader->setOutputEncoding('CP1251');
		$excel_reader->setUTFEncoder('mb');
		//Mediante el c�digo anterior los datos de archivo_excel.xls quedan cargados en un array PHP de 2 dimensiones:
		$excel_reader->sheets[x][y];
		//X es el n�mero de hoja del documento, mientras que Y puede tomar varios valores:
		// N�mero de filas de la hoja
		$cant_filas_xls = $excel_reader->sheets[0]['numRows'];
		// N�mero de columnas de la hoja
		$cant_columnas_xls = $excel_reader->sheets[0]['numCols'];
		// Acceso a los datos de celdas
		//$tipo_archivo=$excel_reader->sheets[0]['cells'][1][3];
		
		
		$filas=2;
		
		while ($filas <= $cant_filas_xls)
		{
			$cli_codigo		=trim($excel_reader->sheets[0]['cells'][$filas][1]);
			$nombre			=preg_replace('`[^ a-z0-9-_."]`i', '',trim($excel_reader->sheets[0]['cells'][$filas][2]));
			$direccion		=preg_replace('`[^ a-z0-9-_."]`i', '',trim($excel_reader->sheets[0]['cells'][$filas][3]));
			$telefono		=preg_replace('`[^ a-z0-9-_."]`i', '',trim($excel_reader->sheets[0]['cells'][$filas][4]));
			$fecha			=date('dmY');
			$usuario		=$_SESSION['shi_codigo'];
			$hora			=date('H:i:s');
			$tiempo			=time();
			$filas =$filas+1;
			
			
			$dir1= substr($direccion, 0,50);
			$dir2= substr($direccion,50,50);
			
			
			$gui_llave=$cli_codigo;
			$cli_nombre=$nombre;
			$cli_direccion1=$dir1;
			$cli_direccion2=$dir2;
			$cli_telefono1=$telefono;
			$cli_telefono2="";
			$cic_inicio=date('d-m-Y');
			$zon_codigo="";
			$cli_coord_x="";
			$cli_coord_y="";
			$cli_fecha_ing=date('d-m-Y');
			$ecli_codigo="";
			$pro_codigo="CA";
			$departamento="";
			$municipio="";
			$tipo_zona="";
			$aud_estacion="SAL";
			$aud_usuario_proc=$usr_codigo;
			$aud_fecha_proc=date('d-m-Y');
			$aud_hora_proc=date('H:i');
			
			$consulta_cliente="select * from cliente
			where shi_codigo='$shi_codigo'
			and gui_llave='$cli_codigo'
			";
			$dato_de_base="";
			$consulta_bases=$dbh->query($consulta_cliente);
			while ($dato_base=$consulta_bases->fetch(PDO::FETCH_NUM))
			{
			$dato_de_base=$dato_base[0];
			}
			
				if (empty($dato_de_base))
				{
			
				$bases_cargadas="insert into cliente
				values
				('$shi_codigo','$gui_llave','$cli_nombre','$cli_direccion1','$cli_direccion2','$cli_telefono1','$cli_telefono2','$cic_inicio','$zon_codigo','$cli_coord_x','$cli_coord_y','$cli_fecha_ing','$ecli_codigo','$pro_codigo','$departamento','$municipio','$tipo_zona','$aud_estacion','$aud_usuario_proc','$aud_fecha_proc','$aud_hora_proc')";
				//echo $bases_cargadas."<br>";
				$try1=$dbh->query($bases_cargadas);
					if($try1)
					{
					$inserts++;
					}
				
				}else
				{
				
				$update_cliente="
				update cliente
				set (cli_nombre,cli_direccion1,cli_direccion2,cli_telefono1)=('$cli_nombre','$cli_direccion1','$cli_direccion2','$cli_telefono1')
				where shi_codigo='$shi_codigo'
				and gui_llave='$cli_codigo'
				";
				//echo $update_cliente."<br>";
					$try2=$dbh->query($update_cliente);

					if($try2)
					{
					$updates++;
					}
					
				}
					
					
					
					
					
		}
		//fin while
					
					
	}
	//fin if xls
					
	include('vista/cabecera.php');
	include('vista/menu.php');
	
	?>
					<tr>
						<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Carga de Clientes por Archivo<br />
								<span class='textogris_bold'>Selecciona el archivo xls en la casilla de archivo. </span></p></td>
						<tr><td bgcolor='#434343'>
								<table width='100%' border='0' cellspacing='0' cellpadding='1' >
									<tr>
										<td colspan='6' height='30'  align="center" bgcolor='silver'>
										<div id="formulario">
										Archivo Cargado Satisfactoriamente con <?php echo $inserts; ?> registro(s) ingresados y <?php echo $updates; ?> Actualizados.
									</div>
								</td>
							</tr>
							
						</td>
					</tr>
					
					<?php
					     include('vista/pie.php');
					     
					     
}




























public function formatos_guias()
{
/*ini_set ("display_errors","1" );
error_reporting(E_ALL);*/
include('../class/db.php');

$mys= new Db();
if(!empty($_SESSION['cod_usuario']))
{
$bd=dbp::getInstance();

include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');
$cab=new model_con();
$reailp=$cab->realip();

	$msq=new model_con();
	$cmy=$msq->conectam();
	$opcion=$msq->formato_impresion($shi_codigo);

	?>
	<style type="text/css">
		@import url("css/form.css");
	</style>

	<style type="text/css">
		@import url("../css/formulario.css");
	</style>
	<script>
		function valida_envia()
		{
		document.formulario.submit();
		}
		function submit_query1()
		{
		xajax.$('guardar_formato').disabled=true;
		xajax.$('guardar_formato').value="Por Favor Espere...";
		xajax_guarda_formato(document.formulario.formato_guia.value);
		return false;
		}
		function pulsar(e) {
		tecla = (document.all) ? e.keyCode :e.which;
		return (tecla!=13);
		}

	</script>
	<!--<body onload="document.formulario.referencia.focus();">-->
	<tr>
	<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Generaci&oacute;n de Gu&iacute;as de Env&iacute;os<br />
	<span class='textogris_bold'>Ingrese los datos conocidos en los campos de inter&eacute;s. </span></p></td>
	<tr><td bgcolor='#434343'><br>
		<table width='100%' border='0' cellspacing='0' cellpadding='1' >
		<tr>

		<div id="formulario">
		<form id='formulario' method="post" name="formulario" action="../class/test_pdf.php" target='_blank'>
		<table border='0' align='center' bgcolor='#F1F1F1' cellpadding='1' cellspacing='0'>
		</tr>
		<td colspan='6' height='30'  align="center" style='background:url(vista/imgs/grad1.png) repeat-x;' ></td>
		</td>
		</tr>

		<tr>
			<td><?php echo $msq->select_tipo_impresion(); ?>
			</td>
			<td colspan="3"> </td>
		</tr>

		<tr>
			<td>Opcion Actual:  <?php echo $opcion; ?>
			</td>
			<td colspan="3"> </td>
		</tr>

		

		
		<tr>
			<td colspan='6' height='25' align="center" ><input type='button' class="boton_submit" value='Test Formato Actual' name='enviar' onclick="valida_envia()"><input type='button' class="boton_submit" value='Definir Formato' name='guardar_formato' id='guardar_formato' OnClick="submit_query1()">
		</td>
		
		</tr>
		<tr>
			<td colspan='4'><div id='info_formato'></div></td>
		</tr>
		
		<td colspan='6' height='40'  align="center" style='background:url(vista/imgs/grad2.png) repeat-x;'></td>
	</td>
	</tr>
</table>

<br>
	<?php
		include('vista/pie.php');
		}
		else
		{
		echo "Debes iniciar session";
		}
		return true;

						     
}








public function consulta_tigo_money()
{
include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');
if(!empty($_SESSION['cod_usuario']))
{
?>
<tr>
<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Consulta de Clientes<br />
<span class='textogris_bold'> Click en Consultar para ver el estado de su env&iacute;o / Recolecci&oacute;n</span></p></td>
<tr><td bgcolor='#434343'>

<table width='100%' border='0' cellspacing='0' cellpadding='1'>
<tr>
<td height='60' bgcolor='white' align='center' width='500'>
	<form id='formulario' method="post" name="tt">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" align="left" valign="top" class="textogris_bold">
	<table cellspacing="1" bgcolor="#CCCCCC" cellpadding="4">

	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold">Sucursal :</td>
	<td><?php echo list_agente_tigo(); ?></td>
	</tr>

	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold" nowrap> Tipo Fecha :</td>
	<td class="textogris_bold"><input type='radio' name='tipo_fecha' value='C' checked='true'>Cualquiera<input type='radio' name='tipo_fecha' value='R'>Rango</td>
	</tr>

	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold">Desde:</td>
	<td nowrap><?php echo procFecIni(); ?><span class="textogris_bold"> Hora:</span><?php echo hora_ini(); ?></td>
	</tr>


	</tr>
	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold">Hasta:</td>
	<td nowrap><?php echo procFecFin(); ?><span class="textogris_bold"> Hora:</span><?php echo hora_fin(); ?></td>
	</tr>

	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold">TXN :</td>
	<td><input class='boton_submit' name='txn' id='txn' type='text' size='5' maxlength='2'></td>
	</tr>

	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold">ID Acuse :</td>
	<td><input class='boton_submit' name='id_acuse' id='id_acuse' type='text'></td>
	</tr>
	<tr bgcolor="#FFFFFF">
	<td colspan="2" align="center"><input type="button" value='Consultar' class='boton_submit' id='consultar' onClick="xajax_coincidencias(xajax.getFormValues('formulario'))" height="16" /></a></td>
	</tr>
	</table>
	</tr>
	</table>
	</td>

 			</td><td bgcolor='white'>
				<div id='comercial'>
				<a class='textorojo_bold'>Saber llegar es encontrar la solucion justa, para cada uno de tus env&iacute;os.</br></a>
				<a class='textogris2'>Apoyese en urbano y su amplia red de distribuci&oacute;n, acostumbrada a manejar eficazmente los desaf&iacute;os log&iacute;sticos m&aacute;s complejos.</a>
				</div>
				</td>
			</tr>
			<tr>
				<td bgcolor='white' colspan='2'>
					<div id='div_dat'>
					</div>
				</td>
			
			</tr>
			
			
				</table>
				</form>
			
			
			
			</div>
			</td>
			
			</tr>
			
				<tr>
				<td bgcolor='white'>
				<form name=\"form\" id=\"form\" method=\"POST\" action=\"$procPagina?prc=mov_corrientes\">
				<a class='textogris2'>Selecciona el envio con click: </a><br>
						
				<div id='detalle_envio'>
				<select multiple=\"multiple\" name=\"corte\" id=\"corte\" size=\"4\" 
			         onlclick =\"xajax_mov_data(this.value)\" class='boton_submit'>
				</select>
				</div>
						
						
			</form>
			</td>
			</tr>
			<tr>
			<td bgcolor='#F1F1F1'>
			<span class='textogris4'>
			<tr>
				<td colspan='2' bgcolor='F1F1F1'>
					
					<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
						<tr>
							<td height='0' bgcolor='#ffffff'>
								
								<div id='div_mov'>
									<img src='vista/imgs/smile.png' >
								</div>
									
									
									<!--<div id="map" style="width: 470px; height: 370px"></div>-->
							</td>
							
						</tr>
						</table>
						
						
					</td>
				</tr><tr>
				<td height='400' cellpadding="1" width='100%' bgcolor='#808080' valign='top' colspan='2' >
<div id='img'>
</div>

</span>
</td>
</tr>
</td>
</tr>

<?php
	}
	else
	{
		echo "Debes iniciar session";
	}
	include('vista/pie.php');
}


public function consulta_x_re()
{
include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');
if(!empty($_SESSION['cod_usuario']))
{
?>
<tr>
<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Consulta de Clientes<br />
<span class='textogris_bold'> Click en Consultar para ver el estado de su env&iacute;o / Recolecci&oacute;n</span></p></td>
<tr><td bgcolor='#434343'>

<table width='100%' border='0' cellspacing='0' cellpadding='1'>
<tr>
<td height='60' bgcolor='white' align='center' width='500'>
	<form id='formulario' method="post" name="tt">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" align="left" valign="top" class="textogris_bold">
	<table cellspacing="1" bgcolor="#CCCCCC" cellpadding="4">

        <tr bgcolor="#FFFFFF">
	<td class="textogris_bold">Telefono Agente :</td>
	<td>
	<input class='boton_submit' name='tel_agente' id='tel_agente' type='text'></td>
	</tr>		

	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold" >Departamento :</td>
	<td><?php echo list_depto(); ?></td>
	</tr>
	
	
	<tr bgcolor="#FFFFFF">
	<td class="textogris_bold" nowrap>Municipio :</td>
	<td class="textogris_bold">
			<div id="select_muni">
			</div>
	</td>
	</tr>
		
	
	<tr bgcolor="#FFFFFF">
	<td colspan="2" align="center">
	<input type="button" value='Consultar' class='boton_submit' id='consultar' onClick="xajax_coincidencia_x_muni(xajax.getFormValues('formulario'))" height="16" /></a>
	</td>
	</tr>
	</table>
	</tr>
	</table>
	</td>

 			</td><td bgcolor='white'>
				<div id='comercial'>
				<a class='textorojo_bold'>Saber llegar es encontrar la solucion justa, para cada uno de tus env&iacute;os.</br></a>
				<a class='textogris2'>Apoyese en urbano y su amplia red de distribuci&oacute;n, acostumbrada a manejar eficazmente los desaf&iacute;os log&iacute;sticos m&aacute;s complejos.</a>
				</div>
				</td>
			</tr>
			<tr>
				<td bgcolor='white' colspan='2'>
					<div id='div_dat'>
					</div>
				</td>
			
			</tr>
			
			
				</table>
				</form>
			
			
			
			</div>
			</td>
			
			</tr>
			
				<tr>
				<td bgcolor='white'>
				<form name=\"form\" id=\"form\" method=\"POST\" action=\"$procPagina?prc=mov_corrientes\">
				<a class='textogris2'>Selecciona el envio con click: </a><br>
						
				<div id='detalle_envio'>
				<select multiple=\"multiple\" name=\"corte\" id=\"corte\" size=\"4\" 
			         onlclick =\"xajax_mov_data_x_muni(this.value)\" class='boton_submit'>
				</select>
				</div>
						
						
			</form>
			</td>
			</tr>
			<tr>
			<td bgcolor='#F1F1F1'>
			<span class='textogris4'>
			<tr>
				<td colspan='2' bgcolor='F1F1F1'>
					
					<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
						<tr>
							<td height='0' bgcolor='#ffffff'>
								
								<div id='div_mov'>
									<img src='vista/imgs/smile.png' >
								</div>
									
									
									<!--<div id="map" style="width: 470px; height: 370px"></div>-->
							</td>
							
						</tr>
						</table>
						
						
					</td>
				</tr><tr>
				

</span>
</td>
</tr>
</td>
</tr>

<?php
	}
	else
	{
		echo "Debes iniciar session";
	}
	include('vista/pie.php');
}



public function consulta_carpeta()
{
include('vista/cabecera.php');
include('vista/menu.php');
include('model/model_con.php');
if(!empty($_SESSION['cod_usuario']))
{
?>
<tr>
<td align='left' valign='top'  bgcolor='#F1F1F1' ><p align='left' class='textogris1'>Formulario de Consulta de Clientes<br />
<span class='textogris_bold'> Click en Consultar para ver el estado de su env&iacute;o / Recolecci&oacute;n</span></p></td>
<tr><td bgcolor='#434343'>

<table width='100%' border='0' cellspacing='0' cellpadding='1'>
<tr>
<td height='60' bgcolor='white' align='center' width='500'>
	<form id='formulario' method="post" name="tt">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td colspan="2" align="left" valign="top" class="textogris_bold">
	<table cellspacing="1" bgcolor="#CCCCCC" cellpadding="4">

        
	</table>
	</tr>
	</table>
	</td>

 			</td><td bgcolor='white'>
				<div id='comercial'>
				<a class='textorojo_bold'>Saber llegar es encontrar la solucion justa, para cada uno de tus env&iacute;os.</br></a>
				<a class='textogris2'>Apoyese en urbano y su amplia red de distribuci&oacute;n, acostumbrada a manejar eficazmente los desaf&iacute;os log&iacute;sticos m&aacute;s complejos.</a>
				</div>
				</td>
			</tr>
			<tr>
				<td bgcolor='white' colspan='2'>
					<div id='div_dat' >
		
					</div>
				</td>
			
			</tr>
			
			
				</table>
				</form>
			
			
			
			</div>
			</td>
			
			</tr>
			
			<tr>
			<td bgcolor='#F1F1F1'>
			<span class='textogris4'>
			<tr>
				<td colspan='2' bgcolor='F1F1F1'>
					
					<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
						<tr>
							<td height='0' bgcolor='#ffffff'>
								
							<div id='div_mov'style="OVERFLOW: auto; WIDTH: 1024px; TOP: 48px; HEIGHT: 550px">
							<table align='center' border='1' bgcolor='#FFFFFF' width='450' cellpadding='0' cellspacing='0' bordercolor='#C1C1C1'>
							<thead>
							<tr bgcolor='#C80000' class='textogris1'>
							<th class='Texblanco_Bold22'>CORR.</th>
							<th class='Texblanco_Bold22' >CODIGO SUCURSAL</th>
							<th class='Texblanco_Bold22' >CANTIDAD DE ACUSES</th>
							
							
							</tr>
							</thead>
							<tbody>
							<?php
								function listar_directorios_ruta($ruta)
								{
									
									$tabla ="";
										// abrir un directorio y listarlo recursivo
									if (is_dir($ruta)) 
									{
										if ($dh = opendir($ruta)) 
										{
											$cantidad=0;
											$acumulador=0;
											$corr=1;
										while (($file = readdir($dh)) !== false) 
										{
											//esta línea la utilizaríamos si queremos listar todo lo que hay en el directorio
											//mostraría tanto archivos como directorios
											//echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
											if (is_dir($ruta . $file) && $file!="." && $file!="..")
											{
												//solo si el archivo es un directorio, distinto que "." y ".."
												//echo "<br>Directorio: $ruta$file";
												$trozo=explode("-",$file);
												$cantidad=count(glob($ruta.$file."/{*.jpg}",GLOB_BRACE));
												$tabla .= "<tr>
										<td class='textogris1  align='center>$corr</td>
										
										<td class='textogris1  align='center> Sucursal - ".$trozo[0]."</td>
										
										<td class='textogris1  align='center>".$cantidad."</td>
													</tr>";
														
												$acumulador=$acumulador+$cantidad;
												$corr ++;
												//listar_directorios_ruta($ruta . $file . "/");
											}
										}
											closedir($dh);
										}
									}
									else
									{
										echo "<br>No es ruta valida";
									}
									
									$tabla .="<tr>
										<td colspan='2'>TOTAL ACUSES</TD>
										<td >$acumulador</td>
										</tr>		
										</table>
										";
										
										return $tabla;
									}
		
								$inicHtml =listar_directorios_ruta("../../jpgs5/");
									
								echo $inicHtml;
							?>
									
		
		
		
									<img src='vista/imgs/smile.png' >
								</div>
									<!--<div id="map" style="width: 470px; height: 370px"></div>-->
							</td>
							
						</tr>
						</table>
						
						
					</td>
				</tr><tr>
				
			
</tr>
</td>
</tr>

<?php
	}
	else
	{
		echo "Debes iniciar session";
	}
	include('vista/pie.php');
}





}











?>