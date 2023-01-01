<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'customer_service');
    define('DB_PASSWORD', 'qwe123rty456');
    define('DB_NAME', 'IT_World');

    $link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if($link === false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>