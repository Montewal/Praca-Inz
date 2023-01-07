<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="terminal/pictures/Favicon.ico" />
    <meta charset="UTF-8" /> 
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Content/CSS/cart.css" />
    <link rel="stylesheet" href="../Content/CSS/menu.css" />
    <link rel="stylesheet" href="../Content/CSS/page.css" />
    <link rel="stylesheet" href="../Content/CSS/calc.css" /> 
    <script src="../Content/JS/calc.js"></script>
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
    <div class="form-group">
        <label for="pxwidth">Szerokość w pikselach</label></br>
        <input type="text" id="pxwidth" class="form-style" name="pxwidth"></br>
        <label for="pxheight">Wysokość w pikselach :</label></br>
        <input type="text" id="pxheight" class="form-style" name="pxheight"></br>
        <label for="fps">Ilość klatek na sekundę:</label></br>
        <input type="text" id="fps" class="form-style" name="fps"></br>
        <label for="duration-1">Czas trwania:</label></br>
        <input type="text" id="duration-1" class="form-style" name="duration-1"></br>
        <input type="button" value="Przelicz" id="calc1sub">
        <div id="result1"></div></br>   
    </div>
    </br>
    </br>
    <div class="form-group">
        <label for="bitrate">Bitrate w Megabitach na sekundę</label></br>
        <input type="text" id="bitrate" class="form-style" name="bitrate"></br>
        <label for="duration-2">Czas trwania:</label></br>
        <input type="text" id="duration-2" class="form-style" name="duration-2"></br>
        <input type="button" value="przelicz" id="calc2sub">
        <div id="result2"></div></br>
    </div>
</body>
</html>