<?php
session_start();
error_reporting(~E_WARNING & ~E_NOTICE);
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
{
    header("location: ../../index.php");
    exit;
}
else {
    require_once "../Scripts/Config.php"; 
    $username = $password = "";
    $username_err = $password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Please enter username.";
        } 
        else
        {
            $username = trim($_POST["username"]);
        }
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        } 
        else
        {
            $password = trim($_POST["password"]);
        }
        if(empty($username_err) && empty($password_err))
        {
            $query = "SELECT id, username, email, password FROM users WHERE username = ?";
            if($task = mysqli_prepare($link, $query))
            {
                mysqli_stmt_bind_param($task, "s", $bind_username);
                $bind_username = $username;
                if(mysqli_stmt_execute($task))
                {
                    mysqli_stmt_store_result($task);
                    if(mysqli_stmt_num_rows($task) == 1)
                    {
                        mysqli_stmt_bind_result($task, $id, $username, $email, $hashed_password);
                        if(mysqli_stmt_fetch($task))
                        {
                            if(password_verify($password, $hashed_password))
                            {
                                session_start();
                                $_SESSION["loggedin"] = true;
                                $_SESSION["userId"] = strval($id);
                                $_SESSION["username"] = $username;
                                $_SESSION["email"]= $email;
                                header("location: ../../index.php");
                            }                    
                            else
                            {
                                $username_err = "Invalid username or password.";
                                $password_err = "Invalid username or password.";
                            }
                        }
                    }
                    else
                    {
                        $username_err = "Invalid username or password.";
                        $password_err = "Invalid username or password.";
                    }
                }
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                mysqli_stmt_close($task);
            }
        }
        mysqli_close($link);
    }  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="terminal/pictures/Favicon.ico" />
    <meta charset="UTF-8" /> 
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Content/CSS/login-system.css" /> 
</head>
<body>
    <div class="back">    </div> 
        <div class="container">
            <div class="allign">
                <div class="formcenter">
                    <div class="formbackground">
                        <div class="form">
                            <div class="insideform">
                            <h3>Zaloguj się do IT World</h3>
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="searchform">
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Wpisz nazwę użytkownika" class="form-style <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" />
                                    <i class="input-icon uil uil-at"></i>
                                    <span class="invalid-feedback">
                                        <?php echo $username_err; ?>
                                    </span>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="password" name="password" placeholder="Wpisz hasło" autocomplete="off" class="form-style <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" />
                                    <i class="input-icon uil uil-lock-alt"></i>
                                    <span class="invalid-feedback">
                                        <?php echo $password_err; ?>
                                    </span>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <input type="submit" class="btn login" value="Zaloguj się" />
                                    <input type="button" class="btn sign-in" value="Zarejestruj się" onClick="location.href='Register.php'" />
                                    <input type="button" class="btn-forgot password" value="Nie pamiętam hasła" onClick="location.href='Reset.php'" />
                                    <br/>
                                    <br/>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>                       
            </div>
        </div>
</body>
</html>