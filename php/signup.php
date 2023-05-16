<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "modules/navbar/navbar.php"; ?>
	<div id="main">
		
		<div id="login_box">
			<div id="login_header">
                <h2>Login</h2>
            </div>

            <div id="login_enter_box">
                <div><i></i></div>
                <h4>Username or Email to login</h4>
                <p>This username is already taken <a href="login.php">Log in</a> instead.</p> 
            </div>

            <div id="login_enter_box">
                <div><i></i></div>
                <h4>Email</h4>
                <p>This is not a valid email format, it should look like this: "username@email.com".</p> 
            </div>

            <div id="login_enter_box">
                <div><i></i></div>
                <h4>Password</h4>
                <i></i>
                <p>Password should contain at least one capital letter, number and be 8 characters long.</p> 
            </div>

            <div id="login">
                <h4><a href="">Create Account</a></h2>
            </div>

		</div>
		

	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>