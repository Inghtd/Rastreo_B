<?php

include('../../../../class/db.php');
date_default_timezone_set ( 'America/Guatemala');

ini_set("date.timezone", 'America/Guatemala');
class cuadre extends Db
{
    public function __construct() 
    {
        $db=Db::getInstance();
    }

    
    public function pistola_scan($proceso,$cod_unico){

    $db=Db::getInstance();
    $estado         =0;
    $estado_pre     =0;
    $fecha_datetime	=date('Y/m/d H:i:s');
    $marca     	 	=time();
    $d_estado       ='';
    $d_estado_pre='';
    $mj=[];
        //print_r($cod_unico);
    switch ($proceso){
        case "1":
            //ingreso a central
            $d_estado_pre='Ingreso';
            $estado_pre=1;
            $estado=2;
            $d_estado="Recepción";
            break;

        case "2":
            //despacho a departamentos.
            $d_estado_pre='Recepción';
            $estado_pre=2;
            $estado=3;
            $d_estado="Despacho";
            break; 

        case "3":
            //despacho a reingreso bolsas bacias.
            $d_estado_pre='Despacho';
            $estado_pre=3;
            $estado=4;
            $d_estado="Reingreso";
            break; 

        case "4":
            //despacho a .
            $d_estado_pre='Reingreso';
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
            where cb.codigo_unico='".$cod_unico."' and cb.estado='".$estado_pre."'
            order by cb.id_controlb desc limit 1";

    

    $info = $db->consultar($sql_b);

    $control=0;
    $id_controlb='';
    $barra='';
    //print_r($info);
    foreach($info as $rwf){

        $control++;
        //print_r($rwf);
        $id_controlb=$rwf['id_controlb'];
        $barra=$rwf['barra'];

    }

    /** si el control es diferente de 0 entrara en la funcion para hacer la actualizacion del estado*/
    if($control!=0){
        
        $min_sql="update control_bolsa set estado='".$estado."' 
        where id_controlb='".$id_controlb."'";
        $smtp=$db->preparar($min_sql);

        //si logramos hacer la actualizacion de estado procedemos a realizar la incercion del movimeintos
        if($smtp->execute()){

            $sql_mb="insert into movimiento_bolsa values('0','".$barra."','".$fecha_datetime."','".$marca."','".$d_estado."', '".$estado."', 'Bolsa','','0')";
            $smtb=$db->preparar($sql_mb);

            if($smtb->execute()){
                $control++;
                
                $mj[]=array(
                    "info"=>'codigo activo',
                    "resultado"=>'Proceso de escaneo de bolsa ejecutado con éxito',
                    "estado"=>$d_estado,
                    "estado_predio"=>$d_estado_pre
                    );

                    //contavilisado
            }else{
                $control++;
                /**el registro esta en base de datos pero ocurrio un inconveninte al crear el movimiento. */
                $mj[]=array(
                    "info"=>'Movimiento error',
                    "resultado"=>'No fue posible realizar el movimiento de la bolsa ocurrió un problema.',
                    "estado"=>$d_estado,
                    "estado_predio"=>$d_estado_pre
                    );
            }


        }else{
            $control++;
            /**el registro esta en base de datos pero ocurrio un inconveninte */
            $mj[]=array(
                "info"=>'codigo error',
                "resultado"=>'El codigo de Barra posee una inconsistencia y genera problemas revisar',
                "estado"=>$d_estado,
                "estado_predio"=>$d_estado_pre
                );
        }

        /*$control++;
        $mj="Proceso de escaneo de bolsa ejecutado a la perfeccion.";*/
    }

    if($control==0){

        $sql_b2="select mb.fecha_hora,cb.estado from control_bolsa cb
        left join movimiento_bolsa mb on mb.barra=cb.barra
            left join orden o on o.id_orden = cb.numero_orden and o.entero1='1'
                where cb.codigo_unico='".$cod_unico."' and cb.estado!='5'";
        $bolsa = $db->consultar($sql_b2);

        $estado_b=0;
        
        foreach($bolsa as $rwb){
            $estado_b=$rwb['estado'];
            $fecha_estado=$rwb['fecha_hora'];
        }

        switch ($estado_b){
            case "1":
                //ingreso a central
                $d_estado='Ingreso';
                break;

            case "2":
                //despacho a departamentos.
                $d_estado='Recepción';
               
                break; 

            case "3":
                //despacho a reingreso bolsas bacias.
                $d_estado='Despacho';
                break; 

            case "4":
                //despacho a .
                $d_estado='Reingreso';
                break; 
            case "5":
                $d_estado="Salida Age.";
                break;
            case "0":
                    $d_estado="no disponible.";
                    break;
        }

        if($estado_b==0){

            $sql_b_e="select id_bolsa from bolsa where codigo_unico='".$cod_unico."'";
            $d_e=$db->consultar($sql_b_e);
            /**En esta sentencia comprobamso si existe o no la bolsa dentro del sistema
             * si existe se colocara el codigo de estado 8 que significa existe pero no fue
             * asignada para su envio en sistema.
             * en caso contrario se colocara el codigo 9 que indica que no esta registrado el codigo
             * en el sistema de rastreo de bolsas mas si fue leido. 
             */

             //print_r($sql_b_e);
            $existe=0;
            foreach($d_e as $r_d_e){
                $existe=$r_d_e['id_bolsa'];
            }

                if($existe==0){
                    /**bolsa no encontrada */
                $mj[]=array(
                        "info"=>'el codigo de bolsa '.$cod_unico.' no esta registrado en el sistema',
                        "resultado"=>'codigo no encontrado favor de ingresarlo a sistema si corresponde a una viñeta RFID que ha sido ingresada.',
                        "estado"=>9,
                        "estado_predio"=>$d_estado_pre,
                );
                }else{
                    /**se encontro bolsas */
                    $mj[]=array(
                        "info"=>'bolsa encontrada en base de datos',
                        "resultado"=>'El codigo unico '.$cod_unico.' se encuntra registrado mas no fue registrado para salida en la agencia',
                        "estado"=>8,
                        "estado_predio"=>$d_estado_pre,
                );
                }

        }else{
            /**tambien fue contavilisido */
            $mj[]=array(
                "info"=>'erro de procesos',
                "resultado"=>'El estado actual es '.$d_estado.'y fue procesado en fecha '.$fecha_estado,
                "estado"=>$d_estado,
                "estado_predio"=>$d_estado_pre
            );

        }
    }

    
    return $mj;
}

public function proceso_actual2(){
    $db=Db::getInstance();
    $sql="select * from correlativo where id_correlativo=2";
    $data=$db->consultar($sql);
    return $data;
}

public function log_bd($barra,$proceso,$resultado){
    $fecha_datetime=date("Y-m-d H:i:s");
    $info='';
    $resultados='';
    $estado='';
    $estado_previo='';

    foreach($resultado as $rw){
           $info=$rw['info'];
           $resultados=$rw['resultado'];
           $estado=$rw['estado'];
           $estado_previo=$rw['estado_predio'];
    }

    $db=Db::getInstance();
    //$fecha_time= date('Y-m-d H:i:s');
    $sql="insert into log_lectura value (0,'".$barra."', '".$fecha_datetime."', '".$info."', '".$resultados."', '".$estado_previo."')";
    //print_r($sql."<br>");
    //exit();
    $data=$db->preparar($sql);
    $data->execute();
    //return $data;
} 

}

?>