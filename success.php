<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Success</title>
    
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
<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="form">
  <h1><?= 'Registration Successful'; ?></h1>
    <p>
    <?php 
        if (isset($_SESSION['message']) AND !empty($_SESSION['message']))
        {
            echo $_SESSION['message'];
        }
    ?>
    </p>
    <a href="/"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
