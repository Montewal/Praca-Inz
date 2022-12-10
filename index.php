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
    <link rel="stylesheet" href="Website/Content/CSS/menu.css" />
    <link rel="stylesheet" href="Website/Content/CSS/page.css" />
    <script>

        
        $(document).ready(function()
        {
            $("li").mouseenter(function()
            {
                $(this).children('ul').css("display", "block");
            });
            $("li").mouseleave(function()
            {
                $(this).children('ul').css("display", "none");
            }); 
        });
        
    </script>
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
                        //echo("<a href='/Website/Scripts/Login.php' class='button'> Logowanie </a>". 
                           // "<a href='/Website/Scripts/Register.php' class='button'> Rejestracja </a>");
                            echo("<a class='button'> Koszyk </a>". 
                                 "<a class='button'> Profil </a>");
                    }
                    else
                    {
                        
                    }
                ?>
                
                <ul class="menu">
                    <li> <a href="#"> Serwis </a> </li>
                    <li> <a href="#"> Usługi </a> </li>
                    <li> <a href="#"> Cennik </a> </li>
                    <li> <a href="#"> Kontakt </a> </li>
                    <li> <a href="#"> Sklep </a> </li>
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
                   <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi vitae suscipit tellus mauris a. Sed libero enim sed faucibus turpis in eu mi bibendum. Luctus accumsan tortor posuere ac ut. Pellentesque elit ullamcorper dignissim cras tincidunt. In eu mi bibendum neque egestas. Mauris pellentesque pulvinar pellentesque habitant. Volutpat odio facilisis mauris sit amet massa vitae tortor. Posuere morbi leo urna molestie at. Sed lectus vestibulum mattis ullamcorper velit. Lacus suspendisse faucibus interdum posuere lorem. Ac turpis egestas sed tempus urna et pharetra pharetra massa. Euismod nisi porta lorem mollis. Eget sit amet tellus cras adipiscing enim eu turpis egestas. Vitae elementum curabitur vitae nunc. Pretium aenean pharetra magna ac. Malesuada fames ac turpis egestas integer eget aliquet nibh praesent.</p>
                </div>
            </div>
        </div>
        <div class="footer">

        </div>    
    </div> 
</body>
</html>