<?php
class movimientos
{
	public function index(){
    	session_start();
		
		if(!empty($_SESSION['cod_usuario']))
   		{
        	//require('../class/cab.php');
        	include('vista/inicio.php');
        	include('vista/movform.php');
            include('vista/inicio_pie.php');
    	}
    	else
   	 	{
        	echo "Debes iniciar session";
    	}
	}
}
?>