<?php
session_start();
class inicio
{

public function index()
{
   

    if(isset($_GET['c'])){

        echo '<script>setTimeout(()=> location.href="index.php?prc=rep_usuario&accion=cambiar&usr='.base64_encode($_SESSION['cod_usuario']).'",1000);</script>';
                }


                if(!empty($_SESSION['cod_usuario']))
                {
                include('vista/inicio.php');
                ?>

                <?php
                include('vista/inicio_pie.php');
                }
                else
                {
                echo "Debes iniciar session";
                }
}


}

?>