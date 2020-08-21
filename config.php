<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/* hint for pw - adw */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'Use_Your_Password');
define('DB_NAME', 'CL');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
