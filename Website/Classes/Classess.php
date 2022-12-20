<?php
	class Generate
	{
		public static function RandomPass() 
		{
			$range = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$rand = str_shuffle($range);
			$cut = substr($rand,0,10);
			return $cut;
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
				$sql = "SELECT email FROM users WHERE email = '".$email."'";
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
		public static function CheckUser($email) 
		{
			require "../Scripts/Config.php";
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
