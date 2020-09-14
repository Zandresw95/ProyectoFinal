<?php
//coneccion a la base
$db_host		= 'us-cdbr-east-02.cleardb.com';
$db_user		= 'baa1e7556611c5';
$db_pass		= 'd3825e54';
$db_database	= 'heroku_e17ca9f7d5231fe'; 

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>