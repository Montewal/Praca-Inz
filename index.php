<?php
    session_start();
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
    <link rel="stylesheet" href="Website/Content/CSS/cart.css" />
    <link rel="stylesheet" href="Website/Content/CSS/menu.css" />
    <link rel="stylesheet" href="Website/Content/CSS/page.css" />
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
                        echo("<a href='Website/Pages/Login.php' class='button'> Logowanie </a>". 
                             "<a href='Website/Pages/Register.php' class='button'> Rejestracja </a>");
                            
                    }
                    else
                    {
                        echo("<a class='button' href='Website/Scripts/Logout.php'><img src='Website/Content/Pictures/logout.png' width='35px' height='30px'/></a>".
                             "<a class='button' href='Website/Pages/Settings.php'><img src='Website/Content/Pictures/settings.png' width='35px' height='30px'/></a>");
                        if(!empty($_SESSION["cart"])) 
                            {
                                $cart_count = count(array_keys($_SESSION["cart"]));
                                echo ("<div class='cart_div'><a class='button' href='Website/Pages/Cart.php'>
                                <img src='Website/Content/Pictures/cart.png' width='35px' height='30px'/>
                                <span class='cart-span'>$cart_count</span></div>");                
                            }
                    }
                ?>
               
                <ul class="menu">
                    <li> <a href="Website/Pages/Service.php"> Usługi </a> </li>
                    <li> <a href="Website/Pages/Pricing.php"> Cennik </a> </li>
                    <li> <a href="Website/Pages/Calculator.php">Monitoring </a> </li>
                    <?php
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){}else 
                    {
                        echo("<li> <a href='Website/Pages/Shop.php'> Sklep </a> </li>");   
                    }
                    ?>           
                </ul>         
            </header>
        </div>
        <div class="title">
            <div class="page">
                <div class="page-description">
                    <h1>Serwis IT</h1></br>
                    <h1>Praca Inżynierska</h1></br>
                    <h1>Kamil Korzeniowski</h1>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="content-allign">
                <div class="content-text">
                   <p>Usługi Informatyczne z ofertą dla firm i indywidualnych klientów</p>
                    </br>
                    <p>Jesteśmy firmą powstałą z pasji do technologii z siedzibą we Wrocławiu. Nasza oferta zawiera szeroki zakres usług informatycznych dostarczanych w wysokiej jakości przez profesjonalny zespół</p>
                    </br>
                    <p>Możesz nam zaufać gdy potrzebujesz kompleksowaj naprawy laptopów i komputerów . Nasz zaspół zawsze stanie na wysokości zadania</p>
                    </br>
                    <p>Nasze motto to : "Wszystko można naprawić gdy posiadasz pasję"</p>
                </div>
            </div>
        </div>
        <div class="sub-title">
            <div class="page">
                <div class="page-description">
                    <h1>Czym się zajmujemy?</h1></br></br>
                    <table class='index-img'>
                        <tr>
                        <td><a href='Website/Pages/Service.php'><img class='index-img' src="Website/Content/Pictures/clint-patterson-yGPxCYPS8H4-unsplash.jpg" width='300px' height='300px'></a></td>
                        <td><a href='Website/Pages/Calculator.php'><img class='index-img' src="Website/Content/Pictures/tobias-tullius-4dKy7d3lkKM-unsplash.jpg" width='300px' height='300px'></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="footer-allign">
                <p><b>Kontakt</b></p>
                <p><img src="Website/Content/Pictures/phone.png" width='20px' height='20px'><a href="123456789"> 123456789</a></p>
                <p><img src="Website/Content/Pictures/mail.png" width='20px' height='20px'><a href="mailto:kkorzeniowski.it@gmail.com"> Wyślij do nas maila</a></p>
                <p><img src="Website/Content/Pictures/compass.png" width='20px' height='20px'><a href="https://www.google.com/maps/search/wroc%C5%82aw+Serwisant%C3%B3w+12/@51.1270151,16.9218244,12z/data=!3m1!4b1"> Serwisantów 12 Wrocław 53-343</a></p>
            </div>
        </div>    
    </div> 
</body>
</html>