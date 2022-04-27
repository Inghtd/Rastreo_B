<?php
//ini_set ("display_errors","1" );
//error_reporting(E_ALL);
//include('../model/model_con.php');
include('../../../class/db.php');
$dbp=Db::getInstance();

$usr_nombre=trim($_GET["q"]);


$sql="select u.id_usr,u.usr_cod,u.usr_nombre, 
             cc.id_ccosto, cc.ccosto_codigo, cc.ccosto_nombre, 
             a.id_agencia, a.agencia_codigo, a.agencia_nombre, a.agencia_direccion 
        from usuario u
        inner join centro_costo cc on cc.id_ccosto=u.id_ccosto
        inner join agencia a on a.id_agencia = cc.id_agencia
        where u.usr_cod = '".$usr_nombre."' AND u.nivel!=4";

$data=array();


$stmt=$dbp->consultar($sql);
while ($row=$stmt->fetch(PDO::FETCH_NUM)){
    $id_usr                 =trim($row[0]); 
    $usr_cod                =trim($row[1]); 
    $usr_nombre             =trim($row[2]); 
    $id_ccosto              =trim($row[3]); 
    $ccosto_codigo          =trim($row[4]); 
    $ccosto_nombre          =trim($row[5]); 
    $id_agencia             =trim($row[6]); 
    $agencia_codigo         =trim($row[7]); 
    $agencia_nombre         =trim($row[8]); 
    $agencia_direccion      =trim($row[9]); 
    //$producto   =trim($row[10]); 
    //$posicion   =trim($row[11]);

    $data[]=array(

        'nombre'=>$usr_cod." - ".$usr_nombre,
        'id'    =>$usr_nombre,
        "nombrec"=>$ccosto_nombre."-".$ccosto_codigo,
        "idc"    =>$id_ccosto,
        "nombrea"=>$agencia_nombre."-".$agencia_codigo ,
        "ida"    =>$agencia_nombre,
        "direccion" => $agencia_direccion

    );
    
}

echo json_encode($data);


?>