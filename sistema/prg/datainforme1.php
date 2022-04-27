<?php

header('Content-Type: application/json');

require_once('../model/model_rep.php');
$db=new model_rep();
$date1=$_GET['f1'];
$date2=$_GET['f2'];

if(empty($date1))
{
$date1=date('Y-m-d', strtotime(time()-(24*60*60*15)));
$date2=date('Y-m-d');
}

$data = $db->informe1($date1,$date2);

echo json_encode($data);
