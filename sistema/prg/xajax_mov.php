<?php
function mov($form)
{
//     ini_set ("display_errors","1" );
//     error_reporting(E_ALL);

$respuesta = new xajaxResponse();
$error_form="test";
$gui=$form['gui'];
$ref=$form['ref'];
//$respuesta->assign('detalle_envio','innerHTML',"<img src='vista/imgs/smile.png' >");
//$respuesta->assign('detalle_envio','innerHTML',$error_form);
//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.9)");
//$respuesta->script("jQuery('#detalle_envio').animate({ width:'340px', height:'80px' }, 1000)");
//$respuesta->script("jQuery('#detalle_envio').animate({ fontSize:'40px'},1000);");
//$respuesta->assign('div_mov','innerHTML',"<img src='vista/imgs/smile.png' >");

/* aumentamos el tamaño de la fuente */


//$respuesta->script("jQuery('#div_mov').animate({ marginLeft:'700px'},1500)");
//$respuesta->assign('detalle_envio','innerHTML',"<img src='vista/imgs/smile.png' >");, 3000 )");
//$respuesta->assign('detalle_envio','innerHTML',$gui." ".$ref);
//$respuesta->script("jQuery('#detalle_envio').slideUp('slow')");
//slideDown('slow')
$pre=$form['pre'];
if(empty($pre))
{
$prefix="track/sistema/";
}else
{
$prefix="";
}
include($prefix.'model/model_mov.php');

$cab=new model_mov();

$stmt=$cab->detalle_cuenta_qr($gui,$ref);

while($row=$cab->fetch($stmt))
{

$id_detalle         =$row[0];
$referencia         =$row[1];
$barra              =$row[2];
$tipo_envio         =$row[3];
$remitente          =$row[4];
$nom_remitente      =$row[5];
$dir_remitente      =$row[6];
$cod_municipio_ori  =$row[7];
$tel_remitente      =$row[8];
$destinatario       =$row[9];
$nom_destinatario   =$row[10];
$dir_destinatario   =$row[11];
$cod_municipio_des  =$row[12];
$tel_destinatario   =$row[13];
$cantidad           =$row[14];
$observaciones      =$row[15];
$seguro             =$row[16];
$fecha_envio        =$row[17];
$usuario            =$row[18];
$hora               =$row[19];
$tiempo             =$row[20];
$real_ip            =$row[21];
$monto              =$row[22];
$tipo_producto      =$row[23];
$documento          =$row[24];
$shi_codigo         =$row[25];
$emp_remitente      =$row[26];
$emp_destinatario   =$row[27];

$trozo_fecha_origen=explode("-",$fecha_envio);
$fecha_origen=$trozo_fecha_origen[2]."-".$trozo_fecha_origen[1]."-".$trozo_fecha_origen[0];





$shipper=$cab->detalle_shipper($shi_codigo);

$fila_shipper=$cab->fetch($shipper);

$nombre_shipper=$fila_shipper[1];

$datos_cliente="

<table id='tabla-a'>
<tr>
<th colspan='2' align='center'>Detalles de Cuenta</th>
</tr>

<tr>
<td>Origen :</td>
<td>$emp_remitente</td>
</tr>

<tr>
<td>Destino :</td>
<td>$nom_destinatario</td>
</tr>
<tr>
<td>Direcci&oacute;n :</td>
<td>$dir_destinatario</td>
</tr>

<tr>
<td>Tel&eacute;fono :</td>
<td>$tel_destinatario</td>
</tr>


";

$respuesta->assign('div_shipper','innerHTML',"Bienvenido Cliente ".$nombre_shipper);
$respuesta->script("jQuery('#div_shipper').fadeTo('slow',0.7)");
//$respuesta->assign('detalle_envio','innerHTML',$datos_cliente);
$respuesta->assign('detalle_envio','innerHTML',"<img src='".$prefix."vista/imgs/Logistic2.png'>");
//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.5)");
$respuesta->script("jQuery('#detalle_envio').animate({ marginLeft:'450px'},1500)");
//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.5)");
//$respuesta->append('detalle_envio','innerHTML',"<img src='".$prefix."vista/imgs/smile.png'>");
}



$tabla_mov=$datos_cliente."

<table id='tabla-a'>
	<tr>
		<th colspan='2' align='center'>Detalles del env&iacute;o</th>
	</tr>
	<tr>
		<td>Fecha y hora recepci&oacute;n :</td><td>$fecha_origen $hora</td>
	</tr><tr>
		<td>Observaciones :</td><td>$observaciones</td>
	</tr><tr>
		<td>Documento :</td><td>$documento</td>
	</tr>
	
</table>
<span class='textorojob'>
Movimientos internos :
</span>


<table id='tabla-b'>
	<tr>
	<th>Fecha </th><th> Hora</th>
	<th colspan='2'>Descripci&oacute;n</th>
	<th>Lugar</th>
	</tr>
";




$guia_detalle=$cab->consulta_guia_detalle($barra);

$mov=$cab->consulta_movimientos($guia_detalle);


while($item = $cab->fetch($mov))
{
$gui_llave           =$item[0];
$chk_codigo          =$item[1];
$mot_codigo	     =$item[2];
$gui_numero          =$item[3];
$mov_recibio         =$item[4];
$mov_lugar           =$item[5];
$mov_hora_recepcion  =$item[6];
$cou_codigo          =$item[7];
$marca_tiempo        =$item[8];
$dat_numid           =$item[9];
$aud_estacion        =$item[10];
$aud_usuario_proc    =$item[11];
$aud_fecha_proc      =$item[12];
$aud_hora_proc       =$item[13];
$cod_sucursal_ori    =$item[14];
$cod_sucursal_des    =$item[15];
$descripcion	     =$cab->consulta_chk_detalle(trim($chk_codigo));
$regiones	     =$cab->consulta_origen_destino($gui_llave);
$trozo_reg	     =explode("-",$regiones);
$origen		     =$cab->prov_nombre($trozo_reg[0]);
$destino	     =$cab->prov_nombre($trozo_reg[1]);


	
$trozo_fecha=explode("-",$aud_fecha_proc);
$fecha=$trozo_fecha[2]."-".$trozo_fecha[1]."-".$trozo_fecha[0];
	
if($chk_codigo=='AR')
{
$region=$origen;
}else
{
$region=$destino;
}
	
$tabla_mov .="
	<tr>
	<td>".$fecha."</td><td> ".$aud_hora_proc." </td>
	<td> <img src='".$prefix."vista/imgs/".strtolower($chk_codigo).".png' width='36'></td>
	<td> ".$descripcion."</td>
	<td>".$region."</td>
	</tr>
";




}






$tabla_mov.="
</table>
";



$respuesta->assign('div_mov','innerHTML',$tabla_mov);
//$respuesta->script("jQuery('#div_mov').animate({ marginLeft:'80px'},1500)");






$ruta_dl="reportes/imagenes5";
	if(file_exists($ruta_dl."/".trim($barra).".jpg"))
	{
	$imagen_dl = "
	<table id='tabla-b' >
		<tr><th align='center'>Imagen de Entrega</th>
		</tr>
		<tr>
		<td align='center'>
		<img src='".$ruta_dl."/".trim($barra).".jpg' width='700' >
		<td>
		</tr>
		<tr>
		<td align='center'>
		<img src='".$prefix."vista/imgs/banner.png' width='700'>
		<td>
		</tr>
	</table>
	";
	}elseif(file_exists("../../".$ruta_dl."/".trim($barra).".jpg"))
	{
	$imagen_dl = "
	<table id='tabla-b' >
		<tr><th align='center'>Imagen de Entrega</th>
		</tr>
		<tr>
			<td align='center'>
				<img src='../../".$ruta_dl."/".trim($barra).".jpg' width='700' >
					<td>
					</tr>
					<tr>
						<td align='center'>
							<img src='".$prefix."vista/imgs/banner.png' width='700'>
								<td>
								</tr>
							</table>
							";
	}else
	{
	$imagen_dl = "
	<table id='tabla-b' >
		<tr><th>Imagen de Entrega</th>
		</tr>
		<tr>
		<td>
		Imagen A&uacute;n No Disponible
		<td>
		</tr>
		<tr>
		<td>
		<img src='".$prefix."vista/imgs/banner.png' width='700'>
		<td>
		</tr>
		</table>
		";

	}


//$respuesta->script("jQuery('#img').animate({ marginLeft:'80px'},1500)");
$respuesta->assign("img","innerHTML",$imagen_dl);



return $respuesta;
}



