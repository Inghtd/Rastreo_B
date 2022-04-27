<?php
$username='root';
$password='useadm1ndb';
$database='urbanoweb';
$dbm = mysql_connect('192.168.20.4', 'root','useadm1ndb');
$base_m = mysql_select_db('urbanoweb');


$link = mysql_connect('localhost', 'root', 'useadm1ndb') or die("Couldn't
make connection.");
$db = mysql_select_db('urbanoweb', $link) or die("Couldn't select
database");

?>
