<?php
class control_guia{
    public function guias(){

        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/control_g.php');
            include('vista/pie_report.php');
            //include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

    public function g_asignacion_m(){
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/asignacion_m.php');
            include('vista/pie_report.php');
            //include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }
}
?>