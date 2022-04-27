<?php
//  ini_set ("display_errors","1" );
//  error_reporting(E_ALL);
function carga(){
	session_start();

	require('../../../Connections/con.php');

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

	if ($exten[1] =='xls'){
		//echo "<br>archivo cargado es xls<br>";
		require('../../../sistema/lib/xls/reader.php');
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

		while ($filas <= $cant_filas_xls){
			$cli_codigo		=trim($excel_reader->sheets[0]['cells'][$filas][1]);
			$nombre			=trim($excel_reader->sheets[0]['cells'][$filas][2]);
			$direccion		=trim($excel_reader->sheets[0]['cells'][$filas][3]);
			$telefono		=trim($excel_reader->sheets[0]['cells'][$filas][4]);
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

			$consulta_cliente="SELECT * FROM cliente
								WHERE shi_codigo='$shi_codigo'
								AND gui_llave='$cli_codigo'";

			$consulta_bases=$dbh->query($consulta_cliente);
			while ($dato_base=$consulta_bases->fetch(PDO::FETCH_NUM))
			{
				$dato_de_base=$dato_base[0];
			}

			if (empty($dato_de_base))
			{
				$bases_cargadas="insert into cliente
				values
				('$shi_codigo','$gui_llave','$cli_nombre','$cli_direccion1','$cli_direccion2','$cli_telefono1','$cli_telefono2','$cic_inicio','$zon_codigo','$cli_coord_x',
				'$cli_coord_y','$cli_fecha_ing','$ecli_codigo','$pro_codigo','$departamento','$municipio','$tipo_zona','$aud_estacion','$aud_usuario_proc',
				'$aud_fecha_proc','$aud_hora_proc')";
				//echo $bases_cargadas."<br>";
				$dbh->query($bases_cargadas);
			}else{
				$update_cliente="update cliente
				set (cli_nombre,cli_direccion1,cli_direccion2,cli_telefono1)=('$cli_nombre','$cli_direccion1','$cli_direccion2','$cli_telefono1')
				where shi_codigo='$shi_codigo'
				and gui_llave='$cli_codigo'
				";
				//echo $update_cliente."<br>";
				$dbh->query($update_cliente);

			}
		}
		//fin while
	}
	//fin if xls
}
?>