<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../Content/Pictures/world.png" />
    <meta charset="UTF-8" /> 
    <title>Serwis</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Content/CSS/cart.css" />
    <link rel="stylesheet" href="../Content/CSS/menu.css" />
    <link rel="stylesheet" href="../Content/CSS/page.css" />
    <link rel="stylesheet" href="../Content/CSS/toggle-page.css" /> 
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
                <button class='toggle' name='Laptop' >Laptopy</button>
                <button class='toggle' name='PC' >Komputery stacjonarne</button>
                <a href="mailto:"><button class='call_us'>Zamów serwis</button></a> <!-- gmail -->
            </div>
            <div class='page-toggle'>
                <div class='Laptop'>
                    <div class='margin'></div>
                    <div class="desc">
                        <h6>
                            Problemy z naprawą laptopa? Skończyła się gwarancja producenta a ty nie wiesz, jak wymienić podzespoły? Zgłoś się do nas i skorzystaj z profesjonalnych usług informatycznych! 
                            </br></br>
                            Oferujemy swoje doświadczenie w nawet najbardziej krytycznych awariach, z nami żaden problem nie straszny.
                            </br>Dzięki zespołowi informatyków z IT World nie musisz się już martwić o stan swojego laptopa.
                            </br></br>
                            <b>Dla państwa wykonamy:</b></br></br>
                            <ul class='maintenance'>
                                <li>Instalacja, reinstalacja oraz aktualizacja systemu operacyjnego Microsoft Windows (8, 10, 11)</li>
                                <li>Instalacja, reinstalacja systemu Mac Os</li>
                                <li>Odzyskiwanie danych</li>
                                <li>Formatowanie dysku, ustawienie partycji</li>
                                <li>Instalacja sterowników</li>
                                <li>Reballing, wymiana układu BGA</li>
                                <li>Optymalizacja, naprawa systemu Windows</li>
                                <li>Wymiana matrycy</li>
                                <li>Wymiana klawiatury</li>
                                <li>Wymiana zawiasów</li>
                                <li>Wymiana gniazda zasilającego</li>
                                <li>Wymiana DVD</li>
                                <li>Wymiana, naprawa obudowy</li>
                                <li>Wymiana touchpada</li>
                                <li>Naprawa/wymiana płyty głównej</li>
                                <li>Naprawa gniazda USB, LAN, AUDIO, VGA</li>
                                <li>Rozbudowa/wymiana pamięci RAM</li>
                                <li>Aktualizacja BIOS</li>
                                <li>Wymiana baterii BIOS</li>
                                <li>Usuwanie wirusów lub zbędnego oprogramowania</li>
                                <li>Czyszczenie z kurzu i brudu, wymiana pasty termoprzewodzącej</li>
                                <li>Czyszczenie laptopa po zalaniu</li>
                            </ul>
                        </h6>  
                    </div>
                </div>
                <div class='PC'>
                <div class='margin'></div>
                    <div class="desc">
                        <h6>
                            Twój komputer jest wolniejszy niż kiedyś? Programy się często zawieszają? </br></br>
                            Chciałbyś zmienić lub zbudować nowy komputer ale nie wiesz, jak wybrać optymalny i efektywny zestaw podzespołów, który wystarczyły by na długie lata?
                            Zgłoś się do nas ! </br></br>
                            Nasz doświadczony zespół  w IT World naprawi, zoptymalizuje, zmodernizuje lub zbuduje kompletnie nowy komputer z wybranych podzespołów. </br></br>
                            </br>
                            <b>Dla państwa wykonamy:</b></br></br>
                            <ul class='maintenance'>
                                <li>Instalacja, reinstalacja oraz aktualizacja systemu operacyjnego Microsoft Windows (8,10,11)</li>
                                <li>Odzyskiwanie danych</li>
                                <li>Instalacja pojedyńczego programu</li>
                                <li>Formatowanie dysku, ustawienie partycji</li>
                                <li>Instalacja sterowników</li>
                                <li>Optymalizacja systemu</li>
                                <li>Złożenie kompletnego komputera</li>
                                <li>Wymiana podzespołów</li>
                                <li>Wymiana płyty głównej</li>
                                <li>Wymiana obudowy</li>
                                <li>Naprawa gniazda USB, LAN, AUDIO, VGA</li>
                                <li>Rozbudowa/wymiana pamięci RAM</li>
                                <li>Aktualizacja BIOS</li>
                                <li>Wymiana bateri BIOS</li>
                                <li>Usuwanie wirusów lub zbędnego oprogramowania</li>
                                <li>Czyszczenie z kurzu i brudu, wymiana pasty termoprzewodzącej</li>
                            </ul>
                        </h6>
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