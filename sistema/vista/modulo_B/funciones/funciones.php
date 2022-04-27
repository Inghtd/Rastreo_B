<?php
    include('../../../../class/db.php');
    date_default_timezone_set ( 'America/Guatemala');

    ini_set("date.timezone", 'America/Guatemala');
    class funciones extends Db
    {
        public function __construct() 
        {
            $db=Db::getInstance();
        }

        public function select($tabla,$parametro){

            $db=Db::getInstance();

            $sql="select * from ".$tabla." where ".$parametro;

            $d= $db->consultar($sql);

            while ($row=$d->fetch(PDO::FETCH_OBJ))
            {
              $data[] = $row;
            }
        
            return $data;

        }

        public function proceso($estado,$n){

            $db=Db::getInstance();
            $sql="update correlativo set seq_ini='".$estado."', seq_fin='".$n."' where id_correlativo=3";
            $db->consultar($sql);
        }

        public function proceso_actual(){
            $db=Db::getInstance();
            $sql="select * from correlativo where id_correlativo=2";
            $data=$db->consultar($sql);
            return $data;
        }

        public function existencia_bolsa($codigo){
            $db = Db::getInstance();

            $exi="select count(*) as existe from bolsa where codigo_unico='".$codigo."'";

            $ex=$db->consultar($exi);

            $existe=0;
            foreach($ex as $r){

                    $existe=$r['existe'];
            }

            return $existe;
        }


        public function reg_bolsa($codigo,$agencia,$color,$destino,$direccion,$categoria){

            $fecha = date('Y-m-d H:i:s');
            $db = Db::getInstance();

            $sql="insert into bolsa values ('0','$codigo','$agencia','$color','$destino','$direccion','$categoria','$fecha');";

            $data=$db->consultar($sql);

            return $data;
            
        }

        public function list_bolsas(){

            //informaicon de las bolsas registradas en el sistema.

            $db=Db::getInstance();

            $sql="select b.codigo_unico,ao.agencia_nombre as origen,
            case
                when b.color=1 then 'Gris'
                when b.color=2 then 'Roja'
                when b.color=3 then 'Azul'
                when b.color=4 then 'Amarilla'
                when b.color=5 then 'verde de lona'
                when b.color=6 then 'cafe'
                when b.color=7 then 'negra'
                when b.color=8 then 'Morada'
                when b.color=9 then 'Naranja'
                when b.color=10 then 'Negro con Rojo'
            end as color_b, ad.agencia_nombre as destino,
            case
                when b.categoria = 1 then 'General'
                when b.categoria = 2 then 'Especifico'
            end as categori_b, b.fecha
             from bolsa b
             left join agencia ao on ao.id_agencia=b.origen
			 left join agencia ad on ad.id_agencia=b.destino
             order by b.codigo_unico";

             $data = $db->consultar($sql);

            return $data;
        }

        public function manifiesto_agencia(){

            /* Esta funcion se encarga de generar el manifiesto de control de las agencias, 
            puesto que este manifiesto para cuadrar las piesas que fueron enviadas a la agencia.*/

            $db	=	Db::getInstance();
            session_start();
            $cliente = $_SESSION['shi_codigo'];
            
            //$validar = "select numero_manifiesto from control_agencia where estado='1' and agencia='".$cliente."';";

            //$manifiesto= $db->consultar($validar);

            $numero="0";

            /*
            foreach($manifiesto as $man){
                $numero=$man['numero_manifiesto'];
            }
            */

            
            
            if($numero==0){

                $fecha      =   date('Y-m-sd H:i:s');
                $time       =   time();
                $numero     =   date('Ymd').$time;

                $sql="insert into control_agencia values ('0','".$time."','".$numero."','".$fecha."','".$cliente."','1');";

                $db->consultar($sql);   
            }

            return $numero;
        }

        public function OS_bolsa($codigo_unico,$descripcion){

        $db=Db::getInstance();
		session_start();
		$date		=date('Y-m-d');
		$datetime	=date('Y/m/d H:i:s');
		$tiempo		=time();
		$id_usr		=$_SESSION['cod_user'];
        $cliente = $_SESSION['shi_codigo'];
		$llave      =$tiempo;
		$estado     =1;

        $tipo = $this->tipo_bolsa($codigo_unico);
        $color= $this->color_bolsa($codigo_unico);
        $barra= "B".$this->barra_gen();
       
        $existe= $this->control_bolsa($codigo_unico,$date);
        
        $resultado=$existe;
            if($existe==0){

                //insertamos la bolsa para que pueda ser ingresada en sistema
                    $sql="insert into control_bolsa values ('0','".$codigo_unico."','".$barra."','','".$descripcion."','".$cliente."','".$date."','1')";

                    $db->consultar($sql);

                    $resultado=$existe;
            }
        return $resultado;

        }



        /**informaicones geenrales */
        public function tipo_bolsa($codigo_unico){


           
            $pos = substr($codigo_unico,-9,1);

            $tipo="";

            if($pos == 'G'){
                $tipo="General";
            }
            if($pos == 'E'){
                $tipo="Especifico ";
            }

            return $tipo;

        }

        public function color_bolsa($codigo_unico){

            $pos = substr($codigo_unico,-8,2);
            $color="";

            switch($pos){

                case "01":
                    $color="Gris";
                    break;

               case "02":
                    $color="Roja";
                    break;

                case "03":
                    $color="Azul";
                    break;
                case "04":
                    $color="Amarilla";
                    break;

                case "05":
                    $color="verde de lona";
                    break;

                case "06":
                    $color="cafe";
                    break;

                case "07":
                    $color="negra";
                    break;

                case "08":
                    $color="Morada";
                    break;

                case "09":
                    $color="Naranja";
                    break;
                    
            }

            return $color;
        }

        public function inf_bolsa($codigo_unico){

            $db = Db::getInstance();

            $sql = "select * from ";

        }

        public function barra_gen(){

            $db = Db::getInstance();

            $sql1="select seq from correlativo where id_cli='4' and estado='4';";

            $correlativo = $db->consultar($sql1);

            foreach($correlativo as $row){
                $clt=$row['seq']+1;

                $sql2="update correlativo set seq='".$clt."' where id_cli='4' and estado='4'";

                $db->consultar($sql2);
            }

            return $clt;
        }

        public function control_bolsa($codigo_unico,$fecha){
            //esta funcion es para identificar a las bolsas.
            $db = Db::getInstance();

            $sql = "select * from control_bolsa where codigo_unico='".$codigo_unico."' and fecha='".$fecha."'";

            $barra = $db->consultar($sql);

            $existe=0;
            foreach($barra as $row){

                    $id_controlb        =$row['id_controlb'];
                    $codigo_unico       =$row['codigo_unico'];
                    $barrac             =$row['barra'];
                    $numero_manifiesto  =$row['numero_manifiesto'];
                    $descripcion        =$row['descripcion'];
                    $cliente            =$row['cliente'];
                    $fecha              =$row['fecha'];

                    $existe=1;
            }

            return $existe;
        }

        public function bolsa_existente(){
            $db=Db::getInstance();

            
        }

        public function orden_data($par){

            $db=Db::getInstance();
            $fecha_actual = date("d-m-Y");
            $date		= date("d-m-Y",strtotime($fecha_actual."- 1 days"));
            //consultamos todos los codigos de las 
            $sql="select c.cli_id,c.cli_direccion,o.id_orden
            from cliente c
            inner join orden o on o.cli_codigo=c.cli_id 
            where c.cli_id ".$par."
            and o.estado='1'
            and entero1='1'
            ";
            ///print $sql;
            //and o.fecha_date='".$date."'
            $data_o = $db->consultar($sql);

            $bolsas=0;
            $guias=0;
            $data_t=[];

          

            foreach($data_o as $row_o){
                $bolsas=0;
                $bolsa_sc=0;
                $guias=0;
                $guias_sc=0;
                $cli_id=$row_o['cli_id'];
                $cli_direccion=$row_o['cli_direccion'];
                $id_orden=$row_o['id_orden'];

                $sql_B="select count(cb.id_controlb) as b, count(mb.id_movimientoB) as m from control_bolsa cb
                left join movimiento_bolsa mb on mb.barra=cb.barra and mb.chk_id='2'
                where cb.numero_orden='".$id_orden."'
                ;";

                $data_b=$db->consultar($sql_B);

                foreach($data_b as $row_b){
                    $bolsas=$bolsas+$row_b['b'];
                    $bolsa_sc=$bolsa_sc+$row_b['m'];
                }


                $sql_G="select count(gi.id_guia) as g, count(mv.id_movimiento) as mv from guia gi
                left join movimiento mv on mv.id_envio=gi.id_envio and mv.id_chk='2'
                where gi.id_orden='".$id_orden."';";

                $data_g=$db->consultar($sql_G);

                foreach($data_g as $row_g){
                    $guias=$guias+$row_g['g'];
                    $guias_sc=$guias_sc+$row_g['mv'];
                }

                //guardamos todo en un arreglo.
                $data[]=array(
                    "id_cliente"=> $cli_id,
                    "nombre"    => $cli_direccion,
                    "orden"     => $id_orden,
                    "bolsas"    => $bolsas,
                    "bolsa_sc"  => $bolsa_sc,
                    "guias"     => $guias,
                    "guia_sc"   => $guias_sc
                );

            }
           
            return $data;
        }

        public function orden_data_detalle($cliente,$orden){

            $db=Db::getInstance();
            //consultamos todos los codigos de las 
            $sql="select c.cli_id,c.cli_direccion,o.id_orden
            from cliente c
            inner join orden o on o.cli_codigo=c.cli_id 
            where c.cli_id ='$cliente'";
            //print_r($sql);
            $data_o = $db->consultar($sql);

            $bolsas=0;
            $guias=0;
            $data_t=[];

           
                $bolsas=0;
                $bolsa_sc=0;
                $guias=0;
                $guias_sc=0;
                //$cli_id=$row_o['cli_id'];
                //$cli_direccion=$row_o['cli_direccion'];
                //$id_orden=$row_o['id_orden'];

                $sql_B="select cb.codigo_unico, cb.barra, cb.numero_orden,cb.descripcion,mb.estado,mb.fecha_hora,rp.id_reporte,rp.comentario from control_bolsa cb
                left join movimiento_bolsa mb on mb.barra=cb.barra and mb.id_movimientoB=(select max(id_movimientoB) from movimiento_bolsa where barra=cb.barra)
                left join  rp_estado rp on rp.barra=cb.barra 
                where cb.numero_orden='".$orden."';";

                $data_b=$db->consultar($sql_B);

                

                $sql_G="select  gi.id_guia,gi.barra,gi.comentario as coment,gi.destinatario,mv.descripcion,us.usr_nombre as remitente,rp.id_reporte,rp.comentario,mv.fecha_Datetime from guia gi
                left join movimiento mv on mv.id_envio=gi.id_envio and mv.id_movimiento = (select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
                inner join usuario us on us.id_usr=gi.id_usr
                left join  rp_estado rp on rp.barra=gi.barra 
                where gi.id_orden='".$orden."';";

                $data_g=$db->consultar($sql_G);

                //guardamos todo en un arreglo.
                $data[]=array(
                    "bolsas"    => $data_b,
                    "guias"     => $data_g
                );

         
           
            return $data;
        }

        public function ordenes_usr(){

            $db = Db::getInstance();
            session_start();
            $usr= $_SESSION['usr_nom'];

            $sql_o="select gi.barra,us.usr_nombre as remitente,gi.comentario,
            gi.destinatario,mv.descripcion,mv.fecha_date, rp.id_reporte
            from guia gi 
            left join movimiento mv on mv.id_envio=gi.id_envio and mv.id_movimiento = (select max(id_movimiento) from movimiento where id_envio=gi.id_envio) 
            inner join usuario us on us.id_usr=gi.id_usr
            left join  rp_estado rp on rp.barra=gi.barra 
            where gi.destinatario = '$usr'
            and gi.barra not in (select barra from rp_estado where barra=gi.barra)";
        
            

            $dd=$db->consultar($sql_o);
            $data=[];
            foreach($dd as $d){
                $data[]=$d;
            }

            //print_r($data);
            return $data;

        }

        
            public function bolsas_dp(){
                $db = Db::getInstance();
                session_start();
                $costo=$_SESSION['ccosto'];
                $sql_b="select cb.codigo_unico, cb.barra, cb.descripcion,mb.estado,cb.numero_orden,mb.chk_id,mb.fecha_hora,id_bolsa,bl.direccion from control_bolsa cb
                inner join movimiento_bolsa mb on mb.barra = cb.barra
                inner join bolsa bl on bl.codigo_unico = cb.codigo_unico
                where mb.id_movimientoB = (select max(id_movimientoB) from movimiento_bolsa where barra=cb.barra)
                and mb.chk_id>'1'
                and cb.barra not in (select barra from rp_estado where barra=mb.barra)
                and bl.direccion='".$costo."'";
    
                $data=$db->consultar($sql_b);
                
                return $data;
    
            }
        



        public function reportar_orden_b($barra, $comentario){
            session_start();
            $usr=$_SESSION['cod_user'];
            $db = Db::getInstance();

            $fecha=date('Y-m-d H:i:s');

            $sql_rp="insert into rp_estado values ('0','".$barra."','".trim($comentario)."','".$fecha."','".$usr."');";

            $db->consultar($sql_rp);

        }

        public function up_envios_b(){

            
            /*informaicon de servicios*/
            $db= Db::getInstance();
            session_start();
            $fecha_date		=date('Y-m-d');
            $fecha_datetime	=date('Y-m-d H:i:s');
            $marca = time();
            session_start();
            $_SESSION['ccosto_codigo'];
            $sql_b="select cb.barra from control_bolsa cb
            inner join movimiento_bolsa mb on mb.barra = cb.barra
            where mb.id_movimientoB = (select max(id_movimientoB) from movimiento_bolsa where barra=cb.barra)
            and mb.chk_id>'1'
            and cb.barra not in (select barra from rp_estado where barra=mb.barra)";

            $barras=$db->consultar($sql_b);

            foreach($barras as $br){
                
                $id_guia=$br['barra'];
               //print_r($br);
               session_start();
               $usr=$_SESSION['cod_user'];
              
                $comentario='Bolsa resivida exitosamente';
                $fecha=date('Y-m-d H:i:s');

                $sql_rp="insert into rp_estado values ('0','".$id_guia."','".$comentario."','".$fecha."','".$usr."');";

                $barras=$db->consultar($sql_rp);
                /*
                $ing="INSERT INTO rastreobam.movimiento 
                (id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
                VALUES (0,'$id_guia',6,1,1,'$id_usr','$fecha_date','$fecha_datetime','$marca','1','INGRESO',NULL) ";*/

            }

        }






        public function reportar_orden($barra, $comentario){

            $usr=$_SESSION['cod_user'];
            $db = Db::getInstance();

            $fecha=date('Y-m-d H:i:s');

            $sql_rp="insert into rp_estado values ('0','".$barra."','".trim($comentario)."','".$fecha."','".$usr."');";

            $db->consultar($sql_rp);

        }

        public function up_envios(){

            
            /*informaicon de servicios*/
            $db= Db::getInstance();
            session_start();
            $fecha_date		=date('Y-m-d');
            $fecha_datetime	=date('Y-m-d H:i:s');
            $marca = time();
            $usr= $_SESSION['usr_nom'];

            $id_usr=$_SESSION['cod_user'];

            $sql_e="select barra from guia gi
            where gi.destinatario = '$usr'
            and gi.barra not in (select barra from rp_estado where barra=gi.barra)";

            $barras=$db->consultar($sql_e);

            foreach($barras as $br){
                
                $id_guia=$br['barra'];
               //print_r($br);
              
                $comentario='Envío resivido exitosamente';
                $fecha=date('Y-m-d H:i:s');

                $sql_rp="insert into rp_estado values ('0','".$id_guia."','".$comentario."','".$fecha."');";

                $barras=$db->consultar($sql_rp);
/*
                $ing="INSERT INTO rastreobam.movimiento 
                (id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
                VALUES (0,'$id_guia',6,1,1,'$id_usr','$fecha_date','$fecha_datetime','$marca','1','INGRESO',NULL) ";*/

            }

        }

        public function estado_bolsas(){
            $db=Db::getInstance();
            $fecha_actual = date("d-m-Y");
            $date		= date("d-m-Y",strtotime($fecha_actual."- 1 days"));
            //consultamos todos los codigos de las 
            $sql="select 
            SUM(IF(mb1.chk_id='1',1,0)) AS Ingreso,
            SUM(IF(mb1.chk_id='2',1,0)) AS Arribo,
            SUM(IF(mb1.chk_id='3',1,0)) AS Despacho,
            SUM(IF(mb1.chk_id='4',1,0)) AS Reingreso,
            SUM(IF(mb1.chk_id='5',1,0)) AS Salida_agencia
           from (
                       
    
                   select distinct
                   mb.barra, mb.estado, mb.chk_id,
                   from orden o
                       inner join control_bolsa cb on cb.numero_orden=o.id_orden
                       left join movimiento_bolsa mb on mb.barra=cb.barra
                       inner join bolsa bl on bl.codigo_unico=cb.codigo_unico
                       left join agencia ag on ag.id_agencia=bl.origen
                       where o.entero1='1'and o.estado='1' 
                       
                       and cb.codigo_unico!=''
                       
                       ) mb1;
            ";
            print $sql;
            //and o.fecha_date='".$date."'
            $data_o = $db->consultar($sql);

            $bolsas=0;
            $guias=0;
            $data_t=[];

            foreach($data_o as $row_o){
                $data_t=array(
                    "Ingreso"=>$row_o['Ingreso'],
                    "Arribo"=>$row_o['Arribo'],
                    "Despacho"=>$row_o['Despacho'],
                    "Reingreso"=>$row_o['Reingreso'],
                    "Salida_agencia"=>$row_o['Salida_agencia']
                );
            }

            return $data_t;

        }

        public function data_bolsas(){

            $db=Db::getInstance();
            $sql="select * from cuadre_bolsa";

            $data_o = $db->consultar($sql);

            $bolsas=0;
            $guias=0;
            $data_t=[];
            $string='';
 
            foreach($data_o as $row_o){

                $hex='';
                $string=$row_o['codigo_unico'];
                for ($i=0; $i < strlen($string); $i++){
                    $hex .= dechex(ord($string[$i]));
                }
            
            
                /*$codigo='{
                    "epc":"'.$hex.'",
                    "pc": "3000",
                    "codigo":"'.$row_o['codigo_unico'].'",
                    "isHeartBeat":"false"
                        }';*/
                
                $data_t[]=array(
                    "orden"=>$row_o['id_orden'],
                    "barra"=>$row_o['barra'],
                    "codigo_unico"=>$row_o['codigo_unico'],
                    "descripcion"=>$row_o['id_movimientoB'],
                    "estado"=>$row_o['estado'],
                    "cli_direccion"=>$row_o['agencia_nombre'],
                    "fecha"=>$row_o['fecha_datetime'],
                    "cli_id"=>$row_o['origen'],
                    "proceso"=>$row_o['proceso'],
                    "fecha_datetime"=>$row_o['fecha_hora'],
                    "color"=>$row_o['color_b']
                );



            }

            //print_r($data_o);
            return $data_t;



        }

        public function reporte_salida($f1,$f2){

            if($f1==''){
            $fecha1= date("Y-m-d")." 00:00:00";
            $fecha2= date("Y-m-d")." 23:59:59";
            }else{
                $fecha1= $f1;
                $fecha2= $f2;
            }

            $db=Db::getInstance();

            $sql="select o.id_orden,o.fecha_datetime, cb.barra,cb.codigo_unico,
                    mb.id_movimientoB,mb.estado,mb.chk_id,mb.fecha_hora,bl.origen,ag.id_agencia,ag.agencia_nombre,
                case
                    when bl.color=1 then 'Gris'
                    when bl.color=2 then 'Roja'
                    when bl.color=3 then 'Azul'
                    when bl.color=4 then 'Amarilla'
                    when bl.color=5 then 'Verde de lona'
                    when bl.color=6 then 'Cafe'
                    when bl.color=7 then 'Negra'
                    when bl.color=8 then 'Morada'
                    when bl.color=9 then 'Naranja'
                    when bl.color=10 then 'Negro con Rojo'
                    end as color_b, case
                    when bl.categoria=1 then 'General'
                    when bl.categoria=2 then 'Departamento'
                end as tipo_b from orden o
                       inner join control_bolsa cb on cb.numero_orden=o.id_orden
                       left join movimiento_bolsa mb on mb.barra=cb.barra
                       inner join bolsa bl on bl.codigo_unico=cb.codigo_unico
                       left join agencia ag on ag.id_agencia=bl.origen
                       where o.entero1='1'and o.estado='1' 
                       and mb.id_movimientoB=(select max(id_movimientoB) from movimiento_bolsa where barra=cb.barra)
                       and cb.codigo_unico!=''
                       and mb.chk_id='5'
                       and mb.fecha_hora between '".$fecha1."' and '".$fecha2."' ";

                       //print_r($sql);

                       $data_o = $db->consultar($sql);

                       $bolsas=0;
                       $guias=0;
                       $data_t=[];
                       $string='';
            
                       foreach($data_o as $row_o){
           
                           $hex='';
                           $string=$row_o['codigo_unico'];
                           for ($i=0; $i < strlen($string); $i++){
                               $hex .= dechex(ord($string[$i]));
                           }
                       
                       
                           /*$codigo='{
                               "epc":"'.$hex.'",
                               "pc": "3000",
                               "codigo":"'.$row_o['codigo_unico'].'",
                               "isHeartBeat":"false"
                                   }';*/
                           
                           $data_t[]=array(
                               "orden"=>$row_o['id_orden'],
                               "barra"=>$row_o['barra'],
                               "codigo_unico"=>$row_o['codigo_unico'],
                               "descripcion"=>$row_o['id_movimientoB'],
                               "estado"=>$row_o['estado'],
                               "cli_direccion"=>$row_o['agencia_nombre'],
                               "fecha"=>$row_o['fecha_datetime'],
                               "cli_id"=>$row_o['origen'],
                               "proceso"=>$row_o['proceso'],
                               "fecha_datetime"=>$row_o['fecha_hora'],
                               "color"=>$row_o['color_b']
                           );
           
           
           
                       }
           
                       //print_r($data_o);
                       return $data_t;
        }


        public function reporte_hitorico($f1,$f2){

            if($f1==''){
            $fecha1= date("Y-m-d")." 00:00:00";
            $fecha2= date("Y-m-d")." 23:59:59";
            }else{
                $fecha1= $f1;
                $fecha2= $f2;
            }

            $db=Db::getInstance();

            $sql="select o.id_orden,o.fecha_datetime, cb.barra,cb.codigo_unico,
                    mb.id_movimientoB,mb.estado,mb.chk_id,mb.fecha_hora,bl.origen,ag.id_agencia,ag.agencia_nombre,
                case
                    when bl.color=1 then 'Gris'
                    when bl.color=2 then 'Roja'
                    when bl.color=3 then 'Azul'
                    when bl.color=4 then 'Amarilla'
                    when bl.color=5 then 'Verde de Lona'
                    when bl.color=6 then 'Cafe'
                    when bl.color=7 then 'Negra'
                    when bl.color=8 then 'Morada'
                    when bl.color=9 then 'Naranja'
                    when bl.color=10 then 'Negro con Rojo'
                    end as color_b, case
                    when bl.categoria=1 then 'General'
                    when bl.categoria=2 then 'Departamento'
                end as tipo_b from orden o
                       inner join control_bolsa cb on cb.numero_orden=o.id_orden
                       left join movimiento_bolsa mb on mb.barra=cb.barra
                       inner join bolsa bl on bl.codigo_unico=cb.codigo_unico
                       left join agencia ag on ag.id_agencia=bl.origen
                       where o.entero1='1'and o.estado='1' 
                       and mb.id_movimientoB=(select max(id_movimientoB) from movimiento_bolsa where barra=cb.barra)
                       and cb.codigo_unico!=''
                       
                       and mb.fecha_hora between '".$fecha1."' and '".$fecha2."' ";

                       //print_r($sql);

                       $data_o = $db->consultar($sql);

                       $bolsas=0;
                       $guias=0;
                       $data_t=[];
                       $string='';
            
                       foreach($data_o as $row_o){
           
                           $hex='';
                           $string=$row_o['codigo_unico'];
                           for ($i=0; $i < strlen($string); $i++){
                               $hex .= dechex(ord($string[$i]));
                           }
                       
                       
                           /*$codigo='{
                               "epc":"'.$hex.'",
                               "pc": "3000",
                               "codigo":"'.$row_o['codigo_unico'].'",
                               "isHeartBeat":"false"
                                   }';*/
                           
                           $data_t[]=array(
                               "orden"=>$row_o['id_orden'],
                               "barra"=>$row_o['barra'],
                               "codigo_unico"=>$row_o['codigo_unico'],
                               "descripcion"=>$row_o['id_movimientoB'],
                               "estado"=>$row_o['estado'],
                               "cli_direccion"=>$row_o['agencia_nombre'],
                               "fecha"=>$row_o['fecha_datetime'],
                               "cli_id"=>$row_o['origen'],
                               "proceso"=>$row_o['proceso'],
                               "fecha_datetime"=>$row_o['fecha_hora'],
                               "color"=>$row_o['color_b']
                           );
           
           
           
                       }
           
                       //print_r($data_o);
                       return $data_t;
        }


        public function informacion_b($codigo){

            $db= Db::getInstance();

            $sql= "select b.id_bolsa,b.codigo_unico,ao.agencia_nombre as origen,
            case
                when b.color=1 then 'Gris'
                when b.color=2 then 'Roja'
                when b.color=3 then 'Azul'
                when b.color=4 then 'Amarilla'
                when b.color=5 then 'verde de lona'
                when b.color=6 then 'cafe'
                when b.color=7 then 'negra'
                when b.color=8 then 'Morada'
                when b.color=9 then 'Naranja'
                when b.color=10 then 'Negro con Rojo'
            end as color_b, ad.agencia_nombre as destino,
            case
                when b.categoria = 1 then 'General'
                when b.categoria = 2 then 'Especifico'
            end as categori_b, b.fecha
             from bolsa b
             left join agencia ao on ao.id_agencia=b.origen
			 left join agencia ad on ad.id_agencia=b.destino
             where codigo_unico='".$codigo."'";


             $data=$db->consultar($sql);


             return $data;
        }

        public function up_info_bolsa($id, $parametro){
            $db=Db::getInstance();
            $sql="update bolsa set ".$parametro." where id_bolsa='".$id."'";

            //print_r($sql);
            $db->consultar($sql);
        }


        public function data_bolsas_cuadre_xls($not){

            $db=Db::getInstance();
            $sql="select * from cuadre_bolsa ";

            $data_o = $db->consultar($sql);

            $bolsas=0;
            $guias=0;
            $data_t=[];
            $string='';
 
            foreach($data_o as $row_o){
                
                $data_t[]=array(
                    "orden"=>$row_o['id_orden'],
                    "barra"=>$row_o['barra'],
                    "codigo_unico"=>$row_o['codigo_unico'],
                    "descripcion"=>$row_o['id_movimientoB'],
                    "estado"=>$row_o['estado'],
                    "cli_direccion"=>$row_o['agencia_nombre'],
                    "fecha"=>$row_o['fecha_datetime'],
                    "cli_id"=>$row_o['origen'],
                    "proceso"=>$row_o['proceso'],
                    "fecha_datetime"=>$row_o['fecha_hora'],
                    "color"=>$row_o['color_b']
                );

            }

            //print_r($data_o);
            return $data_t;



        }

        public function reporte_agencias(){

            $db=Db::getInstance();
            $sql="select ag.id_agencia,ag.agencia_nombre, 
            sum(IF(ag.id_agencia=b.origen,1,0)) as total_b,
            sum(IF(mb.chk_id=1,1,0)) as total_ingreso,
            sum(IF(mb.chk_id=2,1,0)) as total_arribo,
            sum(IF(mb.chk_id=3,1,0)) as total_despacho,
            sum(IF(mb.chk_id=4,1,0)) as total_re_ingreso,
            sum(IF(mb.chk_id=5,1,0)) as total_Salida_agencia
            from agencia ag
            left join bolsa b on b.origen=ag.id_agencia
            left join control_bolsa cb on cb.codigo_unico=b.codigo_unico and estado!='5'
            left join movimiento_bolsa mb on mb.barra=cb.barra /*and mb.chk_id='1'*/
            group by ag.id_agencia";

            $data = $db->consultar($sql);

            return $data;


        }

    }

?>