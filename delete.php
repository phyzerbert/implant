<?php
    require 'db.php';
    session_start();

    if (isset($_SESSION['logged_in']) != 1)
    {
        header("location: /login-system/");
    }

    else if (isset($_GET['id']) && !empty($_GET['id']))
    {
        $id = $_GET['id'];
        
        $result = $mysqli->query("SELECT * FROM users WHERE user_id='$id'");
        $user = $result->fetch_assoc();

        $first_name = $user['first_name'];
        $last_name = $user['last_name'];

        if (isset($_POST['yes']))
        {
            if ($result->num_rows == 0)
            { 
                $_SESSION['message'] = "<div class='info-alert'>User has already been deleted!</div>";
                header("location: error.php");
            }
            else
            {
                $sql = "DELETE FROM users WHERE user_id='$id'";

                if ($mysqli->query($sql))
                {
                    $_SESSION['message'] = "<div class='info-success'>User deleted successfully</div>";
                    header("Location: success.php");
                }
                else
                {
                    $_SESSION['message'] = "<div class='info-success'>User not deleted!</div>";
                    header("Location: error.php");
                }
            }
        }
        else if (isset($_POST['no']))
        {
            header("location: admin.php");
        }
    }
    else
    {
        $_SESSION['message'] = "<div class='info-alert'>Invalid parameters provided for account verification!</div>";
        header("location: error.php");
    }
?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Delete User</title>
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
        <h1>Confirm Delete User</h1>
        <form method="post">
            <h2>Are you sure you want to delete <a><?php echo $first_name." ".$last_name; ?></a></h2>
            <a href="delete.php?id=<?php echo $_GET['id'].$_GET['hash']; ?>"><button class="button button-block" id="yes" name="yes">Yes</button></a>
            <a href="admin.php"><button class="button button-block" id="no" name="no">No</button></a>
        </form>
    </div>
</body>
</html>