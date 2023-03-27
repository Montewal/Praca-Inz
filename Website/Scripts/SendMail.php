<?php
namespace Classess;
require_once "../Classes/Classess.php";
require "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $email = $_POST["email"];
    if(Database::CheckUser($email)) 
    {
        $username = Database::CheckUser($email);
    }
    else 
    {
        return;
    }
    $password = Generate::RandomPass();
    $name = "noreply@IT_World";
    $subject = '=?UTF-8?B?'.base64_encode("Nowe hasło do IT_World").'?=';
    $message = 
    "<!DOCTYPE html>
    <html lang='pl'>
    <head>
        <meta charset='UTF-8'>
        <style>
            p {
                color: #000;
            }
        </style>
    </head>
    <body>
        <br/>
        <p>Cześć ".$username."</p>
        <p> Na twoją prośbę wygenerowaliśmy nowe hasło</p>
        <br/>
        <p><b> Nowe hasło:</b></p>
        <p>".$password."</p>
        <br/>
        </body>";

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = ""; // gmail
    $mail->Password = ""; // gmail app password
    $mail->IsHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress($email, "@NoReply");
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->send();

    Database::ChangePass($email,$password); 
    header("location: ../Pages/Login.php");
}