<?php
include('../../class/db.php');
date_default_timezone_set('America/Guatemala');

class model_con extends Db
{
    public function __construct()
    {
        $db = Db::getInstance();
    }

    public function login($u,$p){
        //login de la api.

        $db=Db::getInstance();
        //datos no encontrados: apellido, correo,
        $sql="select 
                u.id_usr,
                mj.id_mensajero,
                u.usr_nombre,
                mj.telefono,
                cc.id_ccosto
                from mensajero mj
                inner join usuario u on u.usr_cod=mj.telefono
                inner join centro_costo cc on cc.id_ccosto=u.id_ccosto
                where u.usr_cod='$u' and u.usr_pass='$p'";

        $c= $db->consultar($sql);

        //print_r($sql);
        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;

    }

    public function manifiesto($id_usr)
    {
        //captura lso datos de manifiesto.

        $db=Db::getInstance();



        $sql="select
                            gi.barra as idPedido,
                            gi.destinatario as name,
                            cct.ccosto_nombre as centro_costo,
                            gi.des_direccion as direccion,
                            ct.des_cat as categoria,
                            mv.descripcion as estado,
                            gi.fecha_datetime as createdAt,
                            gi.comentario as comments,
                            cct.ccosto_nombre as centro_costo,
                            z.zon_descripcion as address,
                            gi.estado as estado_guia,
                            us.id_usr as remitente,
                            us.usr_nombre as nombre_remitente,
                            cctr.ccosto_nombre as dep_remitente
       
                        from guia gi
                        inner join usuario us on us.id_usr=gi.id_usr
                        left join centro_costo cctr on cctr.id_ccosto=us.id_ccosto
                        left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                        left join categoria ct on ct.id_cat=gi.entero1
                        left join movimiento mv on mv.id_envio=gi.id_envio
                        left join manifiesto_linea ml on ml.id_envio=gi.id_envio
                        left join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                        left join zona z on z.id_zona=mv.id_zona
                        left join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                        where mj.id_mensajero=$id_usr
                        and mv.id_chk=3
                        and gi.estado=4
                        and ml.estado=1";


        $c= $db->consultar($sql);

        //print_r($c);
        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;

    }

    public function guiaup($estado,$barra)
    {

        $db = Db::getInstance();
        //comentar el porblema
        $sql = "update guia set estado='" . $estado . "'
        where barra='" . $barra . "'";
        $c=$db->consultar($sql);
        //print_r($c);
    }

    public function obtener_guia($barra){

        $db=Db::getInstance();
        $sql2="select id_guia,id_envio from guia
        where barra='".$barra."'";
        $gui=$db->consultar($sql2);

        return $gui;
    }



    public function movimeintoup($id_guia,$id_usr,$fecha_date,$fecha_datetime,$marca,$chk,$des){
        $db=Db::getInstance();


        $sql="INSERT INTO movimiento 
							(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,$id_guia,$chk,1,'$id_usr','$id_usr','$fecha_date','$fecha_datetime','$marca','1','$des',NULL) ";
        $c= $db->consultar($sql);

        if($chk==2){
            $sql="INSERT INTO movimiento 
							(id_movimiento,id_envio,id_chk,id_zona,id_mensajero,id_usr, fecha_date, fecha_datetime, tiempo, id_motivo, descripcion, movimientocol)
					VALUES (0,$id_guia,3,1,'$id_usr','$id_usr','$fecha_date','$fecha_datetime','$marca','1','$des',NULL) ";
        $c= $db->consultar($sql);
        }

//echo $sql;
    }

    public function obtener_movimeinto($barra,$id_guia,$chk){

        $db=Db::getInstance();
        $sql2="select max(id_movimiento) from movimiento
        where id_envio=".$id_guia."
        and id_chk=".$chk;
        $mov=$db->consultar($sql2);

        return $mov;
    }


