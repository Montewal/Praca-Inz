<?php
namespace Classess;
session_start();
error_reporting(~E_WARNING & ~E_NOTICE);
require_once "../Scripts/Config.php";

if(isset($_POST["turn"]))
{   
    $_SESSION["page"] = $_POST['turn'];
}

$status="";
if(isset($_POST["tag"])&& $_POST['tag']!="" )
{
	$tag = $_POST['tag'];
	$result = mysqli_query($link,"SELECT * FROM products WHERE tag = '$tag' ");
	$row = mysqli_fetch_assoc($result);

    $id = $row["id"];
	$name = $row['name'];
	$tag = $row['tag'];
	$price = $row['price'];
	$img = $row['img'];

	$cartArr = array(
		$tag=>array(
        'id'=>$id,
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
    <link rel="icon" type="image/x-icon" href="../Content/Pictures/world.png" />
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>IT World</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="../Content/JS/shop_pages.js"></script>
    <link rel="stylesheet" href="../Content/CSS/cart.css" />
    <link rel="stylesheet" href="../Content/CSS/menu.css" />
    <link rel="stylesheet" href="../Content/CSS/page.css" />
</head>
<body>   
    <div class="section">
        <div class="navi">
            <header class="header">
                <a href="../../index.php" class="logo">IT World</a>  
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
                        echo("<a class='button' href='../Scripts/Logout.php'><img src='../Content/Pictures/logout.png' width='35px' height='30px'/></a>".
                             "<a class='button' href='settings.php'><img src='../Content/Pictures/settings.png' width='35px' height='30px'/></a>");
                        if(!empty($_SESSION["cart"])) 
                            {
                                $cart_count = count(array_keys($_SESSION["cart"]));
                                echo ("<div class='cart_div'><a class='button' href='cart.php'>
                                <img src='../Content/Pictures/cart.png' width='35px' height='30px'/>
                                <span class='cart-span'>$cart_count</span></div>");                
                            }
                    }
                ?>
               
               <ul class="menu">
                    <li> <a href="Service.php"> Usługi </a> </li>
                    <li> <a href="Pricing.php"> Cennik </a> </li>
                    <li> <a href="Monitoring.php"> Monitoring </a> </li>

                    <?php
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){}else 
                    {
                        echo("<li> <a href='Shop.php'> Sklep </a> </li>");   
                    }
                    ?>           
                </ul>         
            </header>
        </div>
        <div class="content-2" style='overflow-x: auto;'>
            <div class="content-allign">
                <div class="content-text" style='margin-left:20%;'>   
                    <?php
                    if(!empty($_SESSION["cart"])) 
                    {
                        $cart_count = count(array_keys($_SESSION["cart"]));
                    }
                    ?>
                
                    <?php
                    $results = array();
                    $result = mysqli_query($link,"SELECT * FROM products");
                    
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $results[] .= 
                            "<div class='product_wrapper'>
                                <form method='post' action=''>
                                    <input type='hidden' name='tag' value=".$row['tag']." />
                                    <div class='image'>
                                        <img src='".$row['img']."' width='100px' height='100px'/>
                                    </div>
                                    <table>
                                        <tr><td>
                                            <div class='name'>".$row['name']."</div>
                                        </td></tr>
                                        <tr><td>
                                            <div class='price'>".$row['price']."zł</div>
                                        </td></tr>
                                        <tr><td>
                                            <button type='submit' class='buy'> Do koszyka </button>
                                        </td></tr>
                                    </table>
                                </form>
                            </div>";
                            
                    }
                    
                    echo "<div class='pages'>";
                    for($page_nr = 0; $page_nr <= 10; $page_nr++)
                    {
                        $page = array_slice($results,(12 * $page_nr),12);
                        if(!empty($page))
                        {
                            echo "<div class='page-$page_nr'>";
                            foreach($page as $element)
                            {
                                echo $element;
                            }
                            echo "</div>";
                        }
                    }
                    echo "</div>";
                    ?>
                    <div style="clear:both;"></div>
                    <input type="hidden" class='current-page' value="<?php echo $_SESSION["page"] ;?>">
                    <div class="message">
                        <?php echo $status; ?>
                    </div>
                        
                    <div>
                              
                    <?php
                    echo "<table><tr>";
                    for($page_nr = 0; $page_nr <= 10; $page_nr++)
                    {
                        $page = array_slice($results,(12 * $page_nr),12);
                        if(!empty($page))
                        {                                
                            echo "<td><form method='post' action=''><button type='submit' class='turn' name='turn' value='$page_nr'>$page_nr</button></form></td>";
                        }
                    }
                    echo "</tr></table>";
                    mysqli_close($link);
                    ?>
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-allign">
                <p><b>Kontakt</b></p>
                <p><img src="../Content/Pictures/phone.png" width='20px' height='20px'><a href="123456789"> 123456789</a></p>
                <p><img src="../Content/Pictures/mail.png" width='20px' height='20px'><a href="mailto:kkorzeniowski.it@gmail.com"> Wyślij do nas maila</a></p>
                <p><img src="../Content/Pictures/compass.png" width='20px' height='20px'><a href="https://www.google.com/maps/search/wroc%C5%82aw+Serwisant%C3%B3w+12/@51.1270151,16.9218244,12z/data=!3m1!4b1"> Serwisantów 12 Wrocław 53-343</a></p>
            </div>
        </div>  
    </div> 
</body>
</html>