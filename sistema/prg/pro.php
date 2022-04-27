<?php
session_start();

class pro{
	public function con_pro_tigo_money()
	{
			
		include('vista/cabecera.php');
		include('vista/menu.php');
		include('model/model_con.php');
		if(!empty($_SESSION['cod_usuario']))
		{
	?>
	<style type="text/css">
		@import url("css/paginacion.css");
	</style>
	<tr>
	<td align='left' valign='top'  bgcolor='#F1F1F1' >
			<p align='left' class='textogris1'>Formulario de Consulta de Problemas<br />
		<span class='textogris_bold'> Click en Consultar para ver los problemas por sucursal</span></p></td>
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
		<td colspan="2" align="center"><input type="button" value='Consultar' class='boton_submit' id='consultar' onClick="xajax_rep_problema(xajax.getFormValues('formulario'))" height="16" /></a></td>
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
				<td bgcolor='#F1F1F1'>
				<span class='textogris4'>
				<tr>
					<td colspan='2' bgcolor='F1F1F1'>
						
						<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
							<tr>
								<td height='512' bgcolor='#ffffff'>
									
									<div id='div_mov'>
										<center><img src='vista/imgs/smile.png' ></center>
									</div>
										
										
										<!--<div id="map" style="width: 470px; height: 370px"></div>-->
								</td>
								
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



	public function con_pdt_tigo_money()
	{
			
		include('vista/cabecera.php');
		include('vista/menu.php');
		include('model/model_con.php');
		if(!empty($_SESSION['cod_usuario']))
		{
	?>
	<style type="text/css">
		@import url("css/paginacion.css");
	</style>
	<tr>
	<td align='left' valign='top'  bgcolor='#F1F1F1' >
			<p align='left' class='textogris1'>Formulario de Consulta de Problemas<br />
		<span class='textogris_bold'> Click en Consultar para ver los problemas por sucursal</span></p></td>
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
		<td colspan="2" align="center"><input type="button" value='Consultar' class='boton_submit' id='consultar' onClick="xajax_rep_pdt_digi(xajax.getFormValues('formulario'))" height="16" /></a></td>
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
				<td bgcolor='#F1F1F1'>
				<span class='textogris4'>
				<tr>
					<td colspan='2' bgcolor='F1F1F1'>
						
						<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
							<tr>
								<td height='512' bgcolor='#ffffff'>
									
									<div id='div_mov'>
										<center><img src='vista/imgs/smile.png' ></center>
									</div>
										
										
										<!--<div id="map" style="width: 470px; height: 370px"></div>-->
								</td>
								
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