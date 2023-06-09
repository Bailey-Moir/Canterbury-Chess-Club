<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "header.php"; ?>
	<title>Canterbury Chess Club</title>
</head>
<body>
	<?php include "modules/navbar/navbar.php"; ?>
	<div id="main">
        
        <div class="row justify-content-center">
            <div class="col-6">

                <div class="card" style="padding-bottom: 10px;"> 
                    <h3 class="card-header">
                        Sign in
                    </h3>

                    <form-signup style="padding-top: 15px; width: 80%;">

                        <div class="form-floating border-secondary">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
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
                        </div>

                        <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
                    </form>

                </div>

            </div>
        </div>
        
	</div>
	<?php include "modules/footer/footer.php"; ?>
</body>
</html>