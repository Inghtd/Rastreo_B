<?php
class informe1{

    public function index(){
        session_start();
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/informe1.php');
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

}
