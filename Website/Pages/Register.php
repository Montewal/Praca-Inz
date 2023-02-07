<?php
    require_once "../Scripts/Config.php";
    $username = $password = $email = $confirm_password = "";
    $username_err = $password_err = $email_err = $confirm_password_err = "";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(empty(trim($_POST["username"])))
        {
            $username_err = "Proszę podać nazwę użytkownika.";
        } 
        else
        {
            $query = "SELECT id FROM users WHERE username = ?";
            if($task = mysqli_prepare($link, $query))
            {
                $task->bind_param("s", $bind_username);
                $bind_username = trim($_POST["username"]);
                if($task->execute())
                {
                    $task->store_result();
                    if($task->num_rows == 1)
                    {
                        $username_err = "Ten użytkownik już istnieje.";
                    } 
                    else
                    {
                        $username = trim($_POST["username"]);
                    }
                } 
                else
                {
                    echo "Oops! coś poszło nie tak";
                }
                $task->close();
            }
        }

        if(empty(trim($_POST["password"])))
        {
            $password_err = "Proszę podać hasło.";
        } 
        elseif(strlen(trim($_POST["password"])) < 8)
        {
            $password_err = "Hasło musi zawierać conajmniej 8 znaków.";
        } 
        else
        {
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = "Proszę potwierdzić hasło.";
        } 
        else
        {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password))
            {
                $confirm_password_err = "Hasła nie są identyczne.";
            }
        }

        if(empty(trim($_POST["email"])))
        {
            $email_err = "Proszę podać mail.";
        } 
        else
        {
            $query = "SELECT id FROM users WHERE email = ?";
            if($task = mysqli_prepare($link, $query))
            {
                $task->bind_param("s", $bind_email);
                $bind_email = trim($_POST["email"]);
                if($task->execute())
                {
                    $task->store_result();
                    if($task->num_rows == 1)
                    {
                        $email_err = "Ten mail jest już w użytku.";
                    } 
                    else
                    {
                        $email = trim($_POST["email"]);
                    }
                } 
                else
                {
                    echo "Oops! coś poszło nie tak";
                }
                $task->close();
            }
        }

        if(empty($username_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err))
        {
            $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            if($task = mysqli_prepare($link, $query))
            {
                $task->bind_param("sss", $bind_username, $bind_email, $bind_password);
                $bind_username = $username;
                $bind_email = $email;
                $bind_password = password_hash($password, PASSWORD_DEFAULT);
                if($task->execute())
                {
                    header("location: Login.php");
                } 
                else
                {
                    echo "Oops! $link->error";
                }
                $task->close();
            }
        }
        $link->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="../Content/Pictures/world.png" />
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarejestruj się</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Content/CSS/login-system.css" /> 
</head>
<body>
    <div class="back"></div> 
    <div class="container">
        <div class="allign">
            <div class="formcenter">
                <div class="formbackgroundreg">
                    <div class="form">
                        <div class="insideform">
                            <h3>Zarejestruj konto w IT World</h3>        
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
                                    <input type="submit" class="btn" value="Zarejestruj się">
                                    <input type="reset" class="btn" value="Resetuj">
                                    <p>Masz już konto? zaloguj się <a href="Login.php">tutaj</a>.</p>
                                    </br>
                                </div>   
                            </form>
                        </div>
                    </div> 
                </div>                       
            </div>
        </div> 
    </div>  
</body>
</html>