<?php
error_reporting(~E_WARNING);
require "../Scripts/SendMail.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Content/CSS/display_login.css" /> 
</head>
<body>
<div class="back"></div> 
        <div class="container">
            <div class="allign">
                <div class="formcenter">
                    <div class="formbackgroundreg">
                        <div class="form">
                            <div class="insideform">
                            <h4>Wyślij nowe hasło</h4>
                            <form action="../Scripts/SendMail.php" method="post">
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Wpisz swój email" class="form-style <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>     
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Generuj">
                                <input type="reset" class="btn btn-secondary ml-2" value="Resetuj">
                                <p>Powrót do logowania <a href="Login.php">tutaj</a>.</p>
                                </br>
                            </div>   
                        </form>
                        </div>
                    </div> 
                </div>                       
            </div>
        </div>   
</body>
</html>