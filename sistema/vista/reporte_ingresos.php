<?php

include('../../class/db.php');
date_default_timezone_set ( 'America/Guatemala');

/*ini_set ("display_errors","1" );
error_reporting(E_ALL);*/


ini_set("date.timezone", 'America/Guatemala');
class model_con extends Db
{
  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function reporte_n($f1,$f2)
  {
    try{
    $db=Db::getInstance();
    $sql = "select * from rep_nuevos where fecha between '".$f1."' and '".$f2."'";
              /*
               $sql = "select * from reporte_h
              where ge between '2' and '3'
              and fecha between '".$f1."' and '".$f2."'";
                */            

                   //$sql="call rastreobam.nuevos_ingresos();";     

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }catch(Exception $e){
      echo $e;
  }
  }


  public function reporte_n2()
  {
    try{
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
                  cctu.ccosto_nombre as remitente_dep,
                  mv.id_motivo as idm
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
                            and gi.estado in (1, 2) 
                            and  ((mv.descripcion like 'INGRESO') OR (mv.descripcion like 'ARRIBO'))
                      and gi.id_usr=".$_SESSION['cod_user']."
                      order by gi.barra desc";

    //and mv.descripcion='ARRIBO' or mv.descripcion='INGRESO'
    $c= $db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;

  }catch(Exception $e){
    echo $e;
}
  }

////////////////////////////////////////////WARNING///////////////////////////////////
///
  public function centro_costos(){

    $db=Db::getInstance();

    $sql="select * from centro_costo";

    $c=$db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;
  }


  public function centroc($id_ccosto){

    $db=Db::getInstance();

    $sql="select c.ccosto_codigo, c.ccosto_nombre, c.centro_direccion, c.ccosto_telefono, a.agencia_nombre from centro_costo c 
          inner join agencia a on a.id_agencia=c.id_agencia 
         where c.id_ccosto=".$id_ccosto;

    $c=$db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    return $data;

  }

  public function centroup($string, $id_cc){
    $db=Db::getInstance();
    $sql="update centro_costo set ".$string." where id_ccosto=".$id_cc;
    $db->consultar($sql);
    //echo $sql;
  }



}
?>
