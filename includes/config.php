<?php 
// DB credentials.
//define('DB_HOST','192.168.16.2');
define('DB_HOST','mysqldb');
define('DB_USER','MYSQL_USER');
define('DB_PASS','MYSQL_PASSWORD');
define('DB_NAME','MYSQL_DATABASE');


//var_dump(DB_HOST, DB_USER, DB_PASS, DB_NAME); exit;

// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}
?>
