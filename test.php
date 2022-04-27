<?php
$servername = "rastreo.mysql.database.azure.com";
$username = "root2@rastreo";
$password = "1v341F1ca";

try {
    $conn = new PDO("mysql:host=$servername;dbname=rastreo", $username, $password);
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

