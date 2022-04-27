<?php

include('../../../class/db.php');
$dbp=Db::getInstance();


    date_default_timezone_set('America/Guatemala');
    session_start();
    $agencia_ccosto=$_SESSION['ccosto_nombre'];

    $mifecha = new DateTime(); 
    $mifecha->modify('-5 minute'); 

    $fecha5= $mifecha->format('Y-m-d H:i:s');
    $fecha1=date('Y-m-d H:i:s');
    
    $sql="select * from correlativo where id_correlativo=2";
    $stmt=$dbp->consultar($sql);

    $nombre_pro='';
    $numero_pro='';
    foreach($stmt as $row){
        $nombre_pro=$row['seq_ini'];
        $numero_pro=$row['seq_fin'];

    }
    

    $sql2="select mb.barra,mb.fecha_hora,mb.estado,mb.chk_id,cb.codigo_unico,
    mb2.barra as sc_barra,mb2.fecha_hora as sc_fecha_hora,mb2.estado as sc_estado,mb2.chk_id as sc_chk_id from movimiento_bolsa mb
    left join movimiento_bolsa mb2 on mb2.fecha_hora between '".$fecha5."' and '".$fecha1."'
    left join control_bolsa cb on cb.barra=mb.barra
    order by mb.id_movimientoB desc limit 1;";

    $stmt2=$dbp->consultar($sql2);

    $data=array();

    /**variables de escaneo de log temporal de informaicon*/

    
    $mifecha = new DateTime(); 
    $mifecha->modify('-1 minute'); 

    $fecha22= $mifecha->format('Y-m-d H:i:s');

    $codigo='';
if(isset($_POST["codigo"])){
    $codigo="and ll.rfid in ('".trim($_POST["codigo"])."')";
    $fecha22=date('Y-m-d')." 00:00:00";
}

    $sql3="select distinct ll.*,b.descripcion,b.barra, case
    when b.estado=1 then 'Ingreso'
    when b.estado=2 then 'Arribo'
    when b.estado=3 then 'Despacho'
    when b.estado=4 then 'Re-Ingreso'
    when b.estado=5 then 'Salida Agencia'
    end as estado_bolsa,
    b.fecha,ag.agencia_nombre
    from log_lectura ll
    left join control_bolsa b on b.codigo_unico = ll.rfid and b.estado!='5'
    left join bolsa bl on bl.codigo_unico=ll.rfid
    left join agencia ag on ag.id_agencia=bl.origen
    where ll.fecha_hora between '".$fecha22."' and '".$fecha1."' ".$codigo;
    $_log=array();

    $stmt3=$dbp->consultar($sql3);

    foreach($stmt3 as $rlog){
        if($rlog['barra']!=null){$barra=$rlog['barra'];}else{$barra='la bolsa no se ingreso en sistema para escaneo, notificar origen si esta posee.';}
        if($rlog['agencia_nombre']!=null){$age=$rlog['agencia_nombre'];}else{$age='bolsa no registrada en ninguna agencia debe debe de asociar la bolsa a una agencia';}
            $log[]=array(
                'id'=>$rlog['id'],
                'rfid'=>$rlog['rfid'],
                'fecha'=>$rlog['fecha_hora'],
                'proceso'=>$rlog['proceso'],
                'resultado'=>$rlog['resultado'],
                'estado'=>$rlog['estado'],
                'descripcion'=>$rlog['descripcion'],
                'barra'=>$barra,
                'estado_bolsa'=>$rlog['estado_bolsa'],
                'agencia'=>$age
            );
    }


    foreach($stmt2 as $row1){
        
        //print($row1);

        $data=array(
           "proceso"=> $nombre_pro,
           "numero_proceso"=>$numero_pro,
            "barra"=>$row1['barra'],
            "fecha_hora"=>$row1['fecha_hora'],
            "estado"=>$row1['estado'],
            "chk_id"=>$row1['chk_id'],
            "log"=> $log
      );  
    }

    echo json_encode($data);
?>