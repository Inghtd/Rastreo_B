<?php

$servidor='localhost';
$usuario='root2';
$password='1v341F1ca';
$base_datos='rastreo';
$dsn = 'mysql:host='.$servidor.';dbname='.$base_datos;
$opciones = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$gbd = new PDO($dsn, $usuario, $password, $opciones);

$sql="
SELECT 
a.usr_id, 
a.usr_cod, 
a.usr_pass, 
a.usr_nombre, 
a.cli_codigo, 
a.id_grupo, 
a.nivel, 
a.depto, 
a.ccosto_codigo, 
a.area, 
a.producto, 
a.posicion, 
a.estado, 
a.dias_vencimiento, 
c.cli_nombre, 
c.cli_direccion 
FROM usuario a 
inner join cliente c 
on a.cli_codigo=c.cli_id 
WHERE a.usr_cod='enviagt' 
and a.usr_pass='3821922e0dfd010a9340fc731eb5eb7b'";


echo "<pre>";

//$stmt=$gbd->prepare($sql);
//$stmt->execute();

$stmt=$gbd->query($sql);

while ($row=$stmt->fetch(PDO::FETCH_BOTH))
{
print_r($row);
}
echo "</pre>"
?>