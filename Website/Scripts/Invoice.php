<?php
namespace Classess;
session_start();
error_reporting(~E_WARNING & ~E_NOTICE);
require_once "../Classes/Classess.php";
$ref = Generate::Invoice_RefCode();
Database::AddOrder($ref);
sleep(1);
Database::AddOrder_details($ref);
Generate::Invoice($ref);
Mail::SendConfirmation($ref);
unset($_SESSION['cart']);
header("location: ../Pages/Thank_you.php");
?>