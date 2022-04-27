<?php
//model model_mov
//modelo de movimientos QR
//
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

include('../../class/db.php');
date_default_timezone_set('America/Guatemala');

class model_mov extends Db
{
	public function __construct()
	{
		$db=Db::getInstance();
	}

	public function mov_completo($barra)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT m.id_movimiento,
						m.id_envio,
						m.id_chk,
						m.descripcion,
						m.id_zona,
						m.id_mensajero,
						m.id_usr,
						m.fecha_date,
						m.fecha_datetime,
						fn_ccostoNombre(g.ori_ccosto) as ori_ccosto,
						fn_ccostoNombre(g.des_ccosto) as des_ccosto,
						g.id_orden,
						g.barra,
						g.destinatario,
						g.des_direccion,
						g.comentario
				FROM rastreobam.movimiento m
				INNER JOIN rastreobam.guia g
				ON g.id_guia=m.id_envio
				WHERE g.barra='$barra'";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}

	public function mov_enca($barra)
    {	
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

        //$sql_time="SET time_zone = '-6:00';";
        //$stmt=$db->consultar($sql_time);

		$sql = "
                
                        SELECT id_guia,
						id_envio,
						fn_ccostoNombre(ori_ccosto) as ori_ccosto,
						fn_ccostoNombre(des_ccosto) as des_ccosto,
						estado,
						fn_usrNombre(id_usr) as id_usr,
						fecha_date,
						fecha_datetime,
						tiempo,
						CASE char1 WHEN 'E' THEN 'EXTERNO' WHEN 'I' THEN 'INTERNO' END AS tipo_envio,
						fn_catNombre(entero1) as categoria,
						id_orden,
						barra,
						comentario,
						destinatario,
						des_direccion
				FROM rastreobam.guia 
				WHERE barra='$barra'";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}

	public function mov_tl($barra)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT
						g.barra,
        				m.id_envio,
						COUNT(IF(m.id_chk=1, id_chk,NULL)) AS PI,
        				COUNT(IF(m.id_chk=2, id_chk,NULL)) AS AR,
        				COUNT(IF(m.id_chk=3, id_chk,NULL)) AS LD,
        				COUNT(IF(m.id_chk=4, id_chk,NULL)) AS DL,
        				COUNT(IF(m.id_chk=5, id_chk,NULL)) AS DV
				FROM rastreobam.guia g
				INNER JOIN rastreobam.movimiento m
				ON g.id_envio=m.id_envio
				WHERE g.barra=$barra";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}

	public function mov_tl2($barra){
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');

        $tiempo=time();
        $orden=1;
        $existe_usr=0;

        $sql = "
        select
        g.barra,
        m.id_envio,
        max(IF(m.id_chk=1, m.fecha_Datetime,0)) AS PI,
        max(IF(m.id_chk=1, m.descripcion,0)) AS PI_des,
        max(IF(m.id_chk=2, m.fecha_Datetime,0)) AS AR,
        max(IF(m.id_chk=2, m.descripcion,0)) AS AR_des,
        max(IF(m.id_chk=3, m.fecha_Datetime,0)) AS LD,
		max(IF(m.id_chk=3, m.descripcion,0)) AS LD_des,
        max(IF(m.id_chk=4, m.fecha_datetime,0)) AS DL,
        max(IF(m.id_chk=4, m.descripcion,0)) AS DL_des,
        max(IF(m.id_chk=5, m.fecha_datetime,0)) AS DV,
        max(IF(m.id_chk=5, m.descripcion,0)) AS DV_des
        FROM rastreobam.guia g
        INNER JOIN rastreobam.movimiento m
        ON g.id_envio=m.id_envio
        WHERE g.barra='$barra'
        group by 1,2
        ";

        $stmt=$db->consultar($sql);
        //echo $sql;
        return $stmt;



    }


    public function recurso_origen($barra){
        $db=Db::getInstance();

        $tiempo=time();

        $sql = "select r.imagen, r.latitud, r.longitud, r.estado
                from recurso r 
                inner join guia g
                on r.char1=g.barra
                where g.barra='$barra'
                and r.estado=2;";
        $stmt=$db->consultar($sql);
        //echo $sql;
        return $stmt;

    }


    public function recurso_destino($barra){
        $db=Db::getInstance();

        $tiempo=time();

                $sql = "select imagen, latitud, longitud, estado
                from recurso 
                where char1='".$barra."'
                and estado=4
                and imagen!=''";
        $stmt=$db->consultar($sql);
        //echo $sql;
        return $stmt;

    }








    public function humanizando_fecha($fechaa)
    {
        $tiempo=strtotime($fechaa);
        $fechac=date('d-m-Y H:i:s',($tiempo-(60*60*7)));
        $fecha = substr($fechac, 0, 10);
        $hora=substr($fechac, 10,9);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio." a las ".$hora;

    }

    public function humanizando_fecha2($fechaa)
    {
        $tiempo=strtotime($fechaa);
        $fechac=date('d-m-Y H:i:s',$tiempo);
        $fecha = substr($fechac, 0, 10);
        $hora=substr($fechac, 10,9);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio." a las ".$hora;

    }



    public function correccion_fecha_hora1($fecha){
	    $tiempo=strtotime($fecha);
        $fechac=date('d-m-Y H:i:s',($tiempo-(60*60*7)));
        return $fechac;

    }


}
?>