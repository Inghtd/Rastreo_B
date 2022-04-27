<?php
session_start();
class guia
{
    public function ingreso()
    {
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_ingreso_guia.php');
            ?>

            <?php
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }
    }

    public function ar(){
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/ar.php');
            ?>

            <?php
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }
    }

    public function edt(){
if(!empty($_SESSION['cod_usuario']))
        {
            include('vista/inicio.php');
            include('vista/edicion_ordenes.php');
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }
    }

}
?>