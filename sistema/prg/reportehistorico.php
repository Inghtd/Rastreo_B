<?php
class reportehistorico{

    public function index(){

        session_start();
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/reportehistorico.php');
            include('vista/pie_report.php');
            //include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

}