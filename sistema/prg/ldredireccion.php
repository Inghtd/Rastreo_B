<?php
class dlredic{

    public function index(){
        session_start();
        if(!empty($_SESSION['cod_usuario']))
        {
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_proc_ld.php');
            include('vista/inicio_pie.php');
        }
        else
        {
            echo "Debes iniciar session";
        }

    }

}
