<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require ('class/db.php');
try 
  {
    $usr	=preg_replace('/[\@\=<>*.\;\" "\']+/', '',$_POST['usr']);
    $pass	=md5($_POST['pss']);
    //$log  = $_POST['lg'];
    $resul=0;
    $db=Db::getInstance();
    //echo "hola mundo estoy en ---> + 13";

 
    $sql="SELECT 
                a.id_usr, 
                a.usr_cod, 
                a.usr_pass, 
                a.usr_nombre, 
                a.cli_codigo, 
                a.id_grupo, 
                a.nivel, 
                a.depto, 
                a.id_ccosto, 
                a.area, 
                a.producto, 
                a.posicion, 
                a.estado, 
                a.dias_vencimiento, 
                c.cli_nombre, 
                c.cli_direccion,
                cc.ccosto_codigo, 
                cc.ccosto_nombre, 
                cc.ccosto_telefono,
                a.entero1
            FROM usuario a 
            INNER JOIN cliente c 
            ON a.cli_codigo=c.cli_id
            LEFT JOIN centro_costo cc 
            ON a.id_ccosto=cc.id_ccosto
            WHERE a.usr_cod='$usr'
            AND a.usr_pass='".$pass."'";

    $existe=0;
    $stmt=$db->consultar($sql);


    while ($row=$db->obtener_fila($stmt)) {
        $existe++;
        @session_start();
        //echo "1";
        $_SESSION['cod_usuario'] = $usr;
        $_SESSION['cod_user'] = $row[0];
        $_SESSION['nivel'] = $row[6];
        $_SESSION['depto'] = $row[7];
        $_SESSION['shi_codigo'] = $row[4];
        $_SESSION['id_grupo'] = $row[5];
       
        $_SESSION['shi_nombre'] = $row[14]." ".$row[15];

        $_SESSION['usr_nom'] = $row[3];
        $_SESSION['ccosto'] = $row[8];
        $_SESSION['ccosto_codigo'] = $row[16];
        $_SESSION['ccosto_nombre'] = $row[17];
        $_SESSION['agencia'] = $row[19];
    }

   
        if($existe>0){
            
            //Terminando escritura de sesion
            session_write_close();
            //header("Location: https://www.rapidtables.com/web/dev/php-redirect.html", true, 301);
           $sql="select count(id_log) as log_usr from log_usr where usr_afecto='$usr' and tipo='S'";
            $data = $db->consultar($sql);

            $resul=0;
            foreach($data as $d){
                
                $resul=$d['log_usr'];
                
            }

         
            
            if($resul==0){
                $respuesta=array(
                    'codigo'=> 200,
                    'mensaje'=>$resul,
                );
            }else{

                $respuesta=array(
                    'codigo'=> 202,
                    'mensaje'=>$resul,
                );
           
        }


/*
        $respuesta=array(
            'codigo'=> 200,
            'mensaje'=>'usuario valido',
        );
*/
        }else {

           $sql="select count(id_log) as log_usr from log_usr where usr_genero='enviagt' and usr_afecto='enviagt'";
            $data = $db->consultar($sql);

           
            foreach($data as $d){
                $resul=$d->log_usr;
            }

           

            //session_unset();   // Eliminando Variables desesion.
            //session_destroy(); // Terminando sesion creadaantes.
            $error_form = "Usuario no Valido";
            $respuesta=array(
                'codigo'=> 404,
                'mensaje'=>"verifique su usario y contraseña".$usr,
                'SQL'=>$sql
            );
        }
        echo json_encode($respuesta);
        //json_encode($respuesta);

    } 
    catch(Exception $e) //capturamos un posible error
    {
      //mostramos el texto del error al usuario	  
      //echo "Error " . $e;
      $respuesta=array(
        'codigo'=> 502,
        'mensaje'=>" A ocurrido un error critico: ".$e['codigo'],
        'SQL'=>"error de conexión, intente nuevamente "
    );
      echo json_encode($respuesta);
    }
?>