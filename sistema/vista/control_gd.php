<?php
include ('control_gs.php');

$x1 = new control_gs();

$data=$x1->get_guia();

print json_encode($data, JSON_UNESCAPED_UNICODE);

?>
