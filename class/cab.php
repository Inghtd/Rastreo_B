<?php
//cabecera
require_once('db.php');

	function test_xajax()
	{
	$respuesta = new xajaxResponse();
	$error_form="test";
	$respuesta->assign("mensaje","innerHTML","<span class='textorojo_bold'>".$error_form."</span>");
	return $respuesta;
	}


	function cuenta($cuenta)
	{
	$respuesta = new xajaxResponse();
		$respuesta 	= new xajaxResponse();

		$marca		= time();
		$fecha 		= date('Y-m-d');
		$hora	        = date('H:i:s');
		$usuario	= $_SESSION['cod_usuario'];
		$shi_codigo	= $_SESSION['shi_codigo'];

		include('model/model_con.php');
		
		$con=new model_con();
		$cou=$con->consulta_cuenta($cuenta);

		while($row = $con->fetch($cou))
		{
		$cli_nombre        =trim($row[2]);
		$cli_direccion1    =trim($row[3]);
		$cli_direccion2	   =trim($row[4]);
		$cli_telefono1     =trim($row[5]);
		$cli_telefono2     =trim($row[6]);
		$cli_municipio	   =trim($row[15]);
		}


	if(!empty($cli_nombre))
	{
		$respuesta->assign("nom_remitente","value",$cli_nombre);
		$respuesta->assign("dir_remitente","value",$cli_direccion1.$cli_direccion2);
		$respuesta->assign("tel_remitente","value",$cli_telefono1);
		$respuesta->assign("empresa","value",$cli_telefono2);
		$respuesta->assign("municipio","value",$cli_municipio);
		$respuesta->assign("observaciones","value","");
		$respuesta->script( "xajax.$('municipio').focus();" );
		$respuesta->script( "xajax.$('municipio').select();");
	}	//$respuesta->assign("enlaces","innerHTML",$cou);
		return $respuesta;
	}


	function procFecIni()
	{
		//Generando cmb de Dias
		$retorno = "<select name='fec_ini_dia' id='fec_ini_dia' class=\"fecha\">";
		$dia=date("d");
		$limitedia=31;
		for ($i=1;$i<=$limitedia;$i++){
			$retorno .= "<option value=\"$i\"";
					if ($i==$dia){
						$retorno .= "selected>";
					}else{
						$retorno .= ">";
					}
		$retorno .= "$i</option>\n";
		}
	$retorno .= "</select>";

	//Generando cmb de Meses
	$retorno .= "<select name='fec_ini_mes'  id='fec_ini_mes' width='30' class=\"fecha\" >";

	//setlocale("LC_ALL","SP");
	$mes=date("m");

	for($i=1;$i<13;$i++){
		if ($i<10){
			$retorno .= "<option value=\"$i\"";
		
		}else{
			$retorno .= "<option value=\"$i\"";

		}
		if ($i==$mes){
			$retorno .= "selected>";
		}else{
			$retorno .= ">";
		}
		
		switch ($i) {
		case 1:
			$nmes="ene";
			break;
		case 2:
			$nmes="feb";
			break;
		case 3:
			$nmes="mar";
			break;
		case 4:
			$nmes="abr";
			break;
		case 5:
			$nmes="may";
			break;
		case 6:
			$nmes="jun";
			break;
		case 7:
			$nmes="jul";
			break;
		case 8:
			$nmes="ago";
			break;
		case 9:
			$nmes="sep";
			break;
		case 10:
			$nmes="oct";
			break;
		case 11:
			$nmes="nov";
			break;
		case 12:
			$nmes="dic";
			break;
		}

	$retorno .= "$nmes </option>\n";
	}

	$retorno .= "</select>";
	//Generando cmb de a�os
	$retorno .= "<select name='fec_ini_ano' id='fec_ini_ano' width='30' class='fecha'>";
	$ano=date("Y");
	$anoa=$ano-1;
	$anob=$ano+1;
	$retorno .= "<option value=\"$anoa\">$anoa</option>\n";
	$retorno .= "<option value=\"$ano\"selected>$ano</option>\n";
	$retorno .= "<option value=\"$anob\">$anob</option>\n";
	$retorno .= "</select>";

	return $retorno;
	}

	function procFecFin()
	{
		//Generando cmb de Dias
		$retorno = "<select name='fec_fin_dia' id='fec_fin_dia' class=\"fecha\">";
		
		$dia=date("d");
		$limitedia=31;
		for ($i=1;$i<=$limitedia;$i++){
			$retorno .= "<option value=\"$i\"";
					if ($i==$dia){
						$retorno .= "selected>";
					}else{
						$retorno .= ">";
					}
		$retorno .= "$i</option>\n";
		}
	$retorno .= "</select>";

	//Generando cmb de Meses
	$retorno .= "<select name='fec_fin_mes'  id='fec_fin_mes' width='30' class=\"fecha\" >";

	//setlocale("LC_ALL","SP");
	$mes=date("m");

	for($i=1;$i<13;$i++){
		if ($i<10){
			$retorno .= "<option value=\"$i\"";
		
		}else{
			$retorno .= "<option value=\"$i\"";

		}
		if ($i==$mes){
			$retorno .= "selected>";
		}else{
			$retorno .= ">";
		}
		
		switch ($i) {
		case 1:
			$nmes="ene";
			break;
		case 2:
			$nmes="feb";
			break;
		case 3:
			$nmes="mar";
			break;
		case 4:
			$nmes="abr";
			break;
		case 5:
			$nmes="may";
			break;
		case 6:
			$nmes="jun";
			break;
		case 7:
			$nmes="jul";
			break;
		case 8:
			$nmes="ago";
			break;
		case 9:
			$nmes="sep";
			break;
		case 10:
			$nmes="oct";
			break;
		case 11:
			$nmes="nov";
			break;
		case 12:
			$nmes="dic";
			break;
		}

	$retorno .= "$nmes </option>\n";
	}

	$retorno .= "</select>";
	//Generando cmb de a�os
	$retorno .= "<select name='fec_fin_ano' id='fec_fin_ano' width='30' class=\"fecha\" >";
	$ano=date("Y");
	$anoa=$ano-1;
	$anob=$ano+1;
	$retorno .= "<option value=\"$anoa\">$anoa</option>\n";
	$retorno .= "<option value=\"$ano\"selected>$ano</option>\n";
	$retorno .= "<option value=\"$anob\">$anob</option>\n";
	$retorno .= "</select>";
	return $retorno;
	}


	function filtro($form)
	{
	//include('Connections/con.php');

	//include_once("phpsqlajax_dbinfo.php");

	$respuesta = new xajaxResponse();
	//$shi_codigo='000485';
	$shi_codigo=$_SESSION['shi_codigo'];

	$fecha_inicio = str_pad($form['fec_ini_dia'], 2, "0", STR_PAD_LEFT)."-".str_pad($form['fec_ini_mes'], 2, "0",STR_PAD_LEFT)."-".$form['fec_ini_ano'];
	$fecha_fin = str_pad($form['fec_fin_dia'], 2, "0", STR_PAD_LEFT)."-".str_pad($form['fec_fin_mes'], 2, "0",STR_PAD_LEFT)."-".$form['fec_fin_ano'];
	$producto=$form['producto'];

	$municipio=0;
	$count=0;
		include('model/model_con.php');
		
		$con=new model_con();


		$cou=$con->reporte_envios($fecha_inicio,$fecha_fin,$producto);

	$html ="
		<table align='center' border='1' bgcolor='#FFFFFF' width='998' cellpadding='0' cellspacing='0' bordercolor='#C1C1C1'>
		<thead>
		<tr bgcolor='#E31B23' class='textogris1'>

	<th class='Texblanco_Bold22'>#</th>
	<th class='Texblanco_Bold22'>REFERENCIA</th>";


	$html .="
	<th class='Texblanco_Bold22'>GUIA</th>";

if($shi_codigo=='000591')
{
	$html .="	<th class='Texblanco_Bold22'>Doc</th>";
}

	$html .="<th class='Texblanco_Bold22'>PRODUCTO</th>
	<th class='Texblanco_Bold22'>DOC</th>
	<th class='Texblanco_Bold22'>DESTINATARIO</th>
	<th class='Texblanco_Bold22'>OBSERVACIONES</th>

	<th class='Texblanco_Bold22'>MONTO</th>
	<th class='Texblanco_Bold22'>FECHA</th>

	</tr>
		</thead>
		<tbody>
	";
	//<th class='Texblanco_Bold22'>DOCUMENTO</th>


	//<div OnClick='xajax_del_registro(".$row[1].",".$row[2].")'><img src='vista/imgs/delete.png' width='32'></div>

	//<a href='https://www.urbano.com.sv/track/sistema/index.php?prc=con&accion=del&r=".$row[1]."&g=".$row[2]."'><img src='vista/imgs/delete.png' width='32'></a>
		while($row = $con->fetch($cou))
		{
		$count++;

		$html .="
		<tr>
		<td class='textogris_bold2' align='center'>$count</td>
		<td class='textogris_bold' align='center'><div id='div_".$row[1].$row[2]."'><a href='https://www.urbano.com.sv/track/sistema/index.php?prc=con&accion=prn&r=".$row[1]."&g=".$row[2]."'>".$row[1]."</a></div></td>
		<td class='textogris1' align='center'><a href='https://www.urbano.com.sv/track/sistema/index.php?prc=con&accion=cons_cli&r=".$row[1]."&g=".$row[2]."' target='_blank'>".$row[2]."</a></td>
		";
		
		if($shi_codigo=='000591')
		{
		$html .="	<th class='Texblanco_Bold22'>
		<a href='https://www.urbano.com.sv/track/sistema/index.php?prc=con&accion=datos_ccf&r=".$row[1]."&g=".$row[2]."' target='_blank'>DOC</a>
		</th>";
		}
		
		$html .="

		<td class='textogris1' align='center'>".$con->describe_producto(intval($row[23]))."</td>
		<td class='textogris1' align='center'>".$row[24]."&nbsp;</td>
		
		<td class='textogris1' align='center'>".$row[10]."</td>
		<td class='textogris1' align='center'>".$row[15]."</td>

		<td class='textogris1' align='center'>".round($row[22],2)."</td>
		<td class='textogris1' align='center'>".$row[17]."</td>
		</tr>";
		//<td class='textogris1' align='center'>".$row[0]."</td>
		//<td class='textogris1' align='center'>".$row[24]."</td>
		}

	$html .="
	</tr>
	</tbody>
	</table>


	</td></tr>";


	$respuesta->assign("div_mov","style.overflow","scroll");
	$respuesta->assign("div_mov","style.height","550");
	$respuesta->assign("div_mov","innerHTML",$html);
	//$respuesta->script("data_table");


	$enlaces="
	<table border='0' cellpadding='0' cellspacing='0'>
	<tr>
	<td align='center'><div id='texto' class='textogris1' width='200'>Opciones de Exportaci&oacute;n y vista: </div></td>
	</tr>
	<tr><td>
	<table border='0' cellpadding='0' cellspacing='0'>
	<tr><td><a href='https://www.urbano.com.sv/ups/sistema/index.php?prc=filtro_xls&accion=export&f1=".$fecha_inicio."&f2=".$fecha_fin."&m=0&m2=x' target='_blank'><img src='vista/imgs/xls.png' width='40'></a>
	</td>
	<td>
	<a href='https://www.urbano.com.sv/ups/sistema/index.php?prc=filtro_xls&accion=export&f1=".$fecha_inicio."&f2=".$fecha_fin."&m=0&m2=p' target='_blank'><img src='vista/imgs/pdf.png' width='40'></a>
	</td>
	</tr>
	<tr>
	<td align='center'><span class='link_botonera'><a href='https://www.urbano.com.sv/ups/sistema/index.php?prc=filtro_xls&accion=export&f1=".$fecha_inicio."&f2=".$fecha_fin."&m=0&m2=x' target='_blank'>xls</a></span></td>
	<td align='center'><span class='link_botonera'><a href='https://www.urbano.com.sv/ups/sistema/index.php?prc=filtro_xls&accion=export&f1=".$fecha_inicio."&f2=".$fecha_fin."&m=0&m2=p' target='_blank'>pdf</a></span></td>
	</tr>
	</table>

	</td>
	</tr>
	</table>
	";

	$respuesta->assign("enlaces","innerHTML",$enlaces);


	return $respuesta;

	}

	function prn_guia()
	{
	require('../lib/fpdf16/fpdf.php');
	require_once('../lib/fpdf16/qrcode/qrcode.class.php');
	include('../sistema/model/model_con.php');
	include('../sistema/prg/guiapdf.php');

	$referencia=$_GET['r'];
	$numero_guia=$_GET['g'];
	$shi_codigo=$_SESSION['shi_codigo'];

	$mys=new model_con();
	$cmy=$mys->conectam();

	$consulta_impresion="
	select * from sv_configuracion_guias
	where tipo='impresion'
	and valor='1'
	and shi_codigo='$shi_codigo'
	";
	
	$cmy=$mys->consultam($consulta_impresion);
	$municipio=0;
	$opcion="";
	while($rowm2 = $mys->fetchm($cmy))
	{
	$opcion=$rowm2[2];
	}



	if($opcion=="guia_carta_2_copias")
	{
	$pdf=new PDF();
	//'P','mm',array(215.9,140.0)
	$pdf=new PDF();

	$i=1;

	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);
	$pdf->addPage();
	$pdf->pagina_pos2("/tmp/texto_pricesmart.txt");
	$pdf->MultiCell(0,2,"
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	");
	$pdf->pagina_pos2("/tmp/texto_pricesmart.txt");
	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);

	//$pdf->AddPage();
	//$pdf->pagina_pos1($referencia,$numero_guia,$i);
	//$pdf->addPage();
	//$pdf->pagina_pos2("/tmp/texto_pricesmart.txt");
	$pdf->Output($numero_guia.".pdf","D");
	$pdf->Output("/tmp/".$numero_guia.".pdf","F");

	}
	else
	{
	
	
	if(!empty($opcion))
	{
	
	
	
	
	$consulta_impresion="
	SELECT a . * , b . *
	FROM sv_catalogo_guias a, sv_configuracion_guias b
	WHERE b.tipo = 'impresion'
	AND b.valor = '1'
	AND b.shi_codigo = '$shi_codigo'
	AND b.opcion = a.nombre_formato
	";
	//echo $consulta_impresion;
	$cmy=$mys->consultam($consulta_impresion);
	$municipio=0;
	while($row = $mys->fetchm($cmy))
	{
	$id_formato		=$row[0];
	$nombre_formato		=$row[1];
	$descripcion		=$row[2];
	$estado			=$row[3];
	$orientacion		=$row[4];
	$unidad			=trim($row[5]);
	$largo			=$row[6];
	$alto			=$row[7];
	$usuario_creador	=$row[8];
	$fecha_creacion		=$row[9];
	$hora_creacion		=$row[10];
	}
	
	
	
	if(!empty($unidad))
	{
	//echo $orientacion." - ".$unidad." - ".$largo." - ".$alto;
	$pdf=new PDF($orientacion,$unidad,array($largo,$alto));
	$pdf->AddPage();
	$pdf->$nombre_formato($referencia,$numero_guia);
	//$pdf->cell(10,10,$largo." - ".$alto);
	$pdf->Output($numero_guia.".pdf","D");
	//$pdf->Output("/tmp/".$numero_guia.".pdf","F");
	
	}else
	{
	
	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);
	$pdf->Output($numero_guia.".pdf","D");
	//$pdf->Output("/tmp/".$numero_guia.".pdf","F");
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}else
	{
	
	
	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);
	$pdf->Output($numero_guia.".pdf","D");
	//$pdf->Output("/tmp/".$numero_guia.".pdf","F");
	
	
	}
	
	
	
	}


	

	/*elseif($opcion=='guia_matricial1')
	{
	
	$pdf=new PDF('L','mm',array(139.7,191.1));
	$pdf->AddPage();
	$pdf->guia_matricial1($referencia,$numero_guia);
	
	
	}elseif($opcion=='guia_matricial2')
	{
	$pdf=new PDF('L','mm',array(141.0,191.1));
	$pdf->AddPage();
	$pdf->guia_matricial1($referencia,$numero_guia);
	
	}
	else
	{
	
	$pdf=new PDF();
	
	$pdf->AddPage();
	$pdf->guia_carta_2_copias($referencia,$numero_guia);
	
	
	}
	

	$pdf->Output($numero_guia.".pdf","D");
	*/

	if($shi_codigo=='000591')
	{
	$pdf_file = "\/tmp\/".$numero_guia.".pdf";
	$save_to = "\/imagenes\/imasan01\/guias\/paqueteria\/ar\/".$numero_guia.".jpg";
	exec("gs -sDEVICE=jpeg -sPAPERSIZE=halfletter -dSAFER -r800x700 \-sOutputFile=".$save_to." ".$pdf_file);
	}

	}
	
	function select_producto_total()
	{
			session_start();
			$dbp=dbp::getInstance();
			$shi_codigo=$_SESSION['shi_codigo'];
			$sql_c = "SELECT id_origen, pro_origen, contacto, direccion,telefonos, nota
			from sv_productos_remitente
			where shi_codigo='$shi_codigo'
			";
			$datos= $dbp->consultar($sql_c);

			$retorno ="<select name='producto' id='producto' class='boton_submit'>";
			if($_SESSION['nivel']==1)
			{
			$retorno .="<option value=''>Todos</option>";
			}
			$c= $dbp->consultar($sql_c);
			while ($row=$c->fetch(PDO::FETCH_NUM))
			{
			$retorno .="
			<option value='".$row[0]."'>".$row[1]."</option>
			";
			}
			$retorno .="</select>";

	return $retorno;
	}

	//Centro Costo Rastreo
	function select_ccosto()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT *
					FROM centro_costo
					WHERE cli_id='$shi_codigo'
					AND ccosto_estado=1
					AND char1 IS NULL";

		$datos= $bd->consultar($sql_c);

		$retorno ="<select name='id_ccosto' id='id_ccosto' class=\"form-control\" onchange='changeCCosto()'>
						<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[3]." ".$row[4]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	function select_ccosto_simple()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT *
					FROM centro_costo
					WHERE cli_id='$shi_codigo'
					AND ccosto_estado=1
					ANd char1 IS NULL";

		$datos= $bd->consultar($sql_c);

		$retorno ="<select name='id_ccosto' id='id_ccosto' class=\"form-control\" onchange='changeCCostoDes()'>
						<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[4]."-".$row[3]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Agencias Rastreo
	function select_agencias()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT *
					FROM agencia
					WHERE cli_id='$shi_codigo'
					AND agencia_estado=1
					AND char1 IS NULL";

		$retorno ="<select name='id_agencia' id='id_agencia' class=\"form-control\" onchange='changeAgencia()'>
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[2]." ".$row[3]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Zoans Rastreo
	function select_zonas()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT z.* 
					FROM zona z 
					INNER JOIN usuario u 
					ON z.id_usr=u.id_usr
					WHERE u.cli_codigo='$shi_codigo'";

		$retorno ="<select name='id_zona' id='id_zona' class=\"form-control\" onchange='changeZona()'>
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[1]." ".$row[2]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Mensajero Rastreo
	function select_mensajeros()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT m.* 
					FROM mensajero m 
					INNER JOIN usuario u 
					ON m.id_usr=u.id_usr
					WHERE u.cli_codigo='$shi_codigo'";

		$retorno ="<select name='id_mensajero' id='id_mensajero' class=\"form-control\" onchange='changeMensajero()'>
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[0]." ".$row[1]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Centro Costo - Agencia
	function select_age_ccosto()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT a.id_agencia,a.agencia_nombre,c.id_ccosto,c.ccosto_nombre,c.ccosto_codigo
						FROM agencia a INNER JOIN centro_costo c
						ON a.id_agencia=c.id_agencia
						WHERE c.cli_id='$shi_codigo'
						AND c.ccosto_estado=1
						ORDER BY a.id_agencia";

		$datos= $bd->consultar($sql_c);

		$retorno ="<select name='id_ccosto' id='id_ccosto' class=\"form-control\">
						<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[2]."'>".$row[4]." - ".$row[3]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Usuario Rastreo
	function select_usuario()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT *
					FROM usuario
					WHERE cli_codigo='$shi_codigo'
					";

		$datos= $bd->consultar($sql_c);

		$retorno ="<select name='usr_cod' id='usr_cod' class=\"form-control\" onchange='changeUsuario()'>
						<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[1]." ".$row[3]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Generador numid Rastreo
	function genera_numid()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
	
		//Se crea una funcion para generar, aca pueden realizar mas acciones de control numid
		$retorno = date('Ymdhis');

		return $retorno;
	}

	function zona_ld(){
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT z.* 
					FROM zona z 
					INNER JOIN usuario u 
					ON z.id_usr=u.id_usr
					WHERE u.cli_codigo='$shi_codigo'
					AND z.zon_codigo !='ZZ'";

		$retorno ="<select name='id_zona' id='id_zona' class=\"form-control\" readonly>
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[1]." ".$row[2]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	function mensajero_ld(){
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT m.* 
					FROM mensajero m 
					INNER JOIN usuario u 
					ON m.id_usr=u.id_usr
					WHERE u.cli_codigo='$shi_codigo'
					AND m.id_mensajero !=1";

		$retorno ="<select name='id_mensajero' id='id_mensajero' class=\"form-control\" readonly>
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[0]." ".$row[1]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	function select_categoria()
	{
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT m.* 
					FROM categoria m 
					WHERE m.id_cli='1'
					AND m.estado=1";

		$retorno ="<select name='id_cat' id='id_cat' class=\"form-control\">
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[0]." ".$row[1]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}

	//Motivo de DV
	function motivo_dv(){
		@session_start();
        $bd=Db::getInstance();
		$shi_codigo=$_SESSION['shi_codigo'];
		
		$sql_c = "SELECT *
					FROM rastreobam.motivo 
					WHERE tipo_motivo=5
					AND estado_motivo=1
					ORDER BY id_motivo";

		$retorno ="<select name='id_motivo' id='id_motivo' class=\"form-control\" readonly>
					<option value=''>-</option>";

		$c= $bd->consultar($sql_c);
		
		while ($row=$c->fetch(PDO::FETCH_NUM)){
			$retorno .="<option value='".$row[0]."'>".$row[1]." ".$row[2]."</option>";
		}
		
		$retorno .="</select>";

		return $retorno;
	}


	function del_registro($r,$g)
	{
	$respuesta = new xajaxResponse();

	$tabla="detalle_cuenta";
	$campo="referencia";
	$campo2="barra";
	$registro=$r;
	$guia=$g;

	include('model/model_con.php');
	$cab=new model_con();
	$eliminar=$cab->borrar($tabla,$campo,$campo2,$registro,$guia);
		
		if($eliminar)
		{
		$resp ="<span class='textogris4'>Eliminado Satisfactoriamente ".$registro." guia : ".$g."</span>";
		}else
		{
		$resp ="<span class='textorojo_bold'>ocurri&oacute; un error en la eliminaci&oacute;n del registro ".$registro."</span>";
		}

		$respuesta->assign("div_".$r.$g,"innerHTML",$resp);
		return $respuesta;
	}

	function valida_municipio($muni)
	{
	include('model/model_con.php');
	$respuesta = new xajaxResponse();
	$con=new model_con();
	$mun=$con->consulta_municipio($muni);
		$respuesta->assign("mun_id","value","0");
		$respuesta->assign("div_municipio","innerHTML","Municipio invalido");
		$munic=0;
		while($cod_muni = $con->fetch($mun))
		{
		$munic=$cod_muni[1].", ".$cod_muni[2];
		$respuesta->assign("div_municipio","innerHTML","<span class='textogris_bold2'>".$cod_muni[0]." ".$munic."</span>");
		$respuesta->assign("mun_id","value",$cod_muni[0]);
		}
		//if($munic==0)
		//{
		//$respuesta->assign("div_municipio","innerHTML","<span class='textorojo_bold'>".$cod_muni[0]." ".$munic."</span>");
		//}
		
		
	return $respuesta;
	}
		
	function guarda_formato($tipo)
	{
	include('model/model_con.php');
	$respuesta = new xajaxResponse();
	$con=new model_con();

	$try=$con->guarda_formato($tipo);
		
	if($try)
	{
	$respuesta->assign("info_formato","innerHTML","<span class='textoblanco'>Satisfactoriamente Actualizado a $tipo </span>");
	}else
	{
	$respuesta->assign("info_formato","innerHTML","<span class='textorojo_bold'>Test Ha ocurrido un error intenta luego</span>");
	}
	$respuesta->assign("guardar_formato","value","Definir Formato");
	$respuesta->assign("guardar_formato","disabled",false);

	return $respuesta;
	}

function hora_ini()
{
$retorno = "<select name=\"hora_ini\"  id='hora_ini' class='fecha'>";
					$hora=date("H");
					$limitehora=23;
					for ($i=0;$i<=$limitehora;$i++){
						$retorno .= "<option value=\"$i\"";
						if ($i==$hora){
							$retorno .= "selected>";
						}else{
							$retorno .= ">";
						}
						$retorno .= "$i</option>\n";
					}
				$retorno .= "</select>:";

$retorno .= "<select name=\"minuto_ini\"  id='minuto_ini' class='fecha'>";
					$minutos=date("i");
					$limiteminutos=59;
					for ($i=0;$i<=$limiteminutos;$i++){
						$retorno .= "<option value=\"$i\"";
						if ($i==$minutos){
							$retorno .= "selected>";
						}else{
							$retorno .= ">";
						}
						$retorno .= "$i</option>\n";
					}
				$retorno .= "</select>";
return $retorno;

}

function hora_fin()
{
$retorno = "<select name=\"hora_fin\"  tabindex=\"1\" class='fecha'>";
					$hora=date("H");
					$limitehora=23;
					for ($i=0;$i<=$limitehora;$i++){
						$retorno .= "<option value=\"$i\"";
						if ($i==$hora){
							$retorno .= "selected>";
						}else{
							$retorno .= ">";
						}
						$retorno .= "$i</option>\n";
					}
				$retorno .= "</select>:";

$retorno .= "<select name=\"minuto_fin\"  tabindex=\"2\" class='fecha'>";
					$minutos=date("i");
					$limiteminutos=59;
					for ($i=0;$i<=$limiteminutos;$i++){
						$retorno .= "<option value=\"$i\"";
						if ($i==$minutos){
							$retorno .= "selected>";
						}else{
							$retorno .= ">";
						}
						$retorno .= "$i</option>\n";
					}
				$retorno .= "</select>";
return $retorno;

}

function list_agente_tigo()
{
	$con=new model_con();

	$retorno ="<select name='sucursal' id='sucursal' class='boton_submit'onchange=\"xajax_mov_chk(xajax.getFormValues('formulario'))\">";
	
	$convende=$con->con_agente_tigo();
	
	while ($ve=$con->fetch($convende))
	{
		$retorno .="<option value='$ve[0]'>$ve[0] $ve[1]</option>";
	}
	$retorno .="</select>";

	return $retorno;
}

function coincidencias($form)
{
	//ini_set ("display_errors","1" );
	//error_reporting(E_ALL);
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	$shi_codigo	=$_SESSION['shi_codigo'];

	$sucursal	=$form['sucursal'];
	$tipo_fecha	=$form['tipo_fecha'];
	$id_acuse	=$form['id_acuse'];
	
	$fecha_inicio 	= str_pad($form['fec_ini_dia'], 2, "0", STR_PAD_LEFT)."-".str_pad($form['fec_ini_mes'], 2, "0",STR_PAD_LEFT)."-".$form['fec_ini_ano'];
	$hora_ini	= str_pad($form['hora_ini'], 2, "0", STR_PAD_LEFT).":".str_pad($form['minuto_ini'], 2, "0",STR_PAD_LEFT).":00";
	$fecha_fin 	= str_pad($form['fec_fin_dia'], 2, "0", STR_PAD_LEFT)."-".str_pad($form['fec_fin_mes'], 2, "0",STR_PAD_LEFT)."-".$form['fec_fin_ano'];
	$hora_fin	= str_pad($form['hora_fin'], 2, "0", STR_PAD_LEFT).":".str_pad($form['minuto_fin'], 2, "0",STR_PAD_LEFT).":00";
	$txn		=$form['txn'];

	
	$tiempo_ini	=strtotime($fecha_inicio." ".$hora_ini);
	$tiempo_fin	=strtotime($fecha_fin." ".$hora_fin);
	
	$con=new model_con();
	
	$condata=$con->con_data_acuse($sucursal,$tipo_fecha,$tiempo_ini,$tiempo_fin,$txn,$id_acuse);
	
	$retorno ="";
	$retorno ="<select multiple=\"multiple\" name=\"corte\" id=\"corte\" size='12' onclick =\"xajax_mov_data(this.value)\" class='input'>";
	
	while($row = $con->fetch($condata))
	{
		$id_sucursal     =$row[2]; 
		$id_acuse        =$row[4]; 
		$txn2             =$row[10];

		$retorno .="<option value=\"$id_acuse\"> $id_acuse - $id_sucursal - $txn2</option>";	
	}
	
	
	$retorno .= "</select>";
			
	$respuesta->assign("detalle_envio","innerHTML",$retorno);
	$respuesta->assign("div_dat","innerHTML"," Inicio :".date('d-m-Y',$tiempo_ini)." Fin :".date('d-m-Y',$tiempo_fin)." ID Acuse :".$id_acuse."". $sucursal."". $tipo_fecha);
	//$respuesta->script("jQuery('#div_shipper').fadeTo('slow',0.7)");
	//$respuesta->assign('detalle_envio','innerHTML',$datos_cliente);
	//$respuesta->assign('comercial','innerHTML',"<img src='vista/imgs/Logistic2.png'>");
	//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.5)");
	//$respuesta->script("jQuery('#comercial').animate({ marginLeft:'450px'},1500)");
	
	//$respuesta->assign("img","innerHTML",$imagen_dl);
	
	return $respuesta;


}

function mov_data($id_acuse)
{
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	
	$con 		= new model_con();
	
	$condataid=$con->con_data_acuse_x_id($id_acuse);
	while($row = $con->fetch($condataid))
	{
		$gui_llave 	=$row[1];
		$id_sucursal	=$row[2];
	}
		
	$PREFIX		="../../jpgs5/".$id_sucursal."-".$gui_llave;
	$aux		="";
	$server		=$PREFIX . "/" . trim($id_acuse) . ".jpg";
		
	if(@fopen($server, "r"))
	{
		$aux=$PREFIX . "/" . trim($id_acuse) . ".jpg";
	}
		
	if(@fopen($aux,"r"))
	{
		
		$img ="OK";
		
		$img ="	<table border='0' align='center'>
				<tr>
				<td colspan='10'>
				<img src='$aux' width='650' height='800' onclick='window.open
				('$aux','Imagen','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no, width=600,height=800,left=430,top=23');'>
				</td>
				</tr>
				</table>";	
		
	}
	else
	{
		$img =$id_acuse;
	}
	
	$respuesta->assign("img","innerHTML",utf8_decode($img));
	
	return $respuesta;
}

function rep_problema($form)
{
	//ini_set ("display_errors","1" );
	//error_reporting(E_ALL);
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	$id_sucursal	= $form['sucursal'];
	
	$con = new model_con();
	
	$condatagui=$con->con_gui_x_suc($id_sucursal);
	while($row = $con->fetch($condatagui))
	{
		$guia	=$row[0];
		$cant	=$row[1];
	}
	
	$PREFIX		="../../jpgs5/".$id_sucursal."-".$guia."/";
	$ruta 		= $PREFIX; // Indicar ruta
	
	$filehandle = opendir($ruta); // Abrir archivos
	while ($file = readdir($filehandle)) 
	{
		$trozos= explode("_",$file);
		$p1=$trozos[0];
		$p2=$trozos[1];
		
		if($p1=='problema')
		{
			if ($file != "." && $file != "..") 
			{
				$tamanyo = GetImageSize($ruta . $file);
				
				$img .="<center>
						<INPUT type='button' value='$file' onClick=\"window.open('$ruta$file','$ruta$file','width=650,height=800')\" class='boton_submit'>
						</center>
						<br>";
			}	
		}
		 
	} 
	
	closedir($filehandle); // Fin lectura archivos
	
	$respuesta->assign("div_mov","style.overflow","scroll");
	$respuesta->assign("div_mov","style.height","550");						
	$respuesta->assign("div_mov","innerHTML",utf8_decode($img));
	
	return $respuesta;
	
}

function mov_chk($form)
{
	//ini_set ("display_errors","1" );
	//error_reporting(E_ALL);
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	$id_sucursal	= $form['sucursal'];
	
	$con = new model_con();
	
	$consuc=$con->con_detalle_cuenta($id_sucursal);
	while($row = $con->fetch($consuc))
	{
		$barra	=$row[0];
	}
	
	$conesta=$con->con_estado_chk($barra);
	while($row1 = $con->fetch($conesta))
	{
		$guidetalle_estado =$row1[21];
	}
	
	if($guidetalle_estado=='DL')
	{
		$img="<center><table cellspacing='1' bgcolor='#CCCCCC' cellpadding='4'>

				<tr bgcolor='#FFFFFF'>
				<td ><img src='vista/imgs/dl.png' ></td>
				<td class='textogris_bold'>DL - RECOLECTADO EN SUCURSAL</td>
				</tr>
			</table>";
				
	}
	elseif($guidetalle_estado=='DV')
	{
		$img="<center><table cellspacing='1' bgcolor='#CCCCCC' cellpadding='4'>

				<tr bgcolor='#FFFFFF'>
				<td ><img src='vista/imgs/dv2.png' width='97' height='99' ></td>
				<td class='textogris_bold'>DV - DEVOLUCION EN SUCURSAL</td>
				</tr>
				</table>";
	}
	else
	{
		$img="<center><table cellspacing='1' bgcolor='#CCCCCC' cellpadding='4'>

				<tr bgcolor='#FFFFFF'>
				<td ><img src='vista/imgs/delete.png' width='97' height='99' ></td>
				<td class='textogris_bold'>ESTADO PENDIENTE</td>
				</tr>
				</table>";
	}
						
	$respuesta->assign("div_mov","innerHTML",utf8_decode($img));
	
	return $respuesta;
	
}

function rep_pdt_digi($form)
{
	//ini_set ("display_errors","1" );
	//error_reporting(E_ALL);
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	$id_sucursal	= $form['sucursal'];
	
	$con = new model_con();

	$condatagui=$con->con_detalle_cuenta_max($id_sucursal);
	while($row = $con->fetch($condatagui))
	{
		$guia	=$row[0];
		//$cant	=$row[1];
	}

	$PREFIX		="../../jpgs5/".$id_sucursal."-".$guia."/";
	$ruta 		= $PREFIX; // Indicar ruta

	$filehandle = opendir($ruta); // Abrir archivos
	if(!opendir($ruta))
	{
		$img="<center><table cellspacing='1' bgcolor='#CCCCCC' cellpadding='4'>

				<tr bgcolor='#FFFFFF'>
				<td ><img src='vista/imgs/delete.png' width='97' height='99' ></td>
				<td class='textogris_bold'>NO HAY ACUSES RELACIONADOS A ESTA SUCURSAL</td>
				</tr>
				</table>";
	}
	else
	{
		while ($file = readdir($filehandle)) 
		{
			$trozos		=substr($file,1,1);
		
			if ($file != "." && $file != "..") 
			{
					$tamanyo = GetImageSize($ruta . $file);
					
					$img .="<center>
							<INPUT type='button' value='$file' onClick=\"window.open('$ruta$file','$ruta$file','width=650,height=800')\" class='boton_submit'>
							</center>
							<br>";
			}
	
			
		} 
	}
	closedir($filehandle); // Fin lectura archivos
	
	$respuesta->assign("div_mov","style.overflow","scroll");
	$respuesta->assign("div_mov","style.height","550");						
	$respuesta->assign("div_mov","innerHTML",utf8_decode($img));
	
	return $respuesta;


}

function coincidencia_x_muni($form)
{
	//ini_set ("display_errors","1" );
	//error_reporting(E_ALL);
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	$municipio	= $form['municipio'];
	$tel_agente	= $form['tel_agente'];
			
	$con=new model_con();
	
	$condata=$con->con_data_x_muni($municipio,$tel_agente);
	
	
	$retorno ="";
	$retorno ="<select multiple=\"multiple\" name=\"corte\" id=\"corte\" size='12' onclick =\"xajax_mov_data_x_muni(this.value)\" class='input'>";
	
	while($row = $con->fetch($condata))
	{
		$cod_agente	=$row[0];
		$msisdn		=$row[1];
		$municipio	=$row[2];
		$depto 		=$row[3];
		$retorno .="<option value=\"$cod_agente\">Agente: $cod_agente - Telefono: $msisdn - $depto - $municipio</option>";	
	}
	
	
	$retorno .= "</select>";
			
	$respuesta->assign("detalle_envio","innerHTML",$retorno);
	$respuesta->assign("div_dat","innerHTML","Municipio : ".$municipio." Departamento : ".$depto);
	//$respuesta->script("jQuery('#div_shipper').fadeTo('slow',0.7)");
	//$respuesta->assign('detalle_envio','innerHTML',$datos_cliente);
	//$respuesta->assign('comercial','innerHTML',"<img src='vista/imgs/Logistic2.png'>");
	//$respuesta->script("jQuery('#detalle_envio').fadeTo('slow',0.5)");
	//$respuesta->script("jQuery('#comercial').animate({ marginLeft:'450px'},1500)");
	
	//$respuesta->assign("img","innerHTML",$imagen_dl);
	
	return $respuesta;
}

function list_depto()
{
	$con=new model_con();

	$retorno ="<select name='departamento' id='departamento' class='boton_submit'onchange=\"xajax_list_muni_x_depto(xajax.getFormValues('formulario'))\">";
	
	$convende=$con->list_dpto();
	$retorno .="<option value='%'>Seleccione el departamento</option>";
	while ($ve=$con->fetch($convende))
	{
		$retorno .="<option value='$ve[0]'>$ve[0]</option>";
	}
	$retorno .="</select>";

	return $retorno;
}

function list_muni_x_depto($form)
{
	//ini_set ("display_errors","1" );
	//error_reporting(E_ALL);
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	$departamento	=$form['departamento'];
	
	$con=new model_con();
	
	$condata=$con->list_muni_x_dpto($departamento);
	
	$retorno ="";
	$retorno ="<select name='municipio' id='municipio' class='boton_submit'>";
	
	
	while($row = $con->fetch($condata))
	{
		$municipio	 =$row[0]; 
		
		$retorno .="<option value=\"$municipio\">$municipio</option>";	
	}
	
	$retorno .= "</select>";
			
	$respuesta->assign("select_muni","innerHTML",$retorno);
	
	return $respuesta;
}

function mov_data_x_muni($sucursal)
{
	include('model/model_con.php');	
	
	$respuesta 	= new xajaxResponse();
	
	$con 		= new model_con();
	
	$condatagui=$con->con_gui_x_suc($sucursal);
	while($row = $con->fetch($condatagui))
	{
		$guia	=$row[0];
		$cant	=$row[1];
	}
	
	if($cant==0)
	{
		$img="<center><table cellspacing='1' bgcolor='#CCCCCC' cellpadding='4'>

				<tr bgcolor='#FFFFFF'>
				<td ><img src='vista/imgs/delete.png' width='97' height='99' ></td>
				<td class='textogris_bold'>ACUSES PENDIENTES DE DIGITAR O INGRESAR A SISTEMA</td>
				</tr>
				</table>";	
	}
	
	$PREFIX		="../../jpgs5/".$sucursal."-".$guia."/";
	$ruta 		= $PREFIX; // Indicar ruta
	
	$filehandle = opendir($ruta); // Abrir archivos
	while ($file = readdir($filehandle)) 
	{
		$trozos= explode("_",$file);
		$p1=$trozos[0];
		$p2=$trozos[1];
		
		if($p1!='problema' && $file !='Thumbs.db')
		{
			if ($file != "." && $file != "..") 
			{
				$tamanyo = GetImageSize($ruta . $file);
				
				$img .="<center>
						<INPUT type='button' value='$file' onClick=\"window.open('$ruta$file','$ruta$file','width=650,height=800')\" class='boton_submit'>
						</center>
						<br>";
			}	
		}
		 
	} 
	
	closedir($filehandle); // Fin lectura archivos
	
	$respuesta->assign("div_mov","style.overflow","scroll");
	$respuesta->assign("div_mov","style.height","550");						
	$respuesta->assign("div_mov","innerHTML",utf8_decode($img));
	
	return $respuesta;
}


?>