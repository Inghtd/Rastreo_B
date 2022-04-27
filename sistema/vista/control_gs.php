<?php

include ('../model/model_con.php');
date_default_timezone_set('America/Guatemala');
class control_gs extends Db{

  public function __construct()
  {
    $db=Db::getInstance();
  }

  public function get_guia(){
    $db=Db::getInstance();

    $sql="select
                            gi.barra as idPedido,
                            gi.destinatario as name,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            
                            gi.fecha_datetime as createdAt,
                            gi.comentario as comments,
                            
                            
                            gi.estado as estado_guia,
                            
                            us.usr_nombre as nombre_remitente,
                            cctr.ccosto_nombre as dep_remitente,
                            mj.nombre as mensajero
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cctr on cctr.id_ccosto=us.id_ccosto
                        left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        
                        inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                        
    and mv.id_chk=3
    and gi.estado=4
    and ml.estado=1";

    //cosas que no nesesito en la consulta.
    //us.id_usr as remitente,
    //mv.descripcion as estado,
    //gi.fecha_datetime as createdAt,
    //z.zon_descripcion as address, inner join zona z on z.id_zona=mv.id_zona


    $c=$db->consultar($sql);

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    //print_r($data);
    return $data;

  }

  public function get_mensajero()
  {
    $db = Db::getInstance();

    $sql="select mj.nombre,mj.id_mensajero,u.id_usr, u.usr_cod from mensajero mj
            inner join usuario u on u.id_usr=mj.id_usr";

    $c1=$db->consultar($sql);

    while ($row1=$c1->fetch(PDO::FETCH_OBJ))
    {
      $data1[] = $row1;
    }

    //print_r($data);
    return $data1;

  }

  ///////////////////////////////////////////////////warning//////////////////////////////////////////////////////
  public function gui_mj($vineta,$id_mensajero){

    $db=Db::getInstance();
    //session_start();
    $fecha_date		=date('Y/m/d');
    $fecha_datetime	=date('Y/m/d H:i:s');
    $id_usr			=$_SESSION['cod_user'];
    $id_cli         =$_SESSION['shi_codigo'];
    $marca     	 	=time();
    $estado     	=1;
    $cont_u     	=0;
    $cont_i     	=0;
    $existe_vineta  =0;
    $numid          =date('Ymdhis');
    $posicion       =1;


//Buscamos si existe una vineta apta para reasignacion --  Debe estar la guia en estado 4 para LD
    $sql="SELECT g.*
				FROM rastreobam.guia g 
				INNER JOIN rastreobam.orden o
				ON g.id_orden=o.id_orden
				WHERE g.barra='$vineta'
				AND o.cli_codigo='$id_cli'
				AND g.estado=4";

    $stmt= $db->consultar($sql);
    while ($row=$stmt->fetch(PDO::FETCH_NUM))
    {
      $id_guia		=$row[0];
      $id_envio		=$row[1];
      $ori_ccosto		=$row[2];
      $des_ccosto		=$row[3];
      $estado			=$row[4];
      $tiempo			=$row[8];
      $char1			=$row[9];
      $entero1		=isset($row[20]);
      $id_orden		=$row[11];
      $barra			=$row[12];
      $comentario		=$row[13];
      $destinatario	=$row[14];
      $existe_vineta  = 1;
    }

   //update manifiesto_linea



    $mlinea="select n_manifiesto from manifiesto_linea where id_envio=".$id_envio;

    $ml=$db->consultar($mlinea);

    $n_manifiesto='';

     while ($row=$ml->fetch(PDO::FETCH_NUM))
    {
      $n_manifiesto=$row[0];
    }

    if($n_manifiesto!=''){

      //se relaizo el cmabio del mensajero asignado en el manifiesto
      $nmsql="update manifiesto set id_mensajero=".$id_mensajero." where n_manifiesto=".$n_manifiesto;

      $db->consultar($nmsql);

      ///se relaiza la actualizacion d elinformaicon del mensajero asignado a la tabla de linea manifiesto
      ///
      $lmsql="update manifiesto_linea set id_mensajero=".$id_mensajero." where n_manifiesto=".$n_manifiesto;

      $db->consultar($lmsql);

    }

      return $n_manifiesto;
    //update linea.

  }

  ///////////////////////////////////////////////////warning//////////////////////////////////////////////////////


  ////////////////////////////////////////////////////funciones de asignacion masiva de mensajeros////////////////////////////////////////////////////

  public function arribados(){
    $db=Db::getInstance();

    $sql="select
                            gi.barra as barra,
                            us.usr_nombre as remitente,
                            cctu.ccosto_nombre as remitente_dep,
                            gi.destinatario as destinatario,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            mv.descripcion as estado,
                            mj.nombre as mensajero,
                            gi.fecha_datetime as createdAt,
                            gi.estado as idm
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        inner join centro_costo cctu on cctu.id_ccosto=us.id_ccosto
                        left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        inner join categoria ct on ct.id_cat=gi.entero1
                        inner join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
        where gi.estado=3 and mv.id_chk=2
              and mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
        
                        order by gi.barra desc";

    ///inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
    /// mj.nombre as mensajero
    /// informaicon que no se utiliza
    /// mv.id_chk=2
    //    and
    $c=$db->consultar($sql);

    //capturamso los valores

    while ($row=$c->fetch(PDO::FETCH_OBJ))
    {
      $data[] = $row;
    }

    //retornamso la data
    return $data;

  }



