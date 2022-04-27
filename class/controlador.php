<?php
class FrontController
{
	static function main()
	{
		//Incluimos algunas clases:
 
		//require 'db2.php'; //de configuracion
		require 'cab.php'; //Habilitando funciones xajax
		//Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
		if(! empty($_GET['prc']))
		      $controllerName = $_GET['prc'];
		else
		      $controllerName = "inicio";
 
		//Lo mismo sucede con las acciones, si no hay accion, tomamos index como accion
		if(! empty($_GET['accion']))
		      $actionName = $_GET['accion'];
		else
		      $actionName = "index";
 
		$controllerPath = "prg/".$controllerName . '.php';
 
		//Incluimos el fichero que contiene nuestra clase controladora solicitada
		if(is_file($controllerPath))
		      require $controllerPath;
		else
		      die('El controlador no existe - 404  '.$controllerPath);
 
		//Si no existe la clase que buscamos y su acción, tiramos un error 404
		if (is_callable(array($controllerName, $actionName)) == false)
		{
			trigger_error ($controllerName . '->' . $actionName . '` no existe', E_USER_NOTICE);
			return false;
		}
		//Si todo esta bien, creamos una instancia del controlador y llamamos a la accion
		$controller = new $controllerName();
		$controller->$actionName();
	}
}
?>