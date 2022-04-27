<?php
session_start();
class centro_costos
{

    public function centrocosto()
    {

        if (!empty($_SESSION['cod_usuario'])) {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/centrocosto.php');
            include('vista/pie_report.php');
            //include('vista/inicio_pie.php');
        } else {
            echo "Debes iniciar session";
        }

    }

    public function editarccosto(){
        if (!empty($_SESSION['cod_usuario'])) {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/cambio_ccosto.php');
            include('vista/pie_report.php');
            //include('vista/inicio_pie.php');
        } else {
            echo "Debes iniciar session";
        }
    }
}

?>