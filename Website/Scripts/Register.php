<?php 
//require_once "config.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } 
    else
    {
        $sql = "SELECT id FROM users WHERE username = ?"; 
        if($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if($stmt->execute())
            {
                $stmt->store_result();               
                if($stmt->num_rows == 1)
                {
                    $username_err = "This username is already taken.";
                } 
                else
                {
                    $username = trim($_POST["username"]);
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
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
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";      
        if($stmt = $mysqli->prepare($sql))
        {
            $stmt->bind_param("ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if($stmt->execute())
            {
                header("location: login.php");
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }
    $mysqli->close();
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
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
                            <h4>Zarejestruj konto w IT World</h4>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <input type="text" name="username" placeholder="Wpisz nazwę użytkownika" class="form-style <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" placeholder="Wpisz swój email" class="form-style <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>     
                            <div class="form-group">
                                <input type="password" name="password"  placeholder="Wpisz hasło" class="form-style <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_password" placeholder="Potwierdź hasło" class="form-style <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                                <br/>
                                <br/>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Zarejestruj się">
                                <input type="reset" class="btn btn-secondary ml-2" value="Resetuj">
                                <p>Masz już konto? zaloguj się <a href="login.php">tutaj</a>.</p>
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