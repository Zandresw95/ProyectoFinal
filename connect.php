<?php
//coneccion a la base
$db_host		= 'localhost';
$db_user		= 'root';
$db_pass		= 'andy1995';
$db_database	= 'pos'; 

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>