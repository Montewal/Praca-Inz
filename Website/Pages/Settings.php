<?php
    session_start();
    require_once "../Scripts/Config.php";
    $password = $confirmation = $confirm_password = "";
    $password_err = $confirm_password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty(trim($_POST["password"])))
        {
            $password_err = "Please enter a password.";
        } 
        elseif(strlen(trim($_POST["password"])) < 8)
        {
            $password_err = "Password must have atleast 8 characters.";
        } 
        else
        {
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = "Please confirm password.";
        } 
        else
        {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password))
            {
                $confirm_password_err = "Password did not match.";
            }
        }

        if(empty($password_err) && empty($confirm_password_err))
        {
            $sql = "update users set password = ? where email = ?";
            if($stmt = mysqli_prepare($link, $sql))
            {
                $stmt->bind_param("ss", $param_email, $param_password);
                $param_email = $_SESSION["username"];
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                if($stmt->execute())
                {
                    $confirmation = "Hasło pomyślnie zmienione";
                    header("location: Settings.php");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="terminal/pictures/Favicon.ico" />
    <meta charset="UTF-8" /> 
    <title>IT World</title>
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
        <div class="content-2">
            <div class='margin'></div>     
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">          
                    <div class="form-group">
                    <h3>Zmień hasło</h3></br>
                        <input type="password" name="password"  placeholder="Wpisz hasło" class="form-style <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span></br></br>
                        <input type="password" name="confirm_password" placeholder="Potwierdź hasło" class="form-style <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span></br></br>
                        <input type="submit" class="btn btn-primary" value="Wyślij">
                        <span class="success-feedback"><?php echo $confirmation; ?></span>
                        </br>
                    </div>   
                </form>
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