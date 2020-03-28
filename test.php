<?php include 'db_connection.php'; if(isset($_POST['finish'])){ $name = '"'.$dbConnection->real_escape_string($_POST['name']).'"';
        $email      = '"'.$dbConnection->real_escape_string($_POST['email']).'"';
        $password   = '"'.password_hash($dbConnection->real_escape_string($_POST['password']), PASSWORD_DEFAULT).'"';
        $gender     = '"'.$dbConnection->real_escape_string($_POST['gender']).'"';
         
        $sqlInsertUser = $dbConnection->query("INSERT INTO multi_step_form_users (name, password, email, gender) VALUES($name, $password, $email, $gender)");
  
        if($sqlInsertUser === false){
            $message = 'Error: ' . $dbConnection->error;
        }else{
            $message =  'Last inserted record is : ' .$dbConnection->insert_id ; 
        }
    }
?>
<html>
<head>
<title>Multi step registration form PHP, JQuery, MySQLi</title>
 


</head>
<body>
<div class='tLink'><strong>Tutorial Link:</strong></div>
<h1>Multi step registration form PHP, JQuery, MySQLi</h1>
<div class="message"><?php if(isset($message)) echo $message; ?></div>
<ul id="signup-step">
<li id="personal" class="active">Personal Detail</li>
<li id="password">Password</li>
<li id="general">General</li>
</ul>
<form name="frmRegistration" id="signup-form" method="post">
<div id="personal-field">
<label>Name</label><span id="name-error" class="signup-error"></span>
<div><input type="text" name="name" id="name" class="demoInputBox"/></div>
<label>Email</label><span id="email-error" class="signup-error"></span>
<div><input type="text" name="email" id="email" class="demoInputBox" /></div>
</div>
<div id="password-field" style="display:none;">
<label>Enter Password</label><span id="password-error" class="signup-error"></span>
<div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
<label>Re-enter Password</label><span id="confirm-password-error" class="signup-error"></span>
<div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div>
</div>
<div id="general-field" style="display:none;">
<label>Gender</label>
<div>
<select name="gender" id="gender" class="demoInputBox">
<option value="male">Male</option>
<option value="female">Female</option>
</select></div>
</div>
<div>
<input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
<input class="btnAction" type="button" name="next" id="next" value="Next" >
<input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
</div>
</form>
</body>
</html>
</html>