function mov2($form)
{
//     ini_set ("display_errors","1" );
//     error_reporting(E_ALL);

$respuesta = new xajaxResponse();
$error_form="test";
$gui=$form['gui'];
$pre=$form['pre'];
if(empty($pre))
{
$prefix="track/sistema/";
}else
{
$prefix="";
}
include($prefix.'model/model_mov.php');

$cab=new model_mov();

$stmt=$cab->detalle_cuenta_qr2($gui);

while($row=$cab->fetch($stmt))
{

$id_detalle         =$row[0];
$referencia         =$row[1];
$barra              =$row[2];
$tipo_envio         =$row[3];
$remitente          =$row[4];
$nom_remitente      =$row[5];
$dir_remitente      =$row[6];
$cod_municipio_ori  =$row[7];
$tel_remitente      =$row[8];
$destinatario       =$row[9];
$nom_destinatario   =$row[10];
$dir_destinatario   =$row[11];
$cod_municipio_des  =$row[12];
$tel_destinatario   =$row[13];
$cantidad           =$row[14];
$observaciones      =$row[15];
$seguro             =$row[16];
$fecha_envio        =$row[17];
$usuario            =$row[18];
$hora               =$row[19];
$tiempo             =$row[20];
$real_ip            =$row[21];
$monto              =$row[22];
$tipo_producto      =$row[23];
$documento          =$row[24];
$shi_codigo         =$row[25];
$emp_remitente      =$row[26];
$emp_destinatario   =$row[27];

$trozo_fecha_origen=explode("-",$fecha_envio);
$fecha_origen=$trozo_fecha_origen[2]."-".$trozo_fecha_origen[1]."-".$trozo_fecha_origen[0];





$shipper=$cab->detalle_shipper($shi_codigo);

$fila_shipper=$cab->fetch($shipper);

$nombre_shipper=$fila_shipper[1];

$datos_cliente="

<table id='tabla-a'>
<tr>
<th colspan='2' align='center'>Detalles de Cuenta</th>
</tr>

<tr>
<td>Origen :</td>
<td>$emp_remitente</td>
</tr>

<tr>
<td>Destino :</td>
<td>$nom_destinatario</td>
</tr>
<tr>
<td>Direcci&oacute;n :</td>
<td>$dir_destinatario</td>
</tr>

<tr>
<td>Tel&eacute;fono :</td>
<td>$tel_destinatario</td>
</tr>


";

$respuesta->assign('div_shipper','innerHTML',"Bienvenido Cliente ".$nombre_shipper);
$respuesta->script("jQuery('#div_shipper').fadeTo('slow',0.7)");
//$respuesta->assign('detalle_envio','innerHTML',$datos_cliente);
$respuesta->assign('detalle_envio','innerHTML',"<img src='".$prefix."vista/imgs/Logistic2.png'>");
//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.5)");
$respuesta->script("jQuery('#detalle_envio').animate({ marginLeft:'450px'},1500)");
//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.5)");
//$respuesta->append('detalle_envio','innerHTML',"<img src='".$prefix."vista/imgs/smile.png'>");
}






if(!empty ($barra))
{






$tabla_mov=$datos_cliente."

<table id='tabla-a'>
	<tr>
		<th colspan='2' align='center'>Detalles del env&iacute;o</th>
	</tr>
	<tr>
		<td>Fecha y hora recepci&oacute;n :</td><td>$fecha_origen $hora</td>
	</tr><tr>
		<td>Observaciones :</td><td>$observaciones</td>
	</tr><tr>
		<td>Documento :</td><td>$documento</td>
	</tr>
	
</table>
<span class='textorojob'>
Movimientos internos :
</span>


<table id='tabla-b'>
	<tr>
	<th>Fecha </th><th> Hora</th>
	<th colspan='2'>Descripci&oacute;n</th>
	<th>Lugar</th>
	</tr>
";







$guia_detalle=$cab->consulta_guia_detalle($barra);

$mov=$cab->consulta_movimientos($guia_detalle);


while($item = $cab->fetch($mov))
{
$gui_llave           =$item[0];
$chk_codigo          =$item[1];
$mot_codigo	     =$item[2];
$gui_numero          =$item[3];
$mov_recibio         =$item[4];
$mov_lugar           =$item[5];
$mov_hora_recepcion  =$item[6];
$cou_codigo          =$item[7];
$marca_tiempo        =$item[8];
$dat_numid           =$item[9];
$aud_estacion        =$item[10];
$aud_usuario_proc    =$item[11];
$aud_fecha_proc      =$item[12];
$aud_hora_proc       =$item[13];
$cod_sucursal_ori    =$item[14];
$cod_sucursal_des    =$item[15];
$descripcion	     =$cab->consulta_chk_detalle(trim($chk_codigo));
$regiones	     =$cab->consulta_origen_destino($gui_llave);
$trozo_reg	     =explode("-",$regiones);
$origen		     =$cab->prov_nombre($trozo_reg[0]);
$destino	     =$cab->prov_nombre($trozo_reg[1]);


	
$trozo_fecha=explode("-",$aud_fecha_proc);
$fecha=$trozo_fecha[2]."-".$trozo_fecha[1]."-".$trozo_fecha[0];
	
if($chk_codigo=='AR')
{
$region=$origen;
}else
{
$region=$destino;
}
	
$tabla_mov .="
	<tr>
	<td>".$fecha."</td><td> ".$aud_hora_proc." </td>
	<td> <img src='".$prefix."vista/imgs/".strtolower($chk_codigo).".png' width='36'></td>
	<td> ".$descripcion."</td>
	<td>".$region."</td>
	</tr>
";




}


}else
{



$respuesta->script("alert('No existen Movimientos relacionados a este envio')");



$tabla_mov.="
<table>
<tr><td>
No existen Movimientos relacionados a este env&iacute;o
</td></tr>
";

}



$tabla_mov.="
</table>
";



$respuesta->assign('div_mov','innerHTML',$tabla_mov);
//$respuesta->script("jQuery('#div_mov').animate({ marginLeft:'80px'},1500)");






$ruta_dl="reportes/imagenes5";
	if(file_exists($ruta_dl."/".trim($barra).".jpg"))
	{
	$imagen_dl = "
	<table id='tabla-b' >
		<tr><th align='center'>Imagen de Entrega</th>
		</tr>
		<tr>
		<td align='center'>
		<img src='".$ruta_dl."/".trim($barra).".jpg' width='700' >
		<td>
		</tr>
		<tr>
		<td align='center'>
		<img src='".$prefix."vista/imgs/banner.png' width='700'>
		<td>
		</tr>
	</table>
	";
	}elseif(file_exists("../../".$ruta_dl."/".trim($barra).".jpg"))
	{
	$imagen_dl = "
	<table id='tabla-b' >
		<tr><th align='center'>Imagen de Entrega</th>
		</tr>
		<tr>
			<td align='center'>
				<img src='../../".$ruta_dl."/".trim($barra).".jpg' width='700' >
					<td>
					</tr>
					<tr>
						<td align='center'>
							<img src='".$prefix."vista/imgs/banner.png' width='700'>
								<td>
								</tr>
							</table>
							";
	}else
	{
	$imagen_dl = "
	<table id='tabla-b' >
		<tr><th>Imagen de Entrega</th>
		</tr>
		<tr>
		<td>
		Imagen A&uacute;n No Disponible
		<td>
		</tr>
		<tr>
		<td>
		<img src='".$prefix."vista/imgs/banner.png' width='700'>
		<td>
		</tr>
		</table>
		";

	}


//$respuesta->script("jQuery('#img').animate({ marginLeft:'80px'},1500)");
$respuesta->assign("img","innerHTML",$imagen_dl);



return $respuesta;
}




?>