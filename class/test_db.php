<?php
$servername = "rastreobam.mysql.database.azure.com";
$username = "root2@rastreobam";
$password = "1v341F1ca";


/*Incluimos el fichero de la clase*/
require 'db.php';
//$mi = new Db;
 
/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Db::getInstance();

$sql_1="SELECT 
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
            ON a.id_ccosto=cc.id_ccosto";
 
$stmt=$bd->consultar($sql_1);
/*Realizamos un bucle para ir obteniendo los resultados*/
while ($row=$bd->obtener_fila($stmt,0)){
	echo $row[0].'<br />';
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=rastreobam", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>

<?php
function getFruit($conn) {
    $sql = 'SELECT * FROM usuarios ORDER BY 1';
    foreach ($conn->query($sql) as $row) {
        print_r($row);
    }
}
?>
