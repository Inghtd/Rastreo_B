<?php

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);


include('funciones/funciones.php');

$x1=new funciones();

$numero = $x1->manifiesto_agencia();





?>