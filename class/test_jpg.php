<?php
ini_set ("display_errors","1" );
error_reporting(E_ALL);


$pdf_file = '\/tmp\/Guia_5000701.pdf';
$save_to = '\/tmp\/Guia_5000701.jpg'; //make sure that apache has permissions to write in this folder! (common problem)


$retorno=exec("gs -sDEVICE=jpeg -sOutputFile=".$save_to." ".$pdf_file);

echo $retorno;
?>
