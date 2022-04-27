<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$usr_nombre=$_GET["q"];

$sql="SELECT * FROM usuario WHERE usr_nombre LIKE '%$usr_nombre%' AND nivel!=4";

$data=array();


$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
    $id_usr     =trim($row[0]); 
    $usr_cod    =trim($row[1]); 
    $usr_pass   =trim($row[2]); 
    $usr_nombre =trim($row[3]); 
    $cli_codigo =trim($row[4]); 
    $id_grupo   =trim($row[5]); 
    $nivel      =trim($row[6]); 
    $depto      =trim($row[7]); 
    $id_ccosto  =trim($row[8]); 
    $area       =trim($row[9]); 
    $producto   =trim($row[10]); 
    $posicion   =trim($row[11]);

    $data[]=array(

        'nombre'=>$usr_cod." - ".$usr_nombre,
        'id'    =>$usr_nombre
    );
    
}

echo json_encode($data);


?>