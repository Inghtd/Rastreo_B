<?php

include ("../../class/db.php");

class usuarios extends Db{

  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function list_usr(){
    $db=Db::getInstance();
      $sql="select u.id_usr as id, u.usr_nombre as nombre, cc.ccosto_nombre as ccosto, u.nivel as perfil, u.usr_cod as usr from usuario u 
            inner join centro_costo cc on cc.id_ccosto=u.id_ccosto";
    $datos=$db->consultar($sql);
    return $datos;
  }

  public function password($pass,$usr){

    $db=Db::getInstance();
    $pss=md5($pass);
    $sql="update usuario set usr_pass='".$pss."' where usr_cod='".$usr."'";
    //echo $sql;
    $datos=$db->consultar($sql);
    if(!$datos){
      die('No se puede consultar: '.$datos);
    }

    $fecha_datetime	=date('Y/m/d H:i:s');
    $marca     	 	=time();


    $sql2="insert into log_usr (id_log,evento,fecha,marca,tipo,usr_genero,usr_afecto)
    values(0,'cambio contraseña','$fecha_datetime','$marca','S','$usr','$usr')";
    $result=$db->consultar($sql2);
    echo $sql2;
  }

  public function editar($string,$usr,$nombre)
  {

    $db = Db::getInstance();

    $sql = "update usuario set " . $string . " where id_usr=" . $usr;

    $db->consultar($sql);
    

   /* $sql2="select u.usr_nombre, cc.ccosto_nombre from usuario u
            inner join centro_costo cc on cc.id_ccosto=u.id_ccosto
            where u.id_usr=".$usr;

    $data=$db->consultar($sql2);*/

    return $sql;
  }

  public function guia_edicion($barra){

    $db=Db::getInstance();

    $sql="select gi.destinatario,cc.ccosto_nombre,gi.des_direccion,dc.agencia,dc.descripcion,des_cat,cc.id_ccosto  from guia gi
    inner join detalle_acuse dc on dc.barra=gi.barra
    inner join centro_costo cc on cc.id_ccosto=gi.des_ccosto
    inner join categoria cat on cat.id_cat=dc.categoría
    where gi.barra='".$barra."'";

    $datos=$db->consultar($sql);

    return $datos;

  }

  public function up_guia($parametros,$barra,$detalle){

    $db=Db::getInstance();

    //tabla guia.
    $sql="update guia set ".$parametros." where barra='".$barra."'";
      //print $sql;
    $db->consultar($sql);

    //tablas a afectar detalle_acuse

    $sql1="update detalle_acuse set ".$detalle." where barra='".$barra."'";
      print $sql1;
    $db->consultar($sql1);


  }

  public function desbloquerar($barra){

    $db=Db::getInstance();
    $sql="update guia set estado=3 where barra in ($barra)";

    try{

      //$db->consultar($sql);

      return "1";
      
    }catch (Exception $e){

      return $e->getMessage();

    }

  }


}
?>
