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
    <link rel="stylesheet" href="../Content/CSS/cart.css" />
    <link rel="stylesheet" href="../Content/CSS/menu.css" />
    <link rel="stylesheet" href="../Content/CSS/page.css" />
    <link rel="stylesheet" href="../Content/CSS/pricing.css" />
    <style>

    </style>
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
                    <li> <a href="Calculator.php"> Monitoring </a> </li>

                    <?php
                    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){}else 
                    {
                        echo("<li> <a href='Shop.php'> Sklep </a> </li>");   
                    }
                    ?>           
                </ul>         
            </header>
        </div>
        <div class="content-2" style='height:1700px; overflow-y:hidden;'>
            <div class="content-allign">
                <div class="content-text">
                    <h1>Cennik dla laptopów</h1>
                    <table class="pricing">
                        <tr><th>Usługa:</th><th>Cena:</th></tr>
                        <tr><td>Instalacja, reinstalacja oraz aktualizacja systemu operacyjnego Microsoft Windows (8,10,11)</td><td>130</td></tr>
                        <tr><td>Instalacja, reinstalacja systemu Mac Os</td><td>170</td></tr>
                        <tr><td>Odzyskiwanie danych</td><td>170</td></tr>
                        <tr><td>Formatowanie dysku, ustawienie partycji</td><td>70</td></tr>
                        <tr><td>Instalacja sterowników</td><td>60</td></tr>
                        <tr><td>Reballing, wymiana układu BGA</td><td>400</td></tr>
                        <tr><td>Optymalizacja, naprawa systemu Windows</td><td>100</td></tr>
                        <tr><td>Wymiana matrycy</td><td>80</td></tr>
                        <tr><td>Wymiana klawiatury</td><td>70</td></tr>
                        <tr><td>Wymiana zawiasów</td><td>90</td></tr>
                        <tr><td>Wymiana gniazda zasilającego</td><td>110</td></tr>
                        <tr><td>Wymiana DVD</td><td>30</td></tr>
                        <tr><td>Wymiana, naprawa obudowy</td><td>120</td></tr>
                        <tr><td>Wymiana touchpada</td><td>90</td></tr>
                        <tr><td>Naprawa/wymiana płyty głównej</td><td>220/140</td></tr>
                        <tr><td>Naprawa gniazda USB, LAN, AUDIO, VGA</td><td>140</td></tr>
                        <tr><td>Rozbudowa/wymiana pamięci RAM</td><td>50</td></tr>
                        <tr><td>Aktualizacja BIOS</td><td>80</td></tr>
                        <tr><td>Wymiana baterii BIOS</td><td>60</td></tr>
                        <tr><td>Usuwanie wirusów lub zbędnego oprogramowania</td><td>110</td></tr>
                        <tr><td>Czyszczenie z kurzu i brudu, wymiana pasty termoprzewodzącej</td><td>140</td></tr>
                        <tr><td>Czyszczenie laptopa po zalaniu</td><td>190</td></tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="content-2" style='height:1700px; overflow-y:hidden;'>
            <div class="content-allign">
                <div class="content-text">
                    <h1>Cennik dla komputerów stacjonarnych</h1>
                    <table class="pricing">
                        <tr><th>Usługa:</th><th>Cena:</th></tr>
                        <tr><td>Instalacja, reinstalacja oraz aktualizacja systemu operacyjnego Microsoft Windows (8, 10, 11)</td><td>130</td></tr>
                        <tr><td>Odzyskiwanie danych</td><td>170</td></tr>
                        <tr><td>Instalacja pojedyńczego programu</td><td>30</td></tr>
                        <tr><td>Formatowanie dysku, ustawienie partycji</td><td>60</td></tr>
                        <tr><td>Instalacja sterowników</td><td>60</td></tr>
                        <tr><td>Optymalizacja systemu</td><td>100</td></tr>
                        <tr><td>Złożenie kompletnego komputera</td><td>170</td></tr>
                        <tr><td>Wymiana podzespołów</td><td>60</td></tr>
                        <tr><td>Wymiana płyty głównej</td><td>150</td></tr>
                        <tr><td>Wymiana obudowy</td><td>160</td></tr>
                        <tr><td>Naprawa gniazda USB, LAN, AUDIO, VGA</td><td>110</td></tr>
                        <tr><td>Rozbudowa/wymiana pamięci RAM</td><td>40</td></tr>
                        <tr><td>Aktualizacja BIOS</td><td>80</td></tr>
                        <tr><td>Wymiana bateri BIOS</td><td>50</td></tr>
                        <tr><td>Usuwanie wirusów lub zbędnego oprogramowania</td><td>100</td></tr>
                        <tr><td>Czyszczenie z kurzu i brudu, wymiana pasty termoprzewodzącej</td><td>140</td></tr>
                    </table>
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