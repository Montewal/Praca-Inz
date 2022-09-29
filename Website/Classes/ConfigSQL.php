<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'Generic_User');
define('DB_PASSWORD', 'r8TaPbPVj6Gmh4EFdAZk');
define('DB_NAME', 'WEB_Service');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect to database!. " . mysqli_connect_error());
}
?>