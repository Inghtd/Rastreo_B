<?php
     include('../../../class/db.php');
     $dbp=Db::getInstance();
  
     

     $sql="select 
     SUM(IF(mb1.chk_id='1',1,0)) AS Ingreso,
     SUM(IF(mb1.chk_id='2',1,0)) AS Arribo,
     SUM(IF(mb1.chk_id='3',1,0)) AS Despacho,
     SUM(IF(mb1.chk_id='4',1,0)) AS Reingreso,
     SUM(IF(mb1.chk_id='5',1,0)) AS Salida_agencia,
     SUM(IF(mb1.color='7',1,0)) AS negra
from (
 select distinct
 mb.barra, mb.estado, mb.chk_id,bl.color
 from orden o
                inner join control_bolsa cb on cb.numero_orden=o.id_orden
                left join movimiento_bolsa mb on mb.barra=cb.barra
                inner join bolsa bl on bl.codigo_unico=cb.codigo_unico
                left join agencia ag on ag.id_agencia=bl.origen
 where o.entero1='1'and o.estado='1' 
 and cb.codigo_unico!=''
                
) mb1;
            ";
            ///print $sql;
            //and o.fecha_date='".$date."'
            $data_o = $dbp->consultar($sql);

            $bolsas=0;
            $guias=0;
            $data=array();

            foreach($data_o as $row_o){
                $data=array(
                    "Ingreso"=>$row_o['Ingreso'],
                    "Arribo"=>$row_o['Arribo'],
                    "Despacho"=>$row_o['Despacho'],
                    "Reingreso"=>$row_o['Reingreso'],
                    "Salida_agencia"=>$row_o['Salida_agencia']
                );
            }

     echo json_encode($data);

?>