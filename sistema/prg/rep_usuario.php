<?php
session_start();
class rep_usuario{

    public function usuarios(){

        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/reporte_de_usuarios.php');
            include('vista/pie_report.php');
            //include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

    public function editar(){

        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/usr_mantenimieto.php');
            //include('vista/pie_report.php');
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

    public function cambiar(){

        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');

            include('vista/cambio_pass.php');

            //include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }



}