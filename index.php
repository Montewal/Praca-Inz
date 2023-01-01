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
                        echo("<a href='Website/Pages/Login.php' class='button'> Logowanie </a>". 
                             "<a href='Website/Pages/Register.php' class='button'> Rejestracja </a>");
                            
                    }
                    else
                    {
                        echo("<a class='button' href='/Website/Scripts/Logout.php'> Wyloguj </a>". 
                             "<a class='button' href='#'> Koszyk </a>");
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
                        echo("<li> <a href='/Website/Pages/Shop.php'> Sklep </a> </li>");   
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
                   <p>IT_World to firma stworzona z pasji do technologii </p>
                </div>
            </div>
        </div>
        <div class="footer">

        </div>    
    </div> 
</body>
</html>