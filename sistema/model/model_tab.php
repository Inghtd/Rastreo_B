<?php
//model model_con
//0430080126
//
ini_set('post_max_size','100M');
ini_set('upload_max_filesize','100M');
ini_set('max_execution_time','1000');
ini_set('max_input_time','1000');

include('../class/db2.php');

class model_tab extends Db
{
	public function __construct()
	{
		$db=Db::getInstance();
	}

	public function registra_envio($ccosto_ori,$ccosto_des,$destinatario,$descripcion,$vineta)
    {
		$db=Db::getInstance();
		session_start();
		$msg="";
        $usr	=$_SESSION['cod_user'];
		$date1	=date('Y/m/d');
		$date2	=date('Y/m/d H:i:s');
		$tiempo	=time();

		$orden=1;
        $numero_guia=0;
		$sql_c = "SELECT max(id_guia) 
					FROM guia ";
		
		$c= $db->consultar($sql_c);
		while ($row=$c->fetch(PDO::FETCH_NUM))
		{
			$gui_anterior       =$row[0];
			$numero_guia	    =$gui_anterior+1;
		}

		$id_envio=$numero_guia;

        $sql_d = "SELECT barra
					FROM guia 
					WHERE barra='$vineta'";

        $d= $db->consultar($sql_d);
        while ($rowd=$d->fetch(PDO::FETCH_NUM))
        {
            $vin_anterior       =$rowd[0];
        }
		
		if(!empty($vin_anterior))
        {
            $msg=" La vi&ntilde;eta ya existe...";
        }else{

    		$insert="INSERT INTO guia (id_guia, id_envio, ori_ccosto, des_ccosto, estado,id_usr, fecha_date, fecha_datetime, tiempo, char1, entero1, id_orden, barra, comentario) 
					VALUES($numero_guia,'$id_envio', '$ccosto_ori', '$ccosto_des', '1', '$usr', '$date1', '$date2', '$tiempo', '',0, '$orden','$vineta', '$descripcion')";
	    	//echo $insert;
		    $insert1= $db->consultar($insert);
        }

		if(empty($msg)){
		    //echo $msg;
            return $numero_guia;
        }else
        {
            //echo $msg;
            return $msg;
        }
	}

    public function consulta_vineta($vineta)
    {
        $db=Db::getInstance();
        session_start();
        $msg="";
        $date1=date('Y-m-d');
        //echo "Fecha 1: ".$date1."<br>";
        $date2=date('Y-m-d H:i:s');
        $usr=$_SESSION['cod_user'];
        //echo "Fecha 2: ".$date2;
        $tiempo=time();
        $orden=1;
        $numero_guia=0;

  	      $sql_d = "SELECT id_guia,id_envio,ori_ccosto,des_ccosto,estado,id_usr,
                         fecha_date,fecha_datetime,tiempo,char1,entero1,id_orden,
                         barra,comentario
					FROM guia 
					WHERE barra='$vineta'";

        $d= $db->consultar($sql_d);
        $result = $d->fetch(PDO::FETCH_BOTH);
		
		if(empty($id_guia))
        {
            $msg="La vi&ntilde;eta no ha sido ingresada...";
        }

        if(empty($msg)){
            //echo $msg;
            return $msg;
        }else
        {
            //echo $msg;
            return $result;
        }


    }

	public function consulta_usuario($id_usuario)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql_c = "SELECT count(id_usr) FROM usuario WHERE usr_cod='$id_usuario'";
		
		$c= $db->consultar($sql_c);
		while ($row=$c->fetch(PDO::FETCH_NUM))
		{
			$existe_usr	    =$row[0];
		}

        if($existe_usr >0){
            return 1;
        }else{
            return 0;
        }
	}
	
	public function consulta_vineta_tabla($id_ccosto,$id_usr)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT 
						id_envio,ori_ccosto,
						fn_AgeXCc(ori_ccosto) AS age_ori,
						fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
						des_ccosto, 
						fn_AgeXCc(des_ccosto) AS age_des,
						fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
						fn_usrNombre(id_usr) AS usr_ori,
						fecha_datetime,barra,comentario,destinatario
				FROM rastreobam.guia 
				WHERE ori_ccosto='$id_ccosto' 
				  and id_usr = $id_usr
				AND estado=1 
				AND id_orden=1
				ORDER BY id_envio";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}


    public function consulta_vineta_tb($id_ccosto,$id_usr)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT 
						id_envio,ori_ccosto,
						fn_AgeXCc(ori_ccosto) AS age_ori,
						fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
						des_ccosto, 
						fn_AgeXCc(des_ccosto) AS age_des,
						fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
						fn_usrNombre(id_usr) AS usr_ori,
						fecha_datetime,barra,comentario,destinatario
				FROM rastreobam.guia 
				WHERE ori_ccosto='$id_ccosto' 
				and id_usr = '$id_usr'
				AND estado=1 
				AND id_orden=1
				ORDER BY id_envio";

		$stmt=$db->consultar($sql);
		//echo $sql; and id_usr = $id_usr
		return $stmt;
	}

	public function consulta_vineta_tb_agencia($id_ccosto)
    {
        $db=Db::getInstance();
        $msg="";
        $date1=date('Y-m-d');
        $date2=date('Y-m-d H:i:s');
    
        $tiempo=time();
        $orden=1;
        $existe_usr=0;

		$sql = "SELECT 
						id_envio,ori_ccosto,
						fn_AgeXCc(ori_ccosto) AS age_ori,
						fn_ccostoNombre(ori_ccosto) AS ori_ccosto_nombre,
						des_ccosto, 
						fn_AgeXCc(des_ccosto) AS age_des,
						fn_ccostoNombre(des_ccosto) AS des_ccosto_nombre,
						fn_usrNombre(id_usr) AS usr_ori,
						fecha_datetime,barra,comentario,destinatario
				FROM rastreobam.guia 
				WHERE ori_ccosto='$id_ccosto' 
				
				AND estado=1 
				AND id_orden=1
				ORDER BY id_envio";

		$stmt=$db->consultar($sql);
		//echo $sql;
		return $stmt;
	}


    public function consulta_vineta_bolsas($shi_codigo){

		$db = Db::getInstance();

		$sql="select cb.barra, cb.codigo_unico, cb.descripcion,c.cli_direccion,c.cli_id,cb.fecha,
		ag.agencia_nombre, ag.agencia_codigo
		from control_bolsa cb
		inner join cliente c on c.cli_id = cb.cliente
		inner join bolsa bls on bls.codigo_unico=cb.codigo_unico
		inner join agencia ag on ag.id_agencia=bls.destino
		where cliente='".$shi_codigo."' and numero_orden='';";

		$data = $db->consultar($sql);

		return $data;

    }


}