    public function recursoup($barra,$latitud,$longitud,$fecha,$fecha_datetime,$foto,$id_usr,$estado,$tiempo,$movimiento)
    {
        //geolocalizacion y fotos.
        $db=Db::getInstance();

        $sql="insert into recurso 
                (id_recurso, id_movimiento, url, tipo, estado, latitud, longitud, altitud, id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, imagen)
                VALUES(0,$movimiento,'-','-',$estado,'$latitud','$longitud','0',$id_usr,'$fecha','$fecha_datetime','$tiempo','$barra','1','$foto')";
        $c= $db->consultar($sql);



    }




public function carga_img($movimiento,$barra,$imagen)
{
    try {
        $db=Db::getInstance();
        $imagen=addcslashes($imagen,"\x00\'\"\r\n");
       // echo $imagen;
        $sql="update recurso set imagen=_binary'".$imagen."', tipo='".$movimiento."'
    where char1='".$barra."'";

        $c=$db->consultar($sql);
        return "ingreso de imagen";
    } catch (Exception $e){
        //return $e->errorMessage();
    }


}




    public function manifiestoup($id_envio){
        $db=Db::getInstance();
        $sql="update manifiesto_linea set estado=2 where id_envio=".$id_envio;
        $c= $db->consultar($sql);
    }


    function generar_token_seguro($longitud)
    {
        if ($longitud < 4) {
            $longitud = 4;
        }

        return bin2hex(random_bytes(($longitud - ($longitud % 2)) / 2));
    }

    function consul($sql)
    {
       $db = Db::getInstance();
       $c=$db->consultar($sql);

        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;


    }

    public function manifiesto_rebuild($id_usr)
    {
        //esta funcion solo nos proporciona las encomiendas que se an autogenerrado,
        //mediante el procesos de asignacion de rutas el tipo debne de ser 5 para que estas sean visibles.
        $db = Db::getInstance();


        $sql="select distinct gi.id_envio, 
                                gi.barra as barra,
                                gi.destinatario as destinatario,
                                cct.ccosto_nombre as cc_destinatario,
                                gi.des_direccion as destino_direccion,
                                ct.des_cat as categoria,
                                mv.descripcion as estado,
                                gi.fecha_datetime as fecha_cracion,
                                gi.comentario as comentario,
                                cctr.ccosto_nombre as centro_costo,
                                z.zon_descripcion as zona,
                                gi.estado as estado_guia,
                                us.id_usr as remitente,
                                us.usr_nombre as nombre_remitente,
                                cctr.ccosto_nombre as dep_remitente
                            from guia gi
                            inner join usuario us on us.id_usr=gi.id_usr
                            left join centro_costo cctr on cctr.id_ccosto=us.id_ccosto
                            left join centro_costo cct on cct.id_ccosto=gi.des_ccosto
                            left join categoria ct on ct.id_cat=gi.entero1
                            inner join movimiento mv on mv.id_envio=gi.id_envio
                            inner join manifiesto_linea ml on ml.id_envio=gi.id_envio
                            inner join manifiesto mnf on mnf.n_manifiesto=ml.n_manifiesto
                            left join zona z on z.id_zona=mv.id_zona
                            inner join mensajero mj on mj.id_mensajero=mnf.id_mensajero
                            where mj.id_mensajero=$id_usr
                            and mv.id_movimiento=(select max(id_movimiento) from movimiento where id_envio=gi.id_envio)
                            and mv.id_chk in (3,2,1)
                            and gi.estado in (4,2,3)
                            and ml.estado in (1,2)
                            and gi.entero1!=5
                            group by gi.id_envio, gi.barra,
                            gi.destinatario,
                            cct.ccosto_nombre,
                            gi.des_direccion,
                            ct.des_cat,
                            mv.descripcion,
                            gi.fecha_datetime,
                            gi.comentario,
                            cctr.ccosto_nombre,
                            z.zon_descripcion,
                            gi.estado,
                            us.id_usr,
                            us.usr_nombre,
                            cctr.ccosto_nombre";

                        /*--and mv.id_chk=3
                        --and gi.estado=4
                        --and ml.estado=1*/
        $c= $db->consultar($sql);

        //print_r($c);
        $data=[];
        while ($row=$c->fetch(PDO::FETCH_OBJ))
        {
            $data[] = $row;
        }

        //print_r($data);
        return $data;

    }


    
}
?>