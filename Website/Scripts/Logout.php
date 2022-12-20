<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: ../../index.php");
}
else 
{
    $_SESSION = array();
    session_destroy();
    header("location: ../../index.php");
}
?>