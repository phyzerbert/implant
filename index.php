<?php 
    require 'db.php';
    session_start();

    if (isset($_SESSION['logged_in']) == 1)
    {
        header("location: profile.php");
    }

    if (isset($_COOKIE['email']))
    {
        $_SESSION['email'] = $_COOKIE['email'];
        $_SESSION['logged_in'] = 1;
        header("location: profile.php");
    }

    if (isset($_POST['login']) && $_POST['email'] != "" && $_POST['password'] != "")
    {
        require 'login.php';
    }
    elseif (isset($_POST['register']) && $_POST['firstname'] != "" && $_POST['lastname'] != "" && $_POST['remail'] != "" && $_POST['rpassword'] != "")
    {
        require 'register.php';
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign-Up/Login Form</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style type="text/css">
    body,td,th {
	font-family: "Titillium Web", sans-serif;
}
body {
	background-image: url(img/login-bg.png);
	 background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
    </style>
    <script src="js/validation.js" type="text/javascript"></script>
    <script src="js/showpass.js" type="text/javascript"></script>
<script src="js/passmeter.js" type="text/javascript"></script>
<meta charset="utf-8">


</head>
<body>
    <p>&nbsp;</p>
    <div class="form">
        <ul class="tab-group">
            <li class="tab"><a href="#signup">Sign Up</a></li>
            <li class="tab active"><a href="#login">Log In</a></li>
        </ul>
        <div class="tab-content">
            <div id="login">   
                <h1>Sign To Account</h1>
                <form id="loginform" name="loginform" onsubmit="return login_validation();" method="post" autocomplete="off">
                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input type="text" autocomplete="off" name="email" id="email"/>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" autocomplete="off" name="password" id="password"/>
                    </div>
                    <a class="showpass" onclick="toggle_password('password');" id="showpass" style="color: #1ab188; margin-left: 10px;">Show Password</a>
                    <p class="forgot"><a href="forgot.php">Forgot Password?</p></a>
                    <a style="margin-left: 10px;">Stay Signed In?</a>
                    <div class="checkbox">
                        <input type="checkbox" value="1" id="rememberme" name="rememberme"/>
                        <label for="rememberme"></label>
                    </div>
                    <span id="login_message"></span>
                    <button class="button button-block" name="login" id="login"/>Log In</button>
                </form>
            </div>
            <div id="signup">   
                <h1>Create Account</h1>      
                <form id="registerform" name="registerform" onsubmit="return signup_validation();" method="post" autocomplete="off">
                    <div class="top-row">
                        <div class="field-wrap">
                            <label>
                                First Name<span class="req">*</span>
                            </label>
                            <input type="text" autocomplete="off" name='firstname' id='firstname'/>
                        </div>  
                        <div class="field-wrap">
                            <label>
                                Last Name<span class="req">*</span>
                            </label>
                            <input type="text" autocomplete="off" name='lastname' id='lastname'/>
                        </div>
                    </div>
                    <div class="field-wrap">
                        <label>
                            Email Address<span class="req">*</span>
                        </label>
                        <input type="text" autocomplete="off" name='remail' id='remail'/>
                    </div>        
                    <div class="field-wrap">
                        <label>
                            Password<span class="req">*</span>
                        </label>
                        <input type="password" autocomplete="off" name='rpassword' id='rpassword'/>
                    </div>
                    <span id="signup_message"></span>
                    <button type="submit" class="button button-block" name="register" id="register"/>Create Account</button>       
                </form>
            </div>        
        </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>
