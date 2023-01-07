<?php
namespace Classess;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use tFPDF;

	class Generate
	{
		public static function RandomPass() 
		{
			$range = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$rand = str_shuffle($range);
			$cut = substr($rand,0,10);
			return $cut;
		}
		public static function Invoice_RefCode() 
		{
			$range = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$rand = str_shuffle($range);
			$text = "ITW_";
			$date = date("d_m_Y_");
			$cut = substr($rand,0,6);
			$ref = $text.$date.$cut;
			return $ref;
		}
		public static function Invoice($ref) 
		{
			session_start();
			require('../../vendor/tfpdf/tfpdf.php');

			$pdf = new tFPDF('P','mm','A4');
			$pdf->AddPage();
			$pdf->AddFont('Times','','times.ttf',true);
			$pdf->SetFont('Times','B',20);
			$pdf->Cell(71 ,10,'',0,0);
			$pdf->Cell(59 ,5,'Faktura',0,1);
			$pdf->Cell(55 ,10,'',0,0);
			$pdf->Cell(59 ,10,'nr. '.$ref,0,1);
			$pdf->Cell(59 ,10,'',0,1);

			$pdf->SetFont('Times','BU',15);
			$pdf->Cell(70 ,7,'Sprzedawca',0,0);
			$pdf->Cell(59 ,5,'',0,0);
			$pdf->Cell(59 ,7,'Nabywca',0,1);

			$pdf->SetFont('Times','',10);
			$pdf->Cell(110 ,5,'IT World',0,0);
			$pdf->Cell(30 ,5,'ID Klienta:',0,0);
			$pdf->Cell(34 ,5,$_SESSION["username"],0,1);
			$pdf->Cell(110 ,5,'Wrocław, Serwisantów 12',0,0);
			$pdf->Cell(30 ,5,'Data Wystawienia:',0,0);
			$pdf->Cell(40 ,5,date("d.m.Y H:i:s"),0,1);
			$pdf->Cell(110 ,5,'helpdesk@IT_World',0,0);
			$pdf->Cell(30 ,5,'Email: ',0,0);
			$pdf->Cell(34 ,5,$_SESSION["email"],0,1); 
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(30 ,5,'Nr konta: 40 0874 9852 XXXX 3258 XXXX 7539',0,1);
			$pdf->Cell(30 ,5,'Termin zapłaty: '.date('d.m.Y', strtotime(date("Y-m-d"). ' + 14 days')),0,1);
			$pdf->Cell(59 ,5,'',0,0);
			$pdf->Cell(189 ,10,'',0,1);
			$pdf->Cell(50 ,10,'',0,1);

			$pdf->SetFont('Times','',10);
			$pdf->Cell(10 ,6,'ID',1,0,'C');
			$pdf->Cell(80 ,6,'Nazwa',1,0,'C');
			$pdf->Cell(18 ,6,'Ilość',1,0,'C');
			$pdf->Cell(39 ,6,'Koszt za sztukę [Brutto]',1,0,'C');
			$pdf->Cell(40 ,6,'Koszt całkowity [Brutto]',1,1,'C');

			if(isset($_SESSION["cart"]))
			{
				$total_price = 0;
				$a = 1;
				foreach ($_SESSION["cart"] as $product)
				{		
					$pdf->SetFont('Times','',10);
					$pdf->Cell(10 ,6,$a++,1,0,'C');
					$pdf->Cell(80 ,6,$product['name'],1,0,'C');
					$pdf->Cell(18 ,6,$product["quantity"],1,0,'C');
					$pdf->Cell(39 ,6,$product["price"].' zł',1,0,'C');
					$pdf->Cell(40 ,6,sprintf("%.2f",$product["price"]*$product["quantity"]).' zł',1,1,'C');  
					$total_price += ($product["price"]*$product["quantity"]);
				}
				$pdf->Cell(118 ,6,'',0,0);
				$pdf->Cell(29 ,6,'Podsumowanie:',0,0);
				$pdf->Cell(40 ,6,sprintf("%.2f", $total_price).' zł',1,1,'C'); 
			}
			$pdf->Cell(30 ,10,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(30 ,5,'Metoda:  Przelew',0,1);
			$pdf->SetFont('Times','U',15);
			$pdf->Cell(30 ,3,'',0,1);
			$pdf->Cell(10 ,7,'Razem do Zapłaty: '.sprintf("%.2f", $total_price).' zł',0,1);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(10 ,5,'Kwota słownie: '.Generate::numberToText($total_price).' złotych',0,1);
			$pdf->Output("F", "../../Invoice/".$ref.".pdf");
		}
		public static function numberToText($liczba) 
		{
			
			$separator = ' ';
			$jednosci = array('', ' jeden', ' dwa', ' trzy', ' cztery', ' pięć', ' sześć', ' siedem', ' osiem', ' dziewięć');
			$nascie = array('', ' jedenaście', ' dwanaście', ' trzynaście', ' czternaście', ' piętnaście', ' szesnaście', ' siedemnaście', ' osiemnaście', ' dziewietnaście');
			$dziesiatki = array('', ' dziesieć', ' dwadzieścia', ' trzydzieści', ' czterdzieści', ' pięćdziesiąt', ' sześćdziesiąt', ' siedemdziesiąt', ' osiemdziesiąt', ' dziewięćdziesiąt');
			$setki  = array('', ' sto', ' dwieście', ' trzysta', ' czterysta', ' pięćset', ' sześćset', ' siedemset', ' osiemset', ' dziewięćset');
			$grupy = array(
				array('' ,'' ,''),
				array(' tysiąc' ,' tysiące' ,' tysięcy'),
				array(' milion' ,' miliony' ,' milionów'),
				array(' miliard',' miliardy',' miliardów'),
				array(' bilion' ,' biliony' ,' bilionów'),
				array(' biliard',' biliardy',' biliardów'),
				array(' trylion',' tryliony',' trylionów')
			);
		
			$wynik = ''; $znak = '';
			if ($liczba == 0)
				return 'zero';
			if ($liczba < 0) 
			{
				$znak = 'minus';
				$liczba = -$liczba;
			}
			$g = 0;
			while ($liczba > 0) {
		
		
				$s = floor(($liczba % 1000)/100);
				$n = 0;
				$d = floor(($liczba % 100)/10);
				$j = floor($liczba % 10);
		
		
				if ($d == 1 && $j>0) {
					$n = $j;
					$d = $j = 0;
				}
		
				$k = 2;
				if ($j == 1 && $s+$d+$n == 0)
					$k = 0;
				if ($j == 2 || $j == 3 || $j == 4)
					$k = 1;
		
				if ($s+$d+$n+$j > 0)
					$wynik = $setki[$s].$dziesiatki[$d].$nascie[$n].$jednosci[$j].$grupy[$g][$k].$wynik;
		
				$g++;
				$liczba = floor($liczba/1000);
			}
			return trim($znak.$wynik);
		}	
	}
	class Mail 
	{
		public static function SendConfirmation($ref)
		{
			require_once "../Classes/Classess.php";
			require "../../vendor/autoload.php";
			if(!isset($_SESSION["email"]) || !isset($_SESSION["username"]) || !isset($_SESSION["loggedin"]) || !isset($_SESSION["userId"]))
			{
				header("location: ../../index.php");
			}
			else 
			{
				$username = $_SESSION["username"];
				$email = $_SESSION["email"];
				$name = "noreply@IT_World";
				$subject = '=?UTF-8?B?'.base64_encode("Potwierdzenie Zamówienia").'?=';
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
					<p> Dziękujemy za zakup produktów w IT World</p>
					<br/>
					<p> ID zamówienia".$ref."</p>
					<p>Na dokonanie wpłaty wyznaczyliśmy 14 dni od daty zakupu</p>
					<p>Realizacja zamówienia nastąpi po zaksięgowaniu wpłaty</p>
					<p></p>
					<p></p>
					<p>Pozdrawiamy zespół IT World</p>
					<br/>
					</body>";

				$mail = new PHPMailer(true);
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				$mail->Port = 587;
				$mail->Username = "kkorzeniowski.it@gmail.com";
				$mail->Password = "jwkgzgfklfmamdxt";
				$mail->addAttachment("../../Invoice/".$ref.".pdf");
				$mail->IsHTML(true);
				$mail->setFrom($email, $name);
				$mail->addAddress($email, "@NoReply");
				$mail->Subject = $subject;
				$mail->Body = $message;
				$mail->send(); 
			}
		}
	}
	class Database 
	{
		public static function ChangePass($email,$password)
		{
			require_once "../Scripts/Config.php";

			if(empty($email) || empty($password)|| is_null($email))
			{
				return false;
			} 	
				$sql = "SELECT email FROM users WHERE email = '$email'";
				if($stmt = mysqli_prepare($link, $sql))
				{
					if($stmt->execute())
					{
						$stmt->store_result();
						if($stmt->num_rows == 1)
						{
							$value = $email;
						} 
						else
						{
							echo "email not found";
							return false;
						}
					} 
					else
					{
						echo "Oops! Something went wrong. Please try again later. pierwsze";
					}
					$stmt->close();
				}
			 
			if(!empty($value) || is_null($value))
			{
				$sql = "UPDATE users
				SET password = ?
				WHERE email = ?";
				if($stmt = mysqli_prepare($link, $sql))
				{
					$stmt->bind_param("ss", $param_password, $param_email);
					$param_email = $value;
					$param_password = password_hash($password, PASSWORD_DEFAULT);
					if($stmt->execute())
					{
						header("location: ../Pages/Login.php");
					} 
					else
					{
						echo "Oops! $link->error";
					}
					$stmt->close();
				}
			}
			$link->close();
		}
		public static function AddOrder($ref)
		{
			session_start();
			require "../Scripts/Config.php";
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
			{
				header("location: ../../index.php");
			}
			else 
			{	
				$sql = "INSERT INTO orders (invoice, userid, price, status) VALUES (?, ?, ?, ?)";
				if($stmt = mysqli_prepare($link, $sql))
				{
					$stmt->bind_param("siss", $param_invoice, $param_userid, $param_price, $param_status);
					$param_invoice = $ref;
					$param_userid = $_SESSION["userId"];
					$param_price = sprintf("%.2f", $_SESSION["total_price"]);
					$param_status = "nie_opłacony";
					if($stmt->execute())
					{
						echo "success";
					} 
					else
					{
						echo "Oops! $link->error";
					}
					$stmt->close();
				}		
				$link->close();
				
			}
		}
		public static function AddOrder_details($ref)
		{	
			session_start();
			require "../Scripts/Config.php";
			if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
			{
				header("location: ../../index.php");
			}
			else 
			{
				foreach ($_SESSION["cart"] as $product) 
				{
					$sql = "INSERT INTO order_details (orderID, productID, price) VALUES (?, ?, ?)";
					if($stmt = mysqli_prepare($link, $sql))
					{
						$stmt->bind_param("iis", $param_order, $param_product, $param_price);
						$param_order = Database::FindOrder($ref);
						$param_product = $product["id"];
						$param_price = sprintf("%.2f", $product["price"]*$product["quantity"]);
						if($stmt->execute())
						{
							echo "success";
						} 
						else
						{
							echo "Oops! $link->error";
						}
						
					}
					$stmt->close();		
				}
				$link->close();
			}
		}
		public static function FindOrder($ref) 
		{
			require "../Scripts/Config.php";
			$query="SELECT id FROM orders WHERE invoice = '".$ref."'";
    		$query = mysqli_query($link,$query);
    		$task = mysqli_fetch_assoc($query);
    		$result = $task['id'];
			if(!empty($result))
			{
				return $result;
			}
			else
			{
				return false;
			}
    		mysqli_close($link);
		}
		public static function CheckUser($email) 
		{
			require_once "../Scripts/Config.php";
			$query="SELECT username FROM users WHERE email = '".$email."'";
    		$query = mysqli_query($link,$query);
    		$task = mysqli_fetch_assoc($query);
    		$result = $task['username'];
			if(!empty($result))
			{
				return $result;
			}
			else
			{
				return false;
			}
    		mysqli_close($link);
		}
	}
	class Website
	{
		public static function Logout() 
		{
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
		}
	}
