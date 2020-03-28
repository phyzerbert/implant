<?php
    $_SESSION['email'] = $_POST['remail'];
    $_SESSION['first_name'] = $_POST['firstname'];
    $_SESSION['last_name'] = $_POST['lastname'];

    $first_name = $mysqli->escape_string($_POST['firstname']);
    $last_name = $mysqli->escape_string($_POST['lastname']);
    $email = $mysqli->escape_string($_POST['remail']);
    $password = $mysqli->escape_string(password_hash($_POST['rpassword'], PASSWORD_BCRYPT));
    $hash = $mysqli->escape_string(md5(rand(0,1000)));
      
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

    if ($result->num_rows > 0)
    {
        $_SESSION['message'] = '<div class="info-alert">User with this email already exists!</div>';
        header("location: error.php");
    }
    else
    {
        $sql = "INSERT INTO users (first_name, last_name, email, password, hash)" 
            ."VALUES ('$first_name','$last_name','$email','$password', '$hash')";

        if ($mysqli->query($sql))
        {
            $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
            $user = $result->fetch_assoc();

            $id = $user['user_id'];
            
            $_SESSION['active'] = 0;
            $_SESSION['logged_in'] = true;

            if ($_SESSION['email'] == 'admin@admin.com')
            {
                header("location: admin.php");
            }

            else
            {
                $_SESSION['message'] =
                    "<div class='info-success'>Confirmation link has been sent to $email, please verify
                    your account by clicking on the link in the message!</div>";

                $to = $email;
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $subject = 'Account Verification';
                $message =  '<html>
                            <head>
                                <title>TEST</title>
                                <style type="text/css">
                                    body
                                    {
                                        background: #c1bdba;
                                        font-family: "Titillium Web", sans-serif;
                                    }
                                    a
                                    {
                                        text-decoration: none;
                                        color: #1ab188;
                                        -webkit-transition: .5s ease;
                                        transition: .5s ease;
                                    }
                                    a:hover
                                    {
                                        color: #179b77;
                                    }
                                    h1
                                    {
                                        font-size: 18px;
                                        text-align: center;
                                        color: #ffffff;
                                        font-weight: 300;
                                    }
                                    h2
                                    {
                                        text-align: center;
                                        color: #1ab188;
                                        font-weight: 1000;
                                    }
                                    span
                                    {
                                        color: #1ab188;
                                        font-weight: bold;
                                    }
                                    p
                                    {
                                        text-align: center;
                                        color: #ffffff;
                                        margin: 0px 0px 50px 0px;
                                        padding-top: 2px;
                                    }
                                    .form
                                    {
                                        background: rgba(19, 35, 47, 0.9); 
                                        padding: 40px;
                                        max-width: 600px;
                                        margin: 40px auto;
                                        border-radius: 4px;
                                        box-shadow: 0 4px 10px 4px rgba(19, 35, 47, 0.3);
                                    }
                                    .button
                                    {
                                        font-family: "Titillium Web", sans-serif;
                                        border: 0;
                                        outline: none;
                                        border-radius: 0;
                                        padding: 15px 0;
                                        margin-top: 30px;
                                        font-size: 2rem;
                                        font-weight: 600;
                                        text-transform: uppercase;
                                        letter-spacing: .1em;
                                        background: #1ab188;
                                        color: #ffffff;
                                        -webkit-transition: all 0.5s ease;
                                        transition: all 0.5s ease;
                                        -webkit-appearance: none;
                                    }
                                    .button:hover, .button:focus
                                    {
                                        background: #179b77;
                                    }
                                    .button-block
                                    {
                                        display: block;
                                        width: 100%;
                                    }
                                </style>
                            </head>
                            <body>
                                <div class="form">
                                    <h1 style="font-size: 20px; text-align: left;">Hello <a>'.$first_name.'</a></h1>,<br>
                            
                                    <h1>Thank you for creating an account with E-procument Implant!<br>
                            
                                    Please click the button below to activate your account:<br></h1>
                            
                                    <a href="http://localhost/implant/verify.php?id='.$id.'&hash='.$hash.'"><button class="button button-block">Activate Account</button></a>
                                </div>
                            </body>
                            </html>';
                mail($to, $subject, $message, $headers);
                header("location: success.php");
            }
        }
        else
        {
            $_SESSION['message'] = '<div class="info-alert">Registration failed!</div>';
            header("location: error.php");
        }
    }
?>