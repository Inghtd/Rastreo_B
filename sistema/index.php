<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//echo "1";
//Incluimos el FrontController
header('Strict-Transport-Security: max-age=0;');

require '../class/controlador.php';
session_start();
//Lo iniciamos con su método estático main.
if(!empty($_SESSION['cod_usuario'])){
FrontController::main();
}else{
    $info="estatus";
    ?>
    <script>
        window.location.replace("https://rastreobam.envia.com.gt?m='<?php echo $info;?>'");
    </script>
    <?php
}

?>
