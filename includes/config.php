<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','qamata');
define('DB_PASS','secrect');
define('DB_NAME','usermngmtsys_db');
define('DB_PORT','30666');
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
