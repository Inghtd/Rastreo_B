<?php
session_start();
class proc{

    public function os(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_proc_os.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function ar(){
        if(!empty($_SESSION['cod_usuario'])){

            //require('../class/cab.php');
            include('vista/inicio.php');

            include('vista/form_proc_ar.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }


    
    public function ld(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_proc_ld.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }



    public function dl(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_proc_dl.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function dv(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_proc_dv.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function carga_xls(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_carga_xls.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function proc_carga_xls(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/proc_carga_xls.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }


    public function proc_carga_xls_usr(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/procesar_usr/proc_carga_xls.php');
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }


    public function http_push(){
        if(!empty($_SESSION['cod_usuario'])){
         
            include('vista/conexion_viva.php');
           
        }
        else{
            echo "Debes iniciar session";
        }
    }
}
?>
