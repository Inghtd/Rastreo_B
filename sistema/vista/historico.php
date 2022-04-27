<?php

include('../../class/db.php');
date_default_timezone_set ( 'America/Guatemala');

ini_set("date.timezone", 'America/Guatemala');
class historico_ingresos extends Db
{
  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function reporte_h($f1,$f2)
  {
    $db=Db::getInstance();
    $sql = "select *
                        from historico_rebuild
                        where fecha_tiempo between'".$f1."' and '".$f2."' 
                        order by barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    //print_r($c);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }

  public function reporte_h2($f1,$f2)
  {
    $db=Db::getInstance();
    $sql = "select
                            gi.barra as barra,
                            us.usr_nombre as remitente,
                            gi.destinatario as destinatario,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            gi.comentario as comentario,
                            mv.descripcion as estado,
                            mj.nombre as mensajero,
                            gi.fecha_datetime as fecha,
                            cctu.ccosto_nombre as remitente_dep

                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                            inner join centro_costo cctu on cctu.id_ccosto=us.id_ccosto
                        left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
        where mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
                and gi.fecha_date between '".$f1."' and '".$f2."' 
                and gi.id_usr=".$_SESSION['cod_user']."
                
                        order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    //print_r($c);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }

  public function get_img($barra){
    $db=Db::getInstance();
    $sql = "select imagen
                from recurso where char1=$barra
                and estado=4";
    $c=$db->consultar($sql);
    $imagen="";
    while ($row_dl=$c->fetch(PDO::FETCH_NUM))
    {
        if($row_dl[0]!=""){
      $imagen=$row_dl[0];
        }

    }

    return $imagen;
  }

///////////////////////////////////////////////////*rutas autogeneradas*/////////////////////////////////////////////
public function reporte_rutas(){

  $db = Db::getInstance();
  $sql="select * from ruta";
  $ruta=$db->consultar($sql);
  while($row_ruta=$ruta->fetch(PDO::FETCH_OBJ)){
    $data[] = $row_ruta;
  }
  return $data;
}

public function ruta_detalle($id_ruta){
  //aqui obtenemos el detalle de las rutas las cuales esta siguiendo el mensajero
  $db = Db::getInstance();
  $sql="select rd.comentario, rd.hora_ini, rd.hora_fin, ag.agencia_nombre, ag.agencia_direccion, pdd.des_periodicidad, ag.agencia_codigo
        from ruta_detalle rd
        inner join agencia ag on ag.id_agencia=rd.id_agencia
        inner join periodicidad pdd on pdd.id_periodicidad=rd.id_periodicidad
        
        where rd.id_ruta=".$id_ruta;

  $dd_ruta=$db->consultar($sql);
  while ($row_detalle=$dd_ruta->fetch(PDO::FETCH_OBJ)){
    $data[]=$row_detalle;
  }

  return $data;
}

public function vineta_ruta($codigo_agencia){

  $db = Db::getInstance();
  $sql=" select gi.barra  from guia gi
                      inner join agencia ag on ag.id_agencia=gi.des_ccosto 
          inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                      inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                      inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                      where gi.fecha_date between '2021-04-07' and '2021-04-07' and gi.entero1=5
                      and gi.des_ccosto = $codigo_agencia";

  $dd_ruta=$db->consultar($sql);
  while ($row_detalle=$dd_ruta->fetch(PDO::FETCH_OBJ)){
    $data[]=$row_detalle;
  }

  return $data;

}

  public function push_info(){
    session_start();
    $cd=$_SESSION['cod_user'];
    $db = Db::getInstance();
    date_default_timezone_set ( 'America/Guatemala');

    ini_set("date.timezone", 'America/Guatemala');

    $fecha=date("Y-m-d h:i:s");
    $sql="select count(*) as espera from guia where estado=1 and id_usr=$cd";

    $data = $db->consultar($sql);
    while($row=$data->fetch(PDO::FETCH_OBJ)){
      $conteo=$row->espera;
    }
  return $conteo;
  }

  public function rep_historico_full($fecha_inicial, $fecha2){


    $db = Db::getInstance();
  
    $sql="select distinct gi.id_guia, gi.barra, us.usr_nombre, 
    cco.ccosto_nombre 	as costo_origen,  cco.ccosto_codigo as ori_ccosto, gi.destinatario, 
    ccd.ccosto_nombre 	as costo_destino, ccd.ccosto_codigo as des_ccosto, gi.comentario,
    ct.des_cat 		  	  as categoria,
    mj.nombre 			    as mensajero,
    max(IF(mv.descripcion='INGRESO', subtime(mv.fecha_Datetime, '00:00:00'),0)) AS Solicitud_de_Envío,
    max(IF(mv.descripcion='ARRIBO', subtime(mv.fecha_Datetime, '00:00:00'),0)) AS Ingreso,
    max(IF(mv.descripcion='SALIDA A RUTA', mv.fecha_Datetime,0)) AS Salida_a_Ruta,
    max(IF(mv.descripcion='ENVIO RECIBIDO POR MENSAJERO', mv.fecha_Datetime,0)) AS Envío_mensajero,
    
    max(IF(mv.descripcion='ENVIO ENTREGADO', mv.fecha_datetime,0)) AS Entrega,
    max(IF(mv.id_chk='5', mv.fecha_datetime,0)) AS Devolucion
  from guia gi
  inner join usuario us 		 	    on us.id_usr=gi.id_usr
  left join centro_costo cco 	  on cco.id_ccosto=gi.ori_ccosto
  left join centro_costo ccd 	  on ccd.id_ccosto=gi.des_ccosto
  inner join movimiento mv	 	    on mv.id_envio=gi.id_envio
  inner join categoria ct 	 	    on ct.id_cat=gi.entero1
  left join manifiesto_linea ml 	on ml.id_envio=gi.id_envio
  left join manifiesto mnf 		    on mnf.n_manifiesto=ml.n_manifiesto
  left join mensajero mj 		      on mj.id_mensajero=mnf.id_mensajero
  where gi.fecha_date 		 	      between '".$fecha_inicial."' and '".$fecha2."'
  and gi.estado<7
  group by gi.id_guia,gi.barra, us.usr_nombre,cco.ccosto_nombre,cco.ccosto_codigo,mj.nombre order by gi.id_guia desc ;";
  
              $c= $db->consultar($sql);
  
              //print_r($sql);
  
              $data=[];
              $fecha = date("d-m-Y H:i:s");
              $filename = "libros.xls";
  
            
  
  
  
  
              $salida="<style>
              table {
                  border-collapse: collapse;
                  width: 100%;
                }
                
                th, td {
                  text-align: left;
                  padding: 8px;
                }
                
                tr:nth-child(even){background-color: #f2f2f2}
                
                th {
                  background-color: #04AA6D;
                  color: white;
                }
                      </style>";
              $salida .= "<table border='1'>";
  
              $salida .= utf8_decode("<thead> 
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>N°</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Barra</th> 
              
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Nombre Remitente</th> 
              
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Codigo Departamento Remitente</th> 
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Departamento Remitente</th> 
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Nombre Destinatario</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Codigo Departamento Destinatario</th>  
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Departamento Destinatario</th> 
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Comentario</th> 
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Categoria</th>  
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Mensajero</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Solicitud de Envío</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Arribo</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Salida a Ruta</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Envío Recibido por Mensajero</th>
              
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Envío Entregado</th>
              <th style='background-color: #04AA6D; color: white; font-size: 19px;'>Devolución</th>");
                $cnt=0;
                $x=false;
                $css="";
              while ($row=$c->fetch(PDO::FETCH_OBJ))
              {
  
                if($x){
                  $css="style='background-color: #f2f2f2'";
                  $x=false;
              }else{
                  $css="";
                  $x=true;
              }
                $cnt++;
                $salida .= "<tr ".$css.">";
                      $salida .= "<td>".$cnt."</td>";
                      $salida .= "<td>".utf8_decode($row->barra)."</td>";
                      $salida .= "<td>".utf8_decode($row->usr_nombre)."</td>";
                      $salida .= "<td>".utf8_decode($row->ori_ccosto)."</td>";
                      $salida .= "<td>".utf8_decode($row->costo_origen)."</td>";
                      $salida .= "<td>".utf8_decode($row->destinatario)."</td>";
                      $salida .= "<td>".utf8_decode($row->des_ccosto)."</td>";
                      $salida .= "<td>".utf8_decode($row->costo_destino)."</td>";
                      $salida .= "<td>".utf8_decode($row->comentario)."</td>";
                      $salida .= "<td>".utf8_decode($row->categoria)."</td>";
                      $salida .= "<td>".utf8_decode($row->mensajero)."</td>";
                      $salida .= "<td>".utf8_decode($row->Solicitud_de_Envío)."</td>";
                      $salida .= "<td>".utf8_decode($row->Ingreso)."</td>";
                      $salida .= "<td>".utf8_decode($row->Salida_a_Ruta)."</td>";
                      $salida .= "<td>".utf8_decode($row->Envío_mensajero)."</td>";
                     
                      $salida .= "<td>".utf8_decode($row->Entrega)."</td>";
                      $salida .= "<td>".utf8_decode($row->Devolucion)."</td>";
                      $salida .= "</tr>";
              }
          
              $salida .= "</table>";
  
  
             
              return $salida;
  
  
              
            
              
  }



}
?>

