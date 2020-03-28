<?php
    require 'db.php';
    session_start();

    if ($_SESSION['logged_in'] != 1 )
    {
        $_SESSION['message'] = "<div class='info-alert'>You must log in before viewing admin page!</div>";
        header("location: error.php"); 
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
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
        <h1>Admin Panel</h1>
        <h2>User's Info</h2>
        <table style="width: 100%;">
            <th style="border-bottom: 2px solid #bcbcbc;">User Id</th>
            <th style="border-bottom: 2px solid #bcbcbc;">First Name</th>
            <th style="border-bottom: 2px solid #bcbcbc;">Last Name</th>
            <th style="border-bottom: 2px solid #bcbcbc;">Email</th>
            <th style="border-bottom: 2px solid #bcbcbc;">Active</th>
            <th style="border-bottom: 2px solid #bcbcbc;">Delete User</th>
            <?php 
                $result= $mysqli->query("SELECT * FROM users WHERE email != 'admin@admin.com'") or die($mysqli->error());
                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc()) 
                    { 
            ?>
            <tr>
                <td>
                    <?php echo $row['user_id']; ?>
                </td>
                <td>
                    <?php echo $row['first_name']; ?>
                </td>
                <td>
                    <?php echo $row['last_name']; ?>
                </td>
                <td>
                    <?php echo $row['email']; ?>
                </td>
                <td>
                    <?php if ($row['active']=='0') { echo 'No'; } else { echo 'Yes'; } ?>
                </td>
                <td>
                    <?php echo '<a href="delete.php?id='.$row['user_id'].'" style="color: #56e2bd;">Delete</a>'; ?>
                </td>
                <br>
            </tr>
            <?php 
                    } 
                }
            ?>
        </table>
        <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>