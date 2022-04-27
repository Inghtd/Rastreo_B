<?php
/**
 * Clase encargada de la conexion
 * autor     Marvin Abrego
 * archivo   BDD
 * fecha     20121213
 *
 **/
date_default_timezone_set('America/El_Salvador');

class dbh
{
	//Declarando los parametros de conexion todo privado para mayor control....
	public $dbp;
	private $stmt;
	private $prep;
	//private $servidor='localhost';
	//private $usuario='root2';
	private $servidor='13.90.202.204';
    private $usuario='root2@rastreobam';
	private $password='taaYzY9j6dmN';
	private $base_datos='rastreobam';
	private $link;
	
	static $_instance;
 
	//La función construct es privada para evitar que el objeto pueda ser creado mediante new
	public function __construct(){
	$dbu=$this->conectar();
	}
	
	//No clonacion ... 
	private function __clone(){ }
	 
	/*Función encargada de crear, si es necesario, el objeto. 
	Esta es la función que debemos llamar desde fuera de la clase para instanciar el objeto, 
 	y así, poder utilizar sus métodos*/
	public static function getInstance(){
		if (!(self::$_instance instanceof self)){
		self::$_instance=new self();
		}
		return self::$_instance;
	}

	public function realip()
	{
	if ($_SERVER) {
	if ( $_SERVER["HTTP_X_FORWARDED_FOR"] ) {
	$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	} elseif ( $_SERVER["HTTP_CLIENT_IP"] ) {
	$realip = $_SERVER["HTTP_CLIENT_IP"];
	} else {
	$realip = $_SERVER["REMOTE_ADDR"];
	}
	} else {
	if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
	$realip = getenv( 'HTTP_X_FORWARDED_FOR' );
	} elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
	$realip = getenv( 'HTTP_CLIENT_IP' );
	} else {
	$realip = getenv( 'REMOTE_ADDR' );
	}
	}
	
	return $realip;
	}

	public function borrar($tabla,$campo,$campo2,$registro,$registro2)
	{
	$dbp=dbp::getInstance();
	$delete="delete from $tabla
		where $campo='$registro'
		and $campo2='$registro2'
		";
	$consulta= $dbp->consultar($delete);
	return $consulta;
	}


	public function prov_nombre($prov)
	{
	$dbp=dbp::getInstance();


	$consulta3="
	select * from provincia
	where prov_codigo='".$prov."'
	";
	$stm3=$dbp->consultar($consulta3);
	while ($row3 =$dbp->fetch($stm3))
	{
	$prov_codigo =$row3[0];
	$region      =$row3[1];
	}


	$consulta_ori="
	select * from ruta_destino
	where cod_municipio='$prov'
	";
	$stmt_ori=$dbp->consultar($consulta_ori);
	while ($row_ori =$dbp->fetch($stmt_ori))
	{
	$cod_municipio_ori  =$row_ori[0];
	$region      =$row_ori[1];
	$departamento_ori   =", ".$row_ori[2];
	$provincia_ori      =$row_ori[5];
	$zon_codigo_ori     =$row_ori[6];
	$motorista_ori      =$row_ori[7];
	}

	return $region.$departamento_ori;
	}

	public function municipio_t()
	{
	$dbp=dbp::getInstance();
		$query =
		"
		select * from ruta_destino order by 1
		";
	$retorno .= "<select name='municipio' id='municipio' class='boton_submit'>";
	$consulta= $dbp->consultar($query);
	while ($row =$consulta->fetch(PDO::FETCH_NUM))
	{
	$retorno .= "<option value='$row[0]'>$row[1] $row[2]</option>";
	}
	$retorno .= "</select>";
	return $retorno;
	}

	public function descripcion_municipio($mun)
	{
	$dbp=dbp::getInstance();
		$query =
		"
		select * from ruta_destino
		where cod_municipio='$mun'
		order by 1
		";
	$retorno="";
	$consulta= $dbp->consultar($query);
	while ($row =$consulta->fetch(PDO::FETCH_NUM))
	{
	$retorno .= trim($row[1])." ".trim($row[2]);
	}
	return $retorno;
	}
}
?>
