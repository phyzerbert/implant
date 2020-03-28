<?php
    session_start();
    session_unset();
    session_destroy(); 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Error</title>
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
        <?php 
            setcookie('email', $_POST['email'], 1);
            setcookie('password', password_hash($_POST['password'], PASSWORD_BCRYPT), 1);
          	header("location: /login-system/");
        ?>
    </div>
</body>
</html>