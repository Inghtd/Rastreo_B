<?php
function valida_usuario($form){
    
    //ini_set ("display_errors","1" );
    //error_reporting(E_ALL);

    $respuesta = new xajaxResponse();
    require 'class/db.php';
    $usr	=$form['usr'];
    $pass	=$form['pass'];
    $bd=Db::getInstance();
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
                cc.ccosto_telefono 
            FROM usuario a 
            INNER JOIN cliente c 
            ON a.cli_codigo=c.cli_id
            INNER JOIN centro_costo cc 
            ON a.id_ccosto=cc.id_ccosto
            WHERE a.usr_cod='$usr'
            AND a.usr_pass='".md5($pass)."'";

    $existe=0;
    $stmt=$bd->consultar($sql);
    while ($row=$bd->obtener_fila($stmt)) {
        $existe++;
        @session_start();
        //echo "1";
        $_SESSION['cod_usuario'] = $usr;
        $_SESSION['cod_user'] = $row[0];
        $_SESSION['nivel'] = $row[6];
        $_SESSION['depto'] = $row[7];
        $_SESSION['shi_codigo'] = $row[4];
        $_SESSION['id_grupo'] = $row[5];
        $_SESSION['shi_nombre'] = $row[14];
        $_SESSION['usr_nom'] = $row[3];
        $_SESSION['ccosto'] = $row[8];
        $_SESSION['ccosto_codigo'] = $row[16];
        $_SESSION['ccosto_nombre'] = $row[17];
    }
        if($existe>0){
            //Terminando escritura de sesion
            session_write_close();
            //header("Location: https://www.rapidtables.com/web/dev/php-redirect.html", true, 301);
            $respuesta->script("document.location.href = 'sistema/index.php'");
        }else {
            //session_unset();   // Eliminando Variables desesion.
            //session_destroy(); // Terminando sesion creadaantes.
            $error_form = "Usuario no Valido";
            $respuesta->assign("mensaje", "innerHTML", "<span class='textorojo_bold'>" . $error_form . "</span>");
        }
        return $respuesta;
}
?>
