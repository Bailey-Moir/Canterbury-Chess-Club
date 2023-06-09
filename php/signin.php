<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "modules/navbar/navbar.php"; ?>
    <div id="main">
        
        <div class="row justify-content-center" style="width: 100%;">
            <div class="col-6">

                <div class="card"> 
                    <h3 class="card-header">
                        Sign in
                    </h3>

                    <form-signup style="padding-top: 15px; width: 80%;">

                        <div class="form-floating border-secondary" >
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" >
                            <label for="floatingInput">Email address</label>
                        </div>

                        <div class="form-floating border-secondary">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>

                        <div class="form-check text-start my-3">
                            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me
                            </label>

                            <a href="#" style="float: right;">
                                Forgot password?
                            </a>
                        </div>

                        <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
                    </form>

                    <p style="padding-top: 10px;">
                        Don't have an account? <a href="signup.php">Sign up</a> instead.
                    </p>
                </div>

            </div>
        </div>
        
	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>