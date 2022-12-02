<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="terminal/pictures/Favicon.ico" />
    <meta charset="UTF-8" /> 
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../Content/CSS/display_login.css" />
</head>
<body>
    <div class="back">    </div> 
        <div class="container">
            <div class="allign">
                <div class="formcenter">
                    <div class="formbackground">
                        <div class="form">
                            <div class="insideform">
                            <h4>Login Account</h4>
                            <?php
                            if(!empty($login_err))
                            {
                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                            }
                            if(!empty($status_err))
                            {
                                echo '<div class="alert alert-danger">' . $status_err . '</div>';
                            }
                            if(!empty($status2_err))
                            {
                                echo '<div class="alert alert-danger">' . $status2_err . '</div>';
                            }
                            ?>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="searchform">
                                <div class="form-group">
                                    <input type="text" name="username" placeholder="Your Username" class="form-style <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" />
                                    <i class="input-icon uil uil-at"></i>
                                    <span class="invalid-feedback">
                                        <?php echo $username_err; ?>
                                    </span>
                                </div>
                                <div class="form-group mt-2">
                                    <input type="password" name="password" placeholder="Your Password" autocomplete="off" class="form-style <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" />
                                    <i class="input-icon uil uil-lock-alt"></i>
                                    <span class="invalid-feedback">
                                        <?php echo $password_err; ?>
                                    </span>
                                </div>
                                <br/>
                                <div class="form-group">
                                    <input type="submit" class="btn login" value="Login" onclick="Loader('loading');" />
                                    <input type="submit" class="btn sign-in" value="Sign In" onclick="Loader('loading');" />
                                    <input type="submit" class="btn-forgot password" value="Forgot Password" onclick="Loader('loading');" />
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>                       
            </div>
        </div>
</body>
</html>