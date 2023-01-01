<?php
session_start();
error_reporting(~E_WARNING & ~E_NOTICE);
require_once "../Scripts/Config.php";

$status="";
if(isset($_POST["tag"])&& $_POST['tag']!="" )
{
	$tag = $_POST['tag'];
	$result = mysqli_query($link,"SELECT * FROM products WHERE tag = '$tag' ");
	$row = mysqli_fetch_assoc($result);

	$name = $row['name'];
	$tag = $row['tag'];
	$price = $row['price'];
	$img = $row['img'];

	$cartArr = array(
		$tag=>array(
		'name'=>$name,
		'price'=>$price,
		'tag'=>$tag,
		'quantity'=>1,
		'image'=>$img)
	);

	if(empty($_SESSION["cart"])) 
	{
		$_SESSION["cart"] = $cartArr;
		$status = "<div class='box'> Dodano do koszyka </div>";
	}
	else
	{
		$arr_keys = array_keys($_SESSION["cart"]);

		if(in_array($tag,$arr_keys)) 
		{
			$status = "<div class='box' style='color:red;'>
			Ten produkt już znajduje się w koszyku </div>";	
		} 
		else 
		{
			$_SESSION["cart"] = array_merge($_SESSION["cart"],$cartArr);
			$status = "<div class='box'> Dodano do koszyka </div>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="terminal/pictures/Favicon.ico" />
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>IT World</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Content/CSS/cart.css" />
    <link rel="stylesheet" href="../Content/CSS/menu.css" />
    <link rel="stylesheet" href="../Content/CSS/page.css" />
</head>
<body>   
    <div class="section">
        <div class="navi">
            <header class="header">
                <a href="index.php" class="logo">IT World</a>  
                <input class="menu-btn" type="checkbox" id="menu-btn" />
                <label class="menu-icon" for="menu-btn"> <span class="navicon"> </span> </label>
                <?php
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
                    {
                        echo("<a href='Login.php' class='button'> Logowanie </a>". 
                             "<a href='Register.php' class='button'> Rejestracja </a>");
                            
                    }
                    else
                    {
                        echo("<a class='button' href='../Scripts/Logout.php'><img src='../Content/Pictures/logout.png' width='35px' height='35px'/></a>".
                             "<a class='button' href='settings.php'><img src='../Content/Pictures/settings.png' width='35px' height='35px'/></a>");
                        if(!empty($_SESSION["cart"])) 
                            {
                                $cart_count = count(array_keys($_SESSION["cart"]));
                                echo ("<div class='cart_div'><a class='button' href='cart.php'>
                                <img src='../Content/Pictures/cart.png' width='35px' height='35px'/>
                                <span class='cart-span'>$cart_count</span></div>");                
                            }
                    }
                ?>
               
                <ul class="menu">
                    <li> <a href="#"> Serwis </a> </li>
                    <li> <a href="#"> Usługi </a> </li>
                    <li> <a href="#"> Cennik </a> </li>
                    <li> <a href="#"> Kontakt </a> </li>
                    <?php
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){}else 
                    {
                        echo("<li> <a href='Shop.php'> Sklep </a> </li>");   
                    }
                    ?>           
                </ul>         
            </header>
        </div>
        <div class="content">
            <div class="content-allign">
                <div class="content-text">   
                    <?php
                    if(!empty($_SESSION["cart"])) 
                    {
                        $cart_count = count(array_keys($_SESSION["cart"]));
                    }
                    ?>
                    
                    <?php
                    $result = mysqli_query($link,"SELECT * FROM products");
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo "<div class='product_wrapper'>
                                <form method='post' action=''>
                                    <input type='hidden' name='tag' value=".$row['tag']." />
                                    <div class='image'>
                                        <img src='".$row['img']."' width='150px' height='150px'/>
                                    </div>
                                    <div class='name'>".$row['name']."</div>
                                    <div class='price'>$".$row['price']."</div>
                                    <button type='submit' class='buy'>Kup</button>
                                </form>
                            </div>";
                    }
                    mysqli_close($link);
                    ?>
                    <div style="clear:both;"></div>
                    <div class="message_box" style="margin:10px 0px;">
                    <?php echo $status; ?>
                    </div>
            </div>
        </div>
        <div class="footer">

        </div>    
    </div> 
</body>
</html>