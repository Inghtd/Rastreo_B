<?php
header('Strict-Transport-Security: max-age=0;');
//$postdata = json_decode(file_get_contents("php://input"));

include("db_extend.php");
$x1=new model_con();


   $id=	$_GET['mensajero'];

   $x2=$x1->manifiesto($id);
        $b=array();
        $cnt=0;
        foreach($x2 as $row) {
            $cnt++;
            $b[]=[
                'idPedido'=> (int)$row->idPedido,
                'idRequest'=>$row->idPedido,
                'quantity'=>0,
                'total'=>0.0,
                'name' =>$row->name, 
                'address' =>$row->address,
                'wayToPay'=>"Tarjeta",
                'createdAt'=>str_replace(" ", "T", $row->createdAt),
                'requestId'=>"1",
                'comments'=>$row->comments,
                'additionalShops'=>$row->remitente, 
                'vuelto'=>$row->nombre_remitente,
                'recipe'=>$row->dep_remitente,
                'insuranceId'=>0,
                'nit'=>"",
                'cliId'=>"",
                'char1'=>$row->direccion,
                'estado'=>0
            ];
        }
        //'estado'=>$row->estado_guia
        //echo $cnt."<br>";
        //print_r($b);
    echo json_encode($b);

?>
