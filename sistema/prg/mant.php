<?php
session_start();
class mant{
    public function agencias(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_mant_agencias.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function ccostos(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_mant_ccostos.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function usuarios(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_mant_usuarios.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function zonas(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_mant_zonas.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }

    public function mensajero(){
        if(!empty($_SESSION['cod_usuario'])){
            //require('../class/cab.php');
            include('vista/inicio.php');
            include('vista/form_mant_mensajero.php');
            ?>
            <?php
            include('vista/inicio_pie.php');
        }
        else{
            echo "Debes iniciar session";
        }
    }
}
?>
