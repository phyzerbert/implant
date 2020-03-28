<?php
    require 'db.php';
    session_start();

    if ($_SESSION['logged_in'] != 1)
    {
        $_SESSION['message'] = "<div class='info-alert'>You must log in before viewing your profile page!</div>";
        header("location: error.php");    
    }
    else if ($_SESSION['email'] == 'admin@admin.com')
    {
        header("location: admin.php");
    }
    else
    {
        $email = $mysqli->escape_string($_SESSION['email']);
        $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
        $user = $result->fetch_assoc();

        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $email = $user['email'];
        $active = $user['active'];
    }
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $first_name.' '.$last_name ?></title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <style type="text/css">
    body,td,th {
	font-family: "Titillium Web", sans-serif;
	font-size: 16px;
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
    <div class="form2">
    <img src="img/logo2.png" width="243" height="107">
    <div class="navbar">
  
<a href="logout.php"><button class="btn"><i class="fa fa-sign-out"></i> Logout</button></a>

<a href="update.php"><button class="btn"><i class="fa fa-user"></i> Update Profile</button></a>

<a href="changepassword.php"><button class="btn"><i class="fa fa-lock"></i> Change Password</button></a>
</div>
    <?php  
            if ($active == "0")
            {
                $_SESSION['message'] = '<div class="info-alert">Account is unverified, please confirm your email by 
                clicking on the link sent to your email!</div>
                <a href="resend.php"><button class="button button-block" name="resend"/>Resend Link</button></a>';
                header("location: unverified.php");
            }
        ?>
    <br>
<br>
      <h2>Hi! <?php echo $first_name.' '.$last_name; ?></h2>
        <h6>Logged in email: <?= $email ?></h6>
        <p>
      <div class="navbar2"><div class="container">
  </div></div>


        </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      <p>&nbsp;</p>
       
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
      <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.2/TweenMax.min.js'></script><script  src="js/script.js"></script>
</body>
</html>