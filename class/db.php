<?php
/**
 * Clase encargada de la conexion a la BDD
 *
 * autor     Marvin Abrego
 * archivo   Clase_conexion
 *
 *
 **/

ini_set ("display_errors","0" );

//error_reporting(E_ALL);

//date_default_timezone_set('America/El_Salvador');
class Db{
	//Declarando los parametros de conexion todo privado para mayor control....
	private $servidor='13.90.202.204';

    private $usuario='root';
    private $password='taaYzY9j6dmN';

	private $base_datos='rastreobam';
	private $link;
	private $stmt; 
	
	static $_instance;
 
	//La función construct es privada para evitar que el objeto pueda ser creado mediante new
	public function __construct(){
		$this->conectar();
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
	/*Aca inicia la magia este metodo es que permite la conexion a la BDD y
	es el que llama el constructor de la clase*/
   	private function conectar(){

        $dsn = 'mysql:host='.$this->servidor.';port=3306;dbname='.$this->base_datos;
        $opciones = array(
			
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'

        );
//PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
        //$gbd = new PDO($dsn, $this->usuario, $this->password, $opciones);
   	 	$this->link= new PDO($dsn, $this->usuario, $this->password);
		//echo $dsn;
   	}
	
	/*
	======================================================
	Aca se pueden ubicar algun query nesesario para la 
	autenficacion, o hacer algun CRUD
	======================================================
	*/
	
	//Unas pruebas.
	/*Método para ejecutar un select sencillo*/
	public function consultar($sql){
		//echo $sql;
        $stmt=$this->link->prepare($sql);

        $stmt->execute();
		
		return $stmt;

        //$stmt=$gbd->prepare($sql);
        //$stmt->execute();
	}

    public function preparar($sql){
        $stmt=$this->link->prepare($sql);
        return $stmt;
    }
	//Método para obtener una fila de resultados de la sentencia sql
	public function obtener_fila($stmt){
            return $stmt->fetch(PDO::FETCH_NUM);
	}

	/*Método para ejecutar un insert sencillo*/
	public function insertar($sql){
		$this->stmt=consultar($sql);
		$row=obtener_fila($this->stmt);
		return $row;
	}
	
	/*Método para ejecutar un update sencillo*/
	public function actualizar($sql){
        $this->stmt=consultar($sql);
        $this->obtener_fila($this->stmt);
        return $this->stmt;
	}
	
	/*Método para ejecutar un delete sencillo*/
	public function borrar($sql){
        $this->stmt=consultar($sql);
        $this->obtener_fila($this->stmt);
        return $this->stmt;
	}

	//Recupera los rows
	public function fetch($stmt){
        //$this->stmt=consultar($sql);
        $data=$this->obtener_fila($this->stmt);
		return $data;
	}

}
?>