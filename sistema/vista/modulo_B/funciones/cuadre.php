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

        /**
         * Esta clase se encargara de realizar un cuadre mucho mas eficiente
         * para ello aremos una comparacion de lo que se adjunto con los codigos
         *  
         */
        public function comparacion($f1,$f2){

                $db=Db::getInstance();
                $f1=$f1." 00:00:00";
                $f2=$f2." 23:59:59";

                $sql="select * from cuadre_bolsa_neo
                where fecha_datetime between '".$f1."' and '".$f2."'";

                //print_r($sql);

                $data=$db->consultar($sql);

                return $data;

        }

        public function proceso_actual(){
            $db=Db::getInstance();
            $sql="select * from correlativo where id_correlativo=2";
            $data=$db->consultar($sql);
            $dd=array();
            foreach($data as $row){
                $dd=array(
                    '0'=>$row['seq_ini'],
                    '1'=>$row['seq_fin']
                );  
            }

            return $dd;
        }

        public function escaneo($barra,$proceso){
            /*procedemos a relaizar el escaneo de la data*/
            $db=Db::getInstance();
            ///verificamos que la bolsa procesada poseea codigo
            $estado=$this->proceso($proceso);

            $bolsa=$this->bolsa($barra,$estado['estado_previo']);


            $log_bolsa=array();
            
           if($bolsa['id']==0){

            $existe=$this->bolsa_x($barra);
            
            if($existe['id_bolsa']==0){
                $log_bolsa=array(
                    "info"=>'El codigo de bolsa '.$barra.' no se encuntra registrado',
                    "resultado"=>'no registrado',
                    "estado"=>'sin registro',
                    "estado_predio"=>'no hay informacion'
                );
                }else{
                    $log_bolsa=array(
                        "info"=>'El codigo de bolsa'.$existe['codigo_unico'].' no fue enviado',
                        "resultado"=>'La agencia '.$existe['agencia'].' envio este codigo de bolsa en fecha'.$existe['fecha'],
                        "estado"=>$existe['estado'],
                        "estado_predio"=>$existe['descripcion']
                    );
                }
                   //print($barra."--".$proceso."----".$log_bolsa['info']."<br>");
                $this->log_bd($barra,$proceso,$log_bolsa);

           }else{
            ///la funcion proceso se encarga de evaluar lo que estamos prosesando
            ///con ella podemos verificar el estado que debe poseer previo y coloca rla info del proceso 
            ///que el seguir adespues.
            $estado=$this->proceso($proceso);
            $fecha_datetime	=date('Y-m-d H:i:s');
            $marca     	 	=time();
            
            //procedemos a validar que el estado de la bolsa sea el correcto.
            if($estado['estado_previo']==$bolsa['estado_bolsa']){
                //print_r('**aqui estoy perro***');
                //print_r($estado['estado_previo']."==".$bolsa['estado_bolsa']);
                //realizamos el update
                $min_sql="update control_bolsa set estado='".$estado['estado_actual']."' 
                where id_controlb='".$bolsa['id']."'";
                $smtp=$db->preparar($min_sql);
                print_r($min_sql."<br>");
                if($smtp->execute()){
                    //insercion dle movimiento.
                   
                    $sql_mb="insert into movimiento_bolsa values('0','".$bolsa['barra']."','".$fecha_datetime."','".$marca."','".$estado['estado_actual_nom']."', '".$estado['estado_actual']."', 'Bolsa','escaneo con pistola','0')";
                    $smtb=$db->preparar($sql_mb);
                    print_r($sql_mb."<br>");
                    if($smtb->execute()){

                        $log_bolsa=array(
                            "info"=>'El codigo de bolsa '.$barra.' se actualizo a la perfeccion',
                            "resultado"=>'no registrado',
                            "estado"=>$estado['estado_actual_nom'],
                            "estado_predio"=>'no hay informacion'
                        );

                        $this->log_bd($barra,$proceso,$log_bolsa);
                    }else{
                            
                            $log_bolsa=array(
                            "info"=>'El codigo de bolsa '.$barra.' genero un problema en los movimientos',
                            "resultado"=>'no se genero movimiento,'.$smtb,
                            "estado"=>$estado['pre_estado_nom'],
                            "estado_predio"=>'movimiento error'
                        );

                        $this->log_bd($barra,$proceso,$log_bolsa);
                    }

                }
    

            }else{

                $log_bolsa=array(
                    "info"=>'El codigo de bolsa '.$barra.' ya fue previamente leido',
                    "resultado"=>'no se genero cambio ',
                    "estado"=>$estado['pre_estado_nom'],
                    "estado_predio"=>'sin cambios en estado.'
                );

                $this->log_bd($barra,$proceso,$log_bolsa);

            }




           }

            
           
            return $log_bolsa['info'];
            

        }

        private function proceso($proceso){

            $d_estado_pre='';
            $estado_pre=0;
            $estado=0;
            $d_estado="";


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

            $data=array(
                "estado_previo"=>$estado_pre,
                "pre_estado_nom"=>$d_estado_pre,
                "estado_actual"=>$estado,
                "estado_actual_nom"=>$d_estado
            );

            return $data;
        }

        private function bolsa($codigo_unico,$estado_pre){

            $sql="select cb.id_controlb,cb.barra,mb.fecha_hora,cb.estado from control_bolsa cb
            left join movimiento_bolsa mb on mb.barra=cb.barra
                left join orden o on o.id_orden = cb.numero_orden and o.entero1='1'
                    where cb.codigo_unico='".$codigo_unico."' and cb.estado='".$estado_pre."'";
            $db=Db::getInstance();
            $bl=$db->consultar($sql);
            $bolsa=array(
                    "id"=>0,
                    "barra"=>0,
                    "estado_bolsa"=>0
            );

            foreach($bl as $b){
                print_r($b);
                $bolsa=array(
                    "id"=>$b['id_controlb'],
                    "barra"=>$b['barra'],
                    "estado_bolsa"=>$b['estado']
                );
            }

            
            return $bolsa;
        }

        private function bolsa_x($codigo_unico){

            $sql="select b.id_bolsa,a.agencia_nombre, cb.codigo_unico,cb.descripcion,cb.fecha,cb.estado from bolsa b
            left join agencia a on a.id_agencia=b.origen
            left join control_bolsa cb on cb.codigo_unico=b.codigo_unico and cb.id_controlb =(select max(id_controlb) from control_bolsa where codigo_unico=b.codigo_unico)
            where b.codigo_unico='".$codigo_unico."'";
            $db=Db::getInstance();
            $bl=$db->consultar($sql);
            $bolsa=array(
                    "id_bolsa"=>0,
                    "agencia"=>0,
                    "codigo_unico"=>0,
                    "descripcion"=>0,
                    "fecha"=>0,
                    "estado"=>0
            );

            
            $estado='';
            foreach($bl as $b){
                
                switch ($b['estado']){
                    case "1": $estado='Ingreso'; break;
                    case "2": $estado='Arribo'; break;
                    case "3": $estado='Despacho'; break;
                    case "4": $estado='Re-Ingreso'; break;
                    case "5": $estado='Salida Agencia'; break;
                }
                    
                $bolsa=array(
                    "id_bolsa"=>$b['id_bolsa'],
                    "agencia"=>$b['agencia_nombre'],
                    "codigo_unico"=>$b['codigo_unico'],
                    "descripcion"=>$b['descripcion'],
                    "fecha"=>$b['fecha'],
                    "estado"=>$estado
                );
            }

            
            return $bolsa;
        }

        private function ecepciones(){
            /*Funcion privada para manejo de ecepciones y su registro en el sistema de log de alertas.*/

        }


        public function log_bd($barra,$proceso,$resultado){
            $fecha_datetime=date("Y-m-d H:i:s");
            $info='';
            $resultados='';
            $estado='';
            $estado_previo='';
            //print_r($resultado['info']."<br>");
            if($resultado['info']!=0){

                   $info=$resultado['info'];
                   $resultados=$resultado['resultado'];
                   $estado=$resultado['estado'];
                   $estado_previo=$resultado['estado_predio'];
            }

            $db=Db::getInstance();
            //$fecha_time= date('Y-m-d H:i:s');
            $sql="insert into log_lectura value (0,'".$barra."', '".$fecha_datetime."', '".$info."', '".$resultados."', '".$estado."')";
            //print_r($sql."<br>");
            //exit();
            $data=$db->preparar($sql);
            $data->execute();
            //return $data;
        }   
        
        public function movimiento_bolsa(){

        }


        public function reporte_agencias($f1,$f2){
            $f1=$f1." 00:00:00";
            $f2=$f2." 23:59:59";
            $db=Db::getInstance();
            $sql="select ag.id_agencia,ag.agencia_nombre, 
            sum(IF(ag.id_agencia=b.origen,1,0)) as total_b,
            sum(IF(mb.chk_id=1,1,0)) as total_ingreso,
            sum(IF(mb.chk_id=2,1,0)) as total_arribo,
            sum(IF(mb.chk_id=3,1,0)) as total_despacho,
            sum(IF(mb.chk_id=4,1,0)) as total_re_ingreso,
            sum(IF(mb.chk_id=5,1,0)) as total_Salida_agencia,
            sum(if(`b`.`color` = 1,1,0)) as 'Gris',
            sum(if(`b`.`color` = 2,1,0)) as roja,
            sum(if(`b`.`color` = 3,1,0)) as azul,
            sum(if(`b`.`color` = 4,1,0)) as amarilla,
            sum(if(`b`.`color` = 5,1,0)) as verde_l,
            sum(if(`b`.`color` = 6,1,0)) as cafe,
            sum(if(`b`.`color` = 7,1,0)) as negra,
            sum(if(`b`.`color` = 8,1,0)) as morada,
            sum(if(`b`.`color` = 9,1,0)) as naranja,
            sum(if(`b`.`color` = 10,1,0)) as nr
            from orden o
            inner join control_bolsa cb on cb.numero_orden =o.id_orden and cb.estado=1
            left join bolsa b on b.codigo_unico=cb.codigo_unico 
            left join agencia ag on ag.id_agencia=b.origen
            left join movimiento_bolsa mb on mb.barra=cb.barra
            where cb.codigo_unico <> ''
            and o.fecha_datetime between '".$f1."' and '".$f2."'
            group by ag.id_agencia";

            //print_r($sql);

            $data = $db->consultar($sql);

            return $data;


        }

        public function detalle_ejecutivo($f1,$f2){
            $f1=$f1." 00:00:00";
            $f2=$f2." 23:59:59";
            $db=Db::getInstance();
            $sql="select 
            sum(IF(cb.estado>=1,1,0)) as total_b,
            sum(IF(cb.estado=1,1,0)) as total_ingreso,
            sum(IF(cb.estado=2,1,0)) as total_arribo,
            sum(IF(cb.estado=3,1,0)) as total_despacho,
            sum(IF(cb.estado=4,1,0)) as total_re_ingreso,
            sum(IF(cb.estado=5,1,0)) as total_Salida_agencia,
            sum(if(`b`.`color` = 1,1,0)) as 'Gris',
            sum(if(`b`.`color` = 2,1,0)) as roja,
            sum(if(`b`.`color` = 3,1,0)) as azul,
            sum(if(`b`.`color` = 4,1,0)) as amarilla,
            sum(if(`b`.`color` = 5,1,0)) as verde_l,
            sum(if(`b`.`color` = 6,1,0)) as cafe,
            sum(if(`b`.`color` = 7,1,0)) as negra,
            sum(if(`b`.`color` = 8,1,0)) as morada,
            sum(if(`b`.`color` = 9,1,0)) as naranja,
            sum(if(`b`.`color` = 10,1,0)) as nr
            from orden o
            inner join control_bolsa cb on cb.numero_orden =o.id_orden and cb.estado!=1
            left join bolsa b on b.codigo_unico=cb.codigo_unico 
            left join agencia ag on ag.id_agencia=b.origen
            
            where cb.codigo_unico <> ''
            and o.fecha_datetime between '".$f1."' and '".$f2."'";

            $data = $db->consultar($sql);

            return $data;


        }

        public function log_data(){
            
        }

        function obtenerPorcentaje($cantidad, $total) {
            $porcentaje = ((float)$cantidad * 100) / $total; // Regla de tres
            $porcentaje = round($porcentaje, 2);  // Quitar los decimales
            return $porcentaje;
        }

        public function ccostos($f1,$f2){

            $f1=$f1." 00:00:00";
            $f2=$f2." 23:59:59";
            $db=Db::getInstance();
            $sql="select cc.id_ccosto,cc.ccosto_codigo,cc.ccosto_nombre,
            count(g.id_guia) as envios_totales
            from orden o
            inner join guia g on g.id_orden=o.id_orden
            inner join centro_costo cc on cc.id_ccosto=g.ori_ccosto
            where o.fecha_date between '".$f1."' and '".$f2."'
            group by cc.id_ccosto";

            $data = $db->consultar($sql);

            return $data;

        }


    }

 ?>   