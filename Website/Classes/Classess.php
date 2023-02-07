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
			$signature = '../Content/Pictures/Podpis.png';

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
			$pdf->Cell(110 ,5,'NIP: 981-126-00-23',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(30 ,5,'Nr konta: 40 0874 9852 XXXX 3258 XXXX 7539',0,1);
			$pdf->Cell(30 ,5,'Termin zapłaty: '.date('d.m.Y', strtotime(date("Y-m-d"). ' + 14 days')),0,1);
			$pdf->Cell(59 ,5,'',0,0);
			$pdf->Cell(189 ,10,'',0,1);
			$pdf->Cell(50 ,10,'',0,1);

			$pdf->SetFont('Times','',10);
			$pdf->Cell(6 ,6,'ID',1,0,'C');
			$pdf->Cell(80 ,6,'Nazwa',1,0,'C');
			$pdf->Cell(10 ,6,'Ilość',1,0,'C');
			$pdf->Cell(20 ,6,'Cena Netto',1,0,'C');
			$pdf->Cell(24 ,6,'Wartość netto',1,0,'C');
			$pdf->Cell(10 ,6,'VAT',1,0,'C');
			$pdf->Cell(20 ,6,'Kwota VAT',1,0,'C');
			$pdf->Cell(24 ,6,'Wartość brutto',1,1,'C');

			if(isset($_SESSION["cart"]))
			{
				$VAT = $netto = $netto_val = $total_price = 0;
				$a = 1;
				foreach ($_SESSION["cart"] as $product)
				{	
					$netto = sprintf("%.2f",round($product["price"] / 1.23,2));	
					$netto_val = round(($product["price"] / 1.23)*$product["quantity"],2);
					$VAT = round(($product["price"]*$product["quantity"]) - (($product["price"] / 1.23)*$product["quantity"]),2);
					$pdf->SetFont('Times','',10);
					$pdf->Cell(6 ,6,$a++,1,0,'C');
					$pdf->Cell(80 ,6,$product['name'],1,0,'C');
					$pdf->Cell(10 ,6,$product["quantity"],1,0,'C');
					$pdf->Cell(20 ,6,$netto.' zł',1,0,'C');
					$pdf->Cell(24 ,6,$netto_val.' zł',1,0,'C'); 
					$pdf->Cell(10 ,6,'23%',1,0,'C');
					$pdf->Cell(20 ,6,sprintf("%.2f",$VAT).' zł',1,0,'C');
					$pdf->Cell(24 ,6,sprintf("%.2f",$product["price"]*$product["quantity"]).' zł',1,1,'C');     
					$total_price += ($product["price"]*$product["quantity"]);
				}
				$pdf->Cell(118 ,6,'',0,0);
				$pdf->Cell(52 ,6,'Podsumowanie:',0,0);
				$pdf->Cell(24 ,6,sprintf("%.2f", $total_price).' zł',1,1,'C'); 
			}
			$pdf->Cell(30 ,10,'',0,1);
			$pdf->SetFont('Times','B',12);
			$pdf->Cell(30 ,5,'Metoda:  Przelew',0,1);
			$pdf->SetFont('Times','U',15);
			$pdf->Cell(30 ,3,'',0,1);
			$pdf->Cell(10 ,7,'Razem do Zapłaty: '.sprintf("%.2f", $total_price).' zł',0,1);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(10 ,5,'Kwota słownie: '.Generate::NumberToText($total_price).' złotych',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(30 ,5,'',0,0);
			$pdf->Cell(100 ,5,'',0,0);
			$pdf->Cell(30 ,5,$pdf->Image($signature, $pdf->GetX(), $pdf->GetY(), -200),0,0);
			
			$pdf->Cell(110 ,5,'',0,1);
			
			$pdf->Cell(110 ,5,'',0,1);
			$pdf->Cell(110 ,5,'',0,1);
			
			$pdf->SetFont('Times','U',20);
			$pdf->Cell(30 ,5,'                                       ',0,0);
			$pdf->Cell(80 ,5,'',0,0);
			$pdf->Cell(30 ,5,'                                           ',0,1);
			$pdf->SetFont('Times','',10);
			$pdf->Cell(30 ,5,'Podpis osoby upoważnionej do odbioru faktury',0,0);
			$pdf->Cell(80 ,5,'',0,0);
			
			$pdf->Cell(30 ,5,'Podpis osoby upoważnionej do Wystawienia faktury',0,1);

			$pdf->Output("F", "../../Invoice/".$ref.".pdf");
		}
		public static function NumberToText($num) 
		{
			$unit = array('', ' jeden', ' dwa', ' trzy', ' cztery', ' pięć', ' sześć', ' siedem', ' osiem', ' dziewięć');
			$unit_addon = array('', ' jedenaście', ' dwanaście', ' trzynaście', ' czternaście', ' piętnaście', ' szesnaście', ' siedemnaście', ' osiemnaście', ' dziewietnaście');
			$tens = array('', ' dziesieć', ' dwadzieścia', ' trzydzieści', ' czterdzieści', ' pięćdziesiąt', ' sześćdziesiąt', ' siedemdziesiąt', ' osiemdziesiąt', ' dziewięćdziesiąt');
			$hundreds  = array('', ' sto', ' dwieście', ' trzysta', ' czterysta', ' pięćset', ' sześćset', ' siedemset', ' osiemset', ' dziewięćset');
			$groups = array(
				array('' ,'' ,''),
				array(' tysiąc' ,' tysiące' ,' tysięcy'),
				array(' milion' ,' miliony' ,' milionów'),
				array(' miliard',' miliardy',' miliardów'),
				array(' bilion' ,' biliony' ,' bilionów'),
				array(' biliard',' biliardy',' biliardów'),
				array(' trylion',' tryliony',' trylionów')
			);
		
			$result = ''; $char = '';
			if ($num == 0)
				return 'zero';
			if ($num < 0) 
			{
				$char = 'minus';
				$num = -$num;
			}
			$g = 0;
			while ($num > 0) {
		
		
				$h = floor(($num % 1000)/100);
				$ua = 0;
				$t = floor(($num % 100)/10);
				$u = floor($num % 10);
		
		
				if ($t == 1 && $u>0) {
					$ua = $u;
					$t = $u = 0;
				}
		
				$i = 2;
				if ($u == 1 && $h+$t+$ua == 0)
					$i = 0;
				if ($u == 2 || $u == 3 || $u == 4)
					$i = 1;
		
				if ($h+$t+$ua+$u > 0)
					$result = $hundreds[$h].$tens[$t].$unit_addon[$ua].$unit[$u].$groups[$g][$i].$result;
		
				$g++;
				$num = floor($num/1000);
			}
			return trim($char.$result);
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
				$hubject = '=?UTF-8?B?'.base64_encode("Potwierdzenie Zamówienia").'?=';
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
					<p> identyfikator zamówienia: ".$ref."</p>
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
				$mail->Subject = $hubject;
				$mail->Body = $message;
				$mail->send(); 
			}
		}
	}
	class Database 
	{
		public static function ChangePass($email,$password)
		{
			require "../Scripts/Config.php";

			if(empty($email) || empty($password)|| is_null($email))
			{
				return false;
			} 	
				$query = "SELECT email FROM users WHERE email = ?";
				if($task = mysqli_prepare($link, $query))
				{
					$task->bind_param("s", $bind_email);
                	$bind_email = $email;
					if($task->execute())
					{
						$task->store_result();
						if($task->num_rows == 1)
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
					$task->close();
				}
			 
			if(!empty($value) || is_null($value))
			{
				$query = "UPDATE users
				SET password = ?
				WHERE email = ?";
				if($task = mysqli_prepare($link, $query))
				{
					$task->bind_param("ss", $bind_password, $bind_email);
					$bind_email = $value;
					$bind_password = password_hash($password, PASSWORD_DEFAULT);
					if($task->execute())
					{
						header("location: ../Pages/Login.php");
					} 
					else
					{
						echo "Oops! $link->error";
					}
					$task->close();
				}
			}
			$link->close();
		}
		public static function ChangePassForLoggedUser($email,$password)
		{
			require "../Scripts/Config.php";

			if(empty($email) || empty($password)|| is_null($email))
			{
				return false;
			} 	
				$query = "SELECT email FROM users WHERE email = ?";
				if($task = mysqli_prepare($link, $query))
				{
					$task->bind_param("s", $bind_email);
                	$bind_email = $email;
					if($task->execute())
					{
						$task->store_result();
						if($task->num_rows == 1)
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
					$task->close();
				}
			 
			if(!empty($value) || is_null($value))
			{
				$query = "UPDATE users
				SET password = ?
				WHERE email = ?";
				if($task = mysqli_prepare($link, $query))
				{
					$task->bind_param("ss", $bind_password, $bind_email);
					$bind_email = $value;
					$bind_password = password_hash($password, PASSWORD_DEFAULT);
					if($task->execute())
					{
						
					} 
					else
					{
						echo "Oops! $link->error";
					}
					$task->close();
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
				$query = "INSERT INTO orders (invoice, userid, price, status) VALUES (?, ?, ?, ?)";
				if($task = mysqli_prepare($link, $query))
				{
					$task->bind_param("siss", $bind_invoice, $bind_userid, $bind_price, $bind_status);
					$bind_invoice = $ref;
					$bind_userid = $_SESSION["userId"];
					$bind_price = sprintf("%.2f", $_SESSION["total_price"]);
					$bind_status = "nie_opłacony";
					if($task->execute())
					{
						echo "success";
					} 
					else
					{
						echo "Oops! $link->error";
					}
					$task->close();
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
					$query = "INSERT INTO order_details (orderID, productID, price) VALUES (?, ?, ?)";
					if($task = mysqli_prepare($link, $query))
					{
						$task->bind_param("iis", $bind_order, $bind_product, $bind_price);
						$bind_order = Database::FindOrder($ref);
						$bind_product = $product["id"];
						$bind_price = sprintf("%.2f", $product["price"]*$product["quantity"]);
						if($task->execute())
						{
							echo "success";
						} 
						else
						{
							echo "Oops! $link->error";
						}
						
					}
					$task->close();		
				}
				$link->close();
			}
		}
		public static function FindOrder($ref) 
		{
			require "../Scripts/Config.php";
			$query="SELECT id FROM orders WHERE invoice = ?";
			if($task = mysqli_prepare($link, $query))
            {
                $task->bind_param("s", $bind_invoice);
                $bind_invoice = $ref;
				if($task->execute())
                {
					$task->bind_result($result);
    				if($task->fetch())
					{
						return $result;
					}
					else
					{
						return false;
					}
				}
			}
    		mysqli_close($link);
		}
		public static function CheckUser($email) 
		{
			require "../Scripts/Config.php";
			$query="SELECT username FROM users WHERE email = ?";
			if($task = mysqli_prepare($link, $query))
            {
                $task->bind_param("s", $bind_email);
                $bind_email = $email;
				if($task->execute())
                {
					$task->bind_result($result);
    				if($task->fetch())
					{
						return $result;
					}
					else
					{
						return false;
					}
				}
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
