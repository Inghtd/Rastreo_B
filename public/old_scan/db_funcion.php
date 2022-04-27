<?php

include('../../class/db.php');
date_default_timezone_set('America/Guatemala');

class function_model extends Db
{
    public function __construct()
    {
        $db = Db::getInstance();
    }

    public function obtener_guia($barra){

        $db=Db::getInstance();
        $sql2="select id_guia,id_envio from guia
        where barra='".$barra."'";
        $gui=$db->consultar($sql2);

        return $gui;
    }

    
    public function escaneo($codigos,$id_usr){
        $db=Db::getInstance();
        foreach($codigos as $barra){
            $vineta         =   $barra->barra;
            $des     =   $barra->comentario;
            $fecha_datetime =   date("Y-m-d H:i:s");
            $fecha_date     =   date("Y-m-d");
            $chk            =   2;
            $marca          =   time();

            $sql_guia="select id_envio guia where barra=".$vineta;
            $c= $db->consultar($sql_guia);
            foreach($c as $rw1){
                $id_guia=$rw1->id_envio;
            }


            /*insertamos el movimeinto de recepcion en agencia*/
            $sql="INSERT INTO movimiento_
            (id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
            VALUES (0,$id_guia,$chk,1,'$id_usr','$id_usr','$fecha_date','$fecha_datetime','$marca','1','$des',NULL) ";


        }

    }

    public function proceso_actual(){
        $db=Db::getInstance();
        $sql="select * from correlativo where id_correlativo=2";
        $data=$db->consultar($sql);
        return $data;
    }

    public function scaneo($cod_unico,$proceso){

        $db=Db::getInstance();
        $estado         =0;
        $estado_pre     =0;
        $fecha_datetime	=date('Y/m/d H:i:s');
        $marca     	 	=time();
        $d_estado       ='';
        $mj='';
        switch ($proceso){
            case "1":
                //ingreso a central
                $estado_pre=1;
                $estado=2;
                $d_estado="Recepción";
                break;

            case "2":
                //despacho a departamentos.
                $estado_pre=2;
                $estado=3;
                $d_estado="Despacho";
                break; 

            case "3":
                //despacho a reingreso bolsas bacias.
                $estado_pre=3;
                $estado=4;
                $d_estado="Reingreso";
                break; 

            case "4":
                //despacho a .
                $estado_pre=4;
                $estado=5;
                $d_estado="Salida Age.";
                break; 
        }

        /*$sql_b="select id_controlb,barra from control_bolsa 
        where codigo_unico='".$cod_unico."' and estado='".$estado."'";*/

        $sql_b="select cb.id_controlb,cb.barra,mb.fecha_hora from control_bolsa cb
        left join movimiento_bolsa mb on mb.barra=cb.barra
            left join orden o on o.id_orden = cb.numero_orden and o.entero1='1'
                where cb.codigo_unico='".$cod_unico."' and cb.estado='".$estado_pre."'";

                //

        $info = $db->consultar($sql_b);

        $control=0;
        //print_r($info);
        foreach($info as $rwf){

            
            //print_r($rwf);
            $id_controlb=$rwf['id_controlb'];
            $barra=$rwf['barra'];
            
            $min_sql="update control_bolsa set estado='".$estado."' 
            where id_controlb='".$id_controlb."'";
            $smtp=$db->preparar($min_sql);

            //si logramos hacer la actualizacion porque  (***********************)
            if($smtp->execute()){

                $sql_mb="insert into movimiento_bolsa values('0','".$barra."','".$fecha_datetime."','".$marca."','".$d_estado."', '".$estado."', 'Bolsa','','0')";
                $smtb=$db->preparar($sql_mb);

                if($smtb->execute()){
                    $control++;
                    $mj="Proceso de escaneo de bolsa ejecutado a la perfeccion.";
                }
            }else{
                $control++;
                $mj="El codigo de Barra no esta registrado en el sistema";
            }

            $control++;
            $mj="Proceso de escaneo de bolsa ejecutado a la perfeccion.";
        }

        if($control==0){
            $mj="el estado es diferente de ".$proceso;
        }else{

            $mj=$mj;
        }
   
        
        return $mj;
    }

    public function comet(){
        
    }    
}

?>