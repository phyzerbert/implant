<?php
    require 'db.php';
    session_start();

    if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
    {
        $email = $mysqli->escape_string($_GET['email']); 
        $hash = $mysqli->escape_string($_GET['hash']); 

        $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash'");
        
        if ($result->num_rows == 0)
        { 
            $_SESSION['message'] = "<div class='info-alert'>You have entered invalid URL for password reset!</div>";
            header("location: error.php");
        }
    }
    else
    {
        $_SESSION['message'] = "<div class='info-alert'>Sorry, verification failed, try again!</div>";
        header("location: error.php");  
    }
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
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
</head>
<body>
    <div class="form">
        <h1>Choose Your New Password</h1>   
        <form action="reset_password.php" method="post">      
            <div class="field-wrap">
                <label>
                    New Password<span class="req">*</span>
                </label>
                <input type="password"required name="newpassword" autocomplete="off"/>
            </div>
            <div class="field-wrap">
                <label>
                    Confirm New Password<span class="req">*</span>
                </label>
                <input type="password"required name="confirmpassword" autocomplete="off"/>
            </div>
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="hash" value="<?= $hash ?>">
            <button class="button button-block"/>Apply</button>
        </form>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>