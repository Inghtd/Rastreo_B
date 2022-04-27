<?php

    include('../../../class/db.php');
    $dbp=Db::getInstance();

    $color=trim($_GET["q"]);

    session_start();
    $agencia_ccosto=$_SESSION['ccosto_nombre'];

    $sql="select distinct bl.codigo_unico,ag.id_agencia,ag.agencia_nombre, case
    when bl.color=1 then 'Gris'
    when bl.color=2 then 'Roja'
    when bl.color=3 then 'Azul'
    when bl.color=4 then 'Amarilla'
    when bl.color=5 then 'verde de lona'
    when bl.color=6 then 'cafe'
    when bl.color=7 then 'negra'
    when bl.color=8 then 'Morada'
    when bl.color=9 then 'Naranja'
    when bl.color=10 then 'Negro con Rojo'
    end as color_b, case
    when bl.categoria=1 then 'General'
    when bl.categoria=2 then 'Departamento'
    end as tipo_b, cbl.estado from bolsa bl
    inner join agencia ag on ag.id_agencia=bl.origen
    left join control_bolsa cbl on cbl.estado not in (1,2,3,4)
    where ag.agencia_nombre = '".$agencia_ccosto."'
    and bl.color='".$color."'";

    $data=array();

    $stmt=$dbp->consultar($sql);

    while ($row=$stmt->fetch(PDO::FETCH_NUM)){
        $codigo_unico           =trim($row[0]);
        $id_agencia             =trim($row[1]); 
        $agencia_nombre         =trim($row[2]); 
        $color_b                =trim($row[3]);
        $tipo_b                 =trim($row[4]);
        $estado                 =trim($row[5]);

        $data[]=array(
            "nombre"=>$codigo_unico." - ".$agencia_nombre." - ".$color_b,
            "id"    =>$codigo_unico
      );  
    }

    echo json_encode($data);
?>