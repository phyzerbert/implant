<?php 
    require 'db.php';
    session_start();

    if (isset($_SESSION['logged_in']) != 1)
    {
        header("location: /login-system/");
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

        if ($active == "1")
        {
    	      header("location: profile.php");
        }
    }
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= $first_name.' '.$last_name ?></title>
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
        <h1>Welcome</h1>
        <p>
  		  <?php 
				if (isset($_SESSION['message']))
      			{
    			    echo $_SESSION['message'];
			    }
		    ?>
		    </p>  
        <h2><?php echo $first_name.' '.$last_name; ?></h2>
        <p><?= $email ?></p>
        <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
        <a href="update.php"><button class="button button-block" name="update"/>Update Profile</button></a>
        <a href="changepassword.php"><button class="button button-block" name="changepassword"/>Change Password</button></a>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>