  function zona(){
    @session_start();
    $bd=Db::getInstance();
    $shi_codigo=$_SESSION['shi_codigo'];

    $sql_c = "SELECT z.* 
					FROM zona z 
					INNER JOIN usuario u 
					ON z.id_usr=u.id_usr
					WHERE u.cli_codigo='$shi_codigo'
					AND z.zon_codigo !='ZZ'";
      //print_r();
    $retorno ="<select name='id_zona' id='id_zona' class=\"form-control\" readonly required>
					<option value=''>-</option>";

    $c= $bd->consultar($sql_c);

    while ($row=$c->fetch(PDO::FETCH_NUM)){
      $retorno .="<option value='".$row[0]."'>".$row[1]." ".$row[2]."</option>";
    }

    $retorno .="</select>";

    return $retorno;
  }





  public function asignacionmasiva($id_zona,$id_mensajero,$vineta){
              $db=Db::getInstance();
              session_start();
              $fecha_date		=date('Y/m/d');
              $fecha_datetime	=date('Y/m/d H:i:s');
              $id_usr			=$_SESSION['cod_user'];
              $id_cli         =$_SESSION['shi_codigo'];
              $marca     	 	=time();
              $estado     	=1;
              $cont_u     	=0;
              $cont_i     	=0;
              $existe_vineta  =0;
              $numid          =date('Ymdhis');
              $posicion       =1;

                //Buscamos si existe una vineta apta para LD  --  Debe estar la guia en estado 3 para LD
              $sql="SELECT g.*
                      FROM rastreobam.guia g 
                      INNER JOIN rastreobam.orden o
                      ON g.id_orden=o.id_orden
                      WHERE g.barra='$vineta'
                      AND o.cli_codigo='$id_cli'
                      AND g.estado=3";

              $stmt= $db->consultar($sql);
              while ($row=$stmt->fetch(PDO::FETCH_NUM))
              {
              $id_guia		=$row[0];
              $id_envio		=$row[1];
              $ori_ccosto		=$row[2];
              $des_ccosto		=$row[3];
              $estado			=$row[4];
              $tiempo			=$row[8];
              $char1			=$row[9];
              $entero1		=isset($row[20]);
              $id_orden		=$row[11];
              $barra			=$row[12];
              $comentario		=$row[13];
              $destinatario	=$row[14];
              $existe_vineta  = 1;
              }

              //El numid que se trae se evalua
              $sql_2="SELECT * FROM rastreobam.manifiesto WHERE n_manifiesto='$numid'";
              $existe_numid=0;
              $stmt_2= $db->consultar($sql_2);
              while ($row_2=$stmt_2->fetch(PDO::FETCH_NUM))
              {
                $existe_numid=1;
              }

              //Si no existe insertamos el numid en el encabezado
              if($existe_numid==0)
              {
                $ing_1="INSERT INTO rastreobam.manifiesto
                          VALUES (0, '$numid', '$id_zona', '$id_mensajero', 1, '$id_usr', '$fecha_date', '$fecha_datetime', '$marca')";

                $stmt_i1= $db->preparar($ing_1);

                if($stmt_i1->execute()){
                  $msj_i1="Ingresado";
                }
                else{
                  $msj_i1="Error Insert manifiesto".$numid;
                }
              }

              //Por ID guia actualizamos el estado - Se actualiza a estado 4
              if($existe_vineta==1){
                //ACtualizamos el estado de la guia/vineta
                $upd="UPDATE rastreobam.guia
                        SET estado=4
                        WHERE id_envio='$id_guia'
                        AND id_orden='$id_orden'
                        AND  estado=3";

                $stmt_u= $db->preparar($upd);

                //print_r($stmt);
                if($stmt_u->execute()){
                  $msj_u="Ingresado";
                }else{
                  $msj_u="Error Update Orden LD".$id_orden;
                }

                //Insertamos la linea de cada posicion del manifiesto generado
                $ing_2="INSERT INTO rastreobam.manifiesto_linea
                        VALUES (0,'$numid','$posicion',3,1,'$id_guia')";

                $stmt_i2= $db->preparar($ing_2);
                //echo $ing_2;

                if($stmt_i2->execute()){
                  $msj_i2="Ingresado";
                }
                else{
                  $msj_i2="Error manifiesto_linea".$numid."-".$posicion;
                }

                //Luego se inserta LD (Salida a Ruta) en movimiento
                $ing="INSERT INTO rastreobam.movimiento 
                          (id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
                        VALUES (0,'$id_guia',3,'$id_zona','$id_mensajero','$id_usr','$fecha_date','$fecha_datetime','$marca','3','SALIDA A RUTA',NULL) ";

                $stmt_i= $db->preparar($ing);

                //print_r($stmt);
                if($stmt_i->execute()){
                  $msj_i="Ingresado";
                }
                else{
                  $msj_i="Error Insert Orden LD".$id_orden;
                }
              }

              if($existe_vineta==0){
                $msj="Existe";
              }
              elseif($msj_u =='Ingresado' && $msj_i =='Ingresado'){
                $msj="Insertado";
              }
              else{
                $msj="Error";
              }

              //echo $msj;
              return $msj;
}



}
?>
