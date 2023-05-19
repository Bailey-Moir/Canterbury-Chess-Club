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
            </div>

            <div id="login_enter_box">
                <div><i></i></div>
                <h4>Password</h4>
                <i></i>
            </div>

            <div id="remember">
                <p>Remember me</p>
            </div>
            
            <a href="">Forgot password?</a>

            <div id="button" class="btn">
                <h4><a href="/php/profile.php">Login</a></h2>
            </div>

            <p>Don't have an account? <a href="signup.php">Sign in</a> instead.</p>

		</div>
		

	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>