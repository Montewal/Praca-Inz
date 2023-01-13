<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../Content/Pictures/world.png" />
    <meta charset="UTF-8" /> 
    <title>Monitoring</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Content/CSS/cart.css" />
    <link rel="stylesheet" href="../Content/CSS/menu.css" />
    <link rel="stylesheet" href="../Content/CSS/page.css" />
    <link rel="stylesheet" href="../Content/CSS/toggle-page.css" /> 
    <script src="../Content/JS/calc.js"></script>
    <script src="../Content/JS/content-pages.js"></script>
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
        <div class="content-2" style="overflow:hidden;">
            <div class='buttons'>
                <button class='toggle' name='Monitoring' >Monitoring</button>
                <button class='toggle' name='Calc-HDD' >Kalkulator HDD</button>
            </div>
            <div class='page-toggle'>
                <div class='Monitoring'>
                    <div class='margin'></div>
                    <div class="desc">
                        <h3>
                            Kamery przemysłowe IP to nowoczesne urządzenie monitoringowe
                            wyposażone we własne adresy sieciowe umożliwiają na żywo przetwarzanie oraz
                            transmisję obrazu przez sieć IP.</br></br>  Kolejnym atutem jest wideoserwer, w który zostały
                            wyposażone, dzięki którym możliwe jest śledzenie obrazu zdalnie z dowolnego urządzenie
                            podłączonego do sieci lokalnej firmy lub domowej. </br></br>Technologiczne zaawansowanie kamer IP
                            pozwala na całodobową pracę w trybie dzień/noc oraz analizy obrazu np. rozpoznawania ludzkich sylwetek.
                            </br></br>Polecamy skorzystać z naszego kalkulatora HDD, który oblicza przybliżoną wagę pliku z monitoringu
                            </br></br> Kamery IP możesz kupić <a href='shop.php'>tutaj</a>
                        </h3>
                    </div>
                </div>
                <div class='Calc-HDD'>
                    <div class='margin'></div>
                    <div class="form-group">
                        <label for="pxwidth">Szerokość [piksel]</label></br>
                        <input type="text" id="pxwidth" class="form-style" name="pxwidth"></br>
                        <label for="pxheight">Wysokość [piksel] :</label></br>
                        <input type="text" id="pxheight" class="form-style" name="pxheight"></br>
                        <label for="fps">Ilość klatek na sekundę: [fps]</label></br>
                        <input type="text" id="fps" class="form-style" name="fps"></br>
                        <label for="duration-1">Czas trwania: [w sekundach]</label></br>
                        <input type="text" id="duration-1" class="form-style" name="duration-1"></br>
                        <input type="button" value="Przelicz" id="calc1sub">
                        <div id="result1"></div>   
                    </div>
                    <div class="form-group">
                        <label for="bitrate">Bitrate w Megabitach na sekundę [Mb/s]</label></br>
                        <input type="text" id="bitrate" class="form-style" name="bitrate"></br>
                        <label for="duration-2">Czas trwania: [w sekundach]</label></br>
                        <input type="text" id="duration-2" class="form-style" name="duration-2"></br>
                        <input type="button" value="przelicz" id="calc2sub">
                        <div id="result2"></div>
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