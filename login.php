<?php
    require 'db.php';
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ($_POST['email'] == 'admin@admin.com')
    {
        $admin = $result->fetch_assoc();
        
        if (password_verify($_POST['password'], $admin['password']))
        {
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $_POST['email'];
            header("location: admin.php");
        }
        else
        {
            $_SESSION['message'] = "<div class='info-alert'>You have entered a wrong password, Please try again!</div>";
            header("location: error.php");
        }
    }

    if ($result->num_rows == 0)
    {
        $_SESSION['message'] = "<div class='info-alert'>Account with that email doesn't exist!</div>";
        header("location: error.php");
    }
    else
    {
        $user = $result->fetch_assoc();

        if (password_verify($_POST['password'], $user['password']))
        {    
            $_SESSION['email'] = $user['email'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['active'] = $user['active'];

            $_SESSION['logged_in'] = true;

            if (isset($_POST['rememberme'])) 
            {
                setcookie('email', $_POST['email'], time()+60*60*24*365);
            }
            else
            {
                setcookie('email', $_POST['email'], false);
            }
            header("location: profile.php");
        }
        else if($_POST['email'] != 'admin@admin.com')
        {
            $_SESSION['message'] = "<div class='info-alert'>You have entered a wrong password, try again!</div>";
            header("location: error.php");
        }
    }